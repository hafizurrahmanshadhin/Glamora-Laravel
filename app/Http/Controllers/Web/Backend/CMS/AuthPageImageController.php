<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMSImage;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class AuthPageImageController extends Controller {
    /**
     * Display the current auth page image.
     *
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View | JsonResponse {
        try {
            if ($request->ajax()) {
                $data = CMSImage::where('page', 'auth')->latest()->get();
                return response()->json([
                    'status' => true,
                    'data'   => $data,
                ]);
            }
            $currentImage = CMSImage::where('page', 'auth')->latest()->first();
            return view('backend.layouts.cms.auth-page.index', compact('currentImage'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the auth page image. If an image already exists, it is replaced.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480',
        ]);

        if ($validator->fails()) {
            return Helper::jsonResponse(false, 'Validation error', 422, null, $validator->errors()->toArray());
        }

        try {
            $uploadedFile = $request->file('image');
            $filePath     = Helper::fileUpload($uploadedFile, 'auth-images', 'auth-banner');

            if (!$filePath) {
                return Helper::jsonResponse(false, 'File upload failed. Please try again.', 500);
            }

            $existingImage = CMSImage::where('page', 'auth')->first();
            if ($existingImage) {
                // Delete the old file and update the record.
                Helper::fileDelete(public_path($existingImage->image));
                $existingImage->update([
                    'image' => $filePath,
                ]);
            } else {
                CMSImage::create([
                    'image' => $filePath,
                    'page'  => 'auth',
                ]);
            }

            return Helper::jsonResponse(true, 'Auth page image updated successfully.', 200, ['newImageUrl' => asset($filePath)]);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred while updating the auth page image: ' . $e->getMessage(), 500);
        }
    }
}
