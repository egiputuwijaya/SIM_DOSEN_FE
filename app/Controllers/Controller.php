<?php
namespace App\Controllers;

use App\Core\App;
use App\Helpers\Session;

abstract class Controller
{
    /**
     * Render view dengan layout (ala Blade / PHP templating)
     */
    protected function render(string $viewPath, array $data = [], string $layout = 'layouts/app'): void
    {
        extract($data);

        $viewsDir = App::basePath('resources/views');
        $viewFile = $viewsDir . '/' . str_replace('.', '/', $viewPath) . '.php';

        if (!file_exists($viewFile)) {
            http_response_code(500);
            echo "View file [$viewFile] tidak ditemukan.";
            return;
        }

        // Tangkap konten view
        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        // Render ke dalam layout jika layout ditentukan
        if ($layout) {
            $layoutFile = $viewsDir . '/' . str_replace('.', '/', $layout) . '.php';
            if (file_exists($layoutFile)) {
                require $layoutFile;
                return;
            }
        }

        echo $content;
    }

    /**
     * Redirect ke path tertentu
     */
    protected function redirect(string $path): void
    {
        $url = url($path);
        header("Location: $url");
        exit;
    }

    /**
     * Redirect kembali dengan pesan sukses
     */
    protected function redirectWithSuccess(string $path, string $message): void
    {
        Session::flash('success', $message);
        $this->redirect($path);
    }

    /**
     * Redirect kembali dengan pesan error dan input lama
     */
    protected function redirectWithError(string $path, string $message, array $errors = [], array $oldInputs = []): void
    {
        Session::flash('error', $message);
        if (!empty($errors)) {
            Session::flash('validation_errors', $errors);
        }
        if (!empty($oldInputs)) {
            Session::flash('old_inputs', $oldInputs);
        }
        $this->redirect($path);
    }

    /**
     * Kembalikan respon JSON
     */
    protected function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }
}
