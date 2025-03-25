<?php

namespace App\Helpers;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Helper {
    /**
     * Upload a file to the specified folder with a given name.
     *
     * @param UploadedFile $file The file to be uploaded.
     * @param string $folder The folder where the file should be uploaded.
     * @param string|null $name The name to be given to the uploaded file.
     * @return string|null The path to the uploaded file or null if the upload fails.
     */
    public static function fileUpload(UploadedFile $file, string $folder, string $name = null): ?string {
        if (!$file->isValid()) {
            return null;
        }

        // Append a unique identifier to the file name
        $uniqueId  = Str::random(10);
        $imageName = ($name ? Str::slug($name) : $uniqueId) . '_' . time() . '.' . $file->extension();
        $path      = public_path('uploads/' . $folder);
        if (!file_exists($path)) {
            if (!mkdir($path, 0755, true) && !is_dir($path)) {
                return null;
            }
        }

        try {
            $file->move($path, $imageName);
            return 'uploads/' . $folder . '/' . $imageName;
        } catch (Exception) {
            return null;
        }
    }

    /**
     * Delete a file or image at the specified path.
     *
     * @param string $path The path to the file to be deleted.
     * @return void
     */
    public static function fileDelete(string $path): void {
        if (file_exists($path)) {
            try {
                unlink($path);
            } catch (Exception $e) {
                Log::error('File deletion error: ' . $e->getMessage());
            }
        } else {
            Log::warning('File not found for deletion: ' . $path);
        }
    }

    /**
     * Generate a unique slug for a given model and title.
     *
     * @param Model $model The model to check for existing slugs.
     * @param string $title The title to generate the slug from.
     * @return string|JsonResponse The generated slug or a JSON response if an error occurs.
     */
    public static function makeSlug(Model $model, string $title): string | JsonResponse {
        try {
            $slug = Str::slug($title);
            while ($model::where('slug', $slug)->exists()) {
                $randomString = Str::random(5);
                $slug         = Str::slug($title) . '-' . $randomString;
            }
            return $slug;
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Generate a JSON response.
     *
     * @param bool $status The status of the response (true for success, false for failure).
     * @param string $message The message to include in the response.
     * @param int $code The HTTP status code for the response.
     * @param mixed|null $data Optional additional data to include in the response.
     * @return JsonResponse The JSON response.
     */
    public static function jsonResponse(bool $status, string $message, int $code, mixed $data = null, $errors = null): JsonResponse {
        try {
            $response = [
                'status'  => $status,
                'message' => $message,
                'code'    => $code,
            ];

            if ($data !== null) {
                $response['data'] = $data;
            }

            if ($errors !== null) {
                $response['errors'] = $errors;
            }

            return response()->json($response, $code);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Check if the current route should show the footer.
     *
     * @return bool|JsonResponse True if the footer should be shown, false otherwise. A JSON response if an error occurs.
     */
    public static function shouldShowFooter(): bool | JsonResponse {
        try {
            $routesWithFooter = [
                'index',
                'available-services',
                'service-category',
                'service-provider-profile',
                'faq',
                'contact',
                'contact.store',
            ];

            return in_array(Route::currentRouteName(), $routesWithFooter);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
