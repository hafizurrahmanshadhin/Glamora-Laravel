<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMSImage;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class HomePageImageController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View | JsonResponse {
        try {
            if ($request->ajax()) {
                $data = CMSImage::where('page', 'home')->latest()->get();
                return response()->json([
                    'status' => true,
                    'data'   => $data,
                ]);
            }
            return view('backend.layouts.cms.home-page.index');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created home page image in storage.
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
            $filePath     = Helper::fileUpload($uploadedFile, 'home-images', 'home-banner');

            if (!$filePath) {
                return Helper::jsonResponse(false, 'File upload failed. Please try again.', 500);
            }

            CMSImage::create([
                'image' => $filePath,
                'page'  => 'home',
            ]);

            return Helper::jsonResponse(true, 'Home page image created successfully.', 200);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred while creating the home page image: ' . $e->getMessage(), 500);
        }
    }

    public function destroy($id): JsonResponse {
        try {
            $image = CMSImage::findOrFail($id);
            Helper::fileDelete(public_path($image->image));
            $image->delete();
            return Helper::jsonResponse(true, 'Image deleted successfully.', 200);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Error deleting image: ' . $e->getMessage(), 500);
        }
    }
}
