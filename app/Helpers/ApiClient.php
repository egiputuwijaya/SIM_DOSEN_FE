<?php
namespace App\Helpers;

use App\Core\App;

class ApiClient
{
    private string $baseUrl;
    private ?string $token;

    public function __construct(?string $baseUrl = null, ?string $token = null)
    {
        $this->baseUrl = rtrim($baseUrl ?: App::config('api_base_url'), '/');
        $this->token = $token ?: Session::getToken();
    }

    public function get(string $endpoint, array $queryParams = []): array
    {
        $url = $this->buildUrl($endpoint, $queryParams);
        return $this->request('GET', $url);
    }

    public function post(string $endpoint, array $data = []): array
    {
        $url = $this->buildUrl($endpoint);
        return $this->request('POST', $url, $data);
    }

    public function put(string $endpoint, array $data = []): array
    {
        $url = $this->buildUrl($endpoint);
        return $this->request('PUT', $url, $data);
    }

    public function delete(string $endpoint): array
    {
        $url = $this->buildUrl($endpoint);
        return $this->request('DELETE', $url);
    }

    /**
     * Cek status koneksi ke endpoint /health
     */
    public function checkHealth(): array
    {
        return $this->get('/health');
    }

    private function buildUrl(string $endpoint, array $params = []): string
    {
        $url = $this->baseUrl . '/' . ltrim($endpoint, '/');
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }
        return $url;
    }

    private function request(string $method, string $url, ?array $body = null): array
    {
        return self::sendRequest($method, $url, $body, $this->token, $this->baseUrl);
    }

    /**
     * Universal HTTP Request: Mendukung cURL jika ada, atau fallback otomatis ke PHP Streams (file_get_contents)
     */
    public static function sendRequest(
        string $method,
        string $url,
        ?array $body = null,
        ?string $token = null,
        string $contextUrl = ''
    ): array {
        $headers = [
            'Accept: application/json',
            'Content-Type: application/json',
        ];

        if ($token) {
            $headers[] = 'Authorization: Bearer ' . $token;
        }

        // Eksekusi request
        $res = function_exists('curl_init')
            ? self::requestViaCurl($method, $url, $body, $headers, $contextUrl)
            : self::requestViaStreams($method, $url, $body, $headers, $contextUrl);

        // Jika request ke Vercel gagal (500 FUNCTION_INVOCATION_FAILED atau timeout), coba fallback ke server lokal jika aktif
        if ((!$res['success'] && in_array($res['status'], [0, 500, 502, 503, 504])) && str_contains($url, 'vercel.app')) {
            $fallbackBase = App::config('api_fallback_url');
            if ($fallbackBase) {
                $fallbackUrl = str_replace('https://sim-dosen-api.vercel.app/api', $fallbackBase, $url);
                $fallbackRes = function_exists('curl_init')
                    ? self::requestViaCurl($method, $fallbackUrl, $body, $headers, $fallbackBase)
                    : self::requestViaStreams($method, $fallbackUrl, $body, $headers, $fallbackBase);

                if ($fallbackRes['success']) {
                    return $fallbackRes;
                }
            }
        }

        return $res;
    }

    private static function requestViaCurl(string $method, string $url, ?array $body, array $headers, string $contextUrl): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        if ($body !== null && in_array($method, ['POST', 'PUT', 'PATCH'])) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        }

        $rawResponse = curl_exec($ch);
        $httpCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($rawResponse === false || !empty($curlError)) {
            return [
                'status' => 0,
                'success' => false,
                'message' => 'Gagal terhubung ke API Server (' . ($contextUrl ?: $url) . '): ' . $curlError,
                'data' => null,
                'errors' => ['connection' => $curlError],
            ];
        }

        return self::parseResponse($rawResponse, $httpCode);
    }

    private static function requestViaStreams(string $method, string $url, ?array $body, array $headers, string $contextUrl): array
    {
        $options = [
            'http' => [
                'method' => $method,
                'header' => implode("\r\n", $headers),
                'timeout' => 10,
                'ignore_errors' => true, // Tangkap response body meskipun 4xx atau 5xx
            ],
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ];

        if ($body !== null && in_array($method, ['POST', 'PUT', 'PATCH'])) {
            $options['http']['content'] = json_encode($body);
        }

        $context = stream_context_create($options);
        $rawResponse = @file_get_contents($url, false, $context);

        // Ambil status HTTP dari $http_response_header
        $httpCode = 0;
        if (isset($http_response_header) && is_array($http_response_header)) {
            foreach ($http_response_header as $headerLine) {
                if (preg_match('#^HTTP/\d+\.\d+\s+(\d+)#i', $headerLine, $matches)) {
                    $httpCode = (int)$matches[1];
                }
            }
        }

        if ($rawResponse === false && $httpCode === 0) {
            $lastErr = error_get_last()['message'] ?? 'Tidak dapat terhubung';
            return [
                'status' => 0,
                'success' => false,
                'message' => 'Gagal terhubung ke API (' . ($contextUrl ?: $url) . '): ' . $lastErr,
                'data' => null,
                'errors' => ['connection' => $lastErr],
            ];
        }

        return self::parseResponse((string)$rawResponse, $httpCode);
    }

    private static function parseResponse(string $rawResponse, int $httpCode): array
    {
        $decoded = json_decode($rawResponse, true);

        if (!is_array($decoded)) {
            return [
                'status' => $httpCode,
                'success' => false,
                'message' => 'Respon dari API bukan format JSON valid (HTTP ' . $httpCode . ')',
                'data' => null,
                'raw' => $rawResponse,
                'errors' => ['server' => 'Server API mengembalikan respons non-JSON'],
            ];
        }

        $msg = $decoded['message']
            ?? (is_array($decoded['error'] ?? null) ? ($decoded['error']['message'] ?? '') : ($decoded['error'] ?? ''))
            ?: ($decoded['msg'] ?? '');

        if (empty($msg) && !empty($decoded['errors']) && is_array($decoded['errors'])) {
            $errParts = [];
            foreach ($decoded['errors'] as $field => $errVal) {
                $errParts[] = is_string($errVal) ? "$field: $errVal" : "$field: " . json_encode($errVal);
            }
            $msg = implode(', ', $errParts);
        }

        if (empty($msg) && $httpCode >= 400) {
            $msg = 'Gagal autentikasi dari server SSO (HTTP ' . $httpCode . ')';
        }

        return [
            'status' => $httpCode,
            'success' => $decoded['success'] ?? ($httpCode >= 200 && $httpCode < 300),
            'message' => (string)$msg,
            'data' => $decoded['data'] ?? null,
            'errors' => $decoded['errors'] ?? ($decoded['error']['details'] ?? []),
            'raw' => $rawResponse,
        ];
    }
}
