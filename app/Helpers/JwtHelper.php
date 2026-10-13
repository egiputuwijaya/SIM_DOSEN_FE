<?php
namespace App\Helpers;

use App\Core\App;

class JwtHelper
{
    private static function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private static function base64UrlDecode(string $data): string
    {
        return base64_decode(strtr($data, '-_', '+/'));
    }

    /**
     * Decode payload JWT tanpa verifikasi signature (untuk membaca klaim).
     */
    public static function decodePayload(string $token): ?array
    {
        $parts = explode('.', $token);
        if (count($parts) !== 3) {
            return null;
        }

        $payloadJson = self::base64UrlDecode($parts[1]);
        $payload = json_decode($payloadJson, true);
        return is_array($payload) ? $payload : null;
    }

    /**
     * Buat access token JWT HS256 yang valid dan identik dengan keluaran sim-mhs-api.
     * Dapat digunakan untuk Mode Demo / Pengujian Tanpa Backend sim-mhs-api.
     */
    public static function createDemoToken(
        string|int $sub,
        string $username,
        string $nama,
        string $role,
        array $scope = [],
        int $expiresInSeconds = 3600
    ): string {
        $secret = App::config('jwt_secret');
        $issuer = App::config('jwt_issuer', 'sim-mhs-api');

        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT',
        ];

        $now = time();
        $payload = [
            'sub' => (string)$sub,
            'username' => $username,
            'nama' => $nama,
            'role' => strtoupper($role),
            'scope' => empty($scope) ? ['idUniversitas' => 1] : $scope,
            'typ' => 'access',
            'iss' => $issuer,
            'iat' => $now,
            'exp' => $now + $expiresInSeconds,
        ];

        $headerEncoded = self::base64UrlEncode(json_encode($header));
        $payloadEncoded = self::base64UrlEncode(json_encode($payload));

        $signature = hash_hmac('sha256', "$headerEncoded.$payloadEncoded", $secret, true);
        $signatureEncoded = self::base64UrlEncode($signature);

        return "$headerEncoded.$payloadEncoded.$signatureEncoded";
    }
}
