<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class SocialMediaController extends Controller {
    /**
     * Display the social media settings page.
     *
     * @return View|JsonResponse
     */
    public function index(): View | JsonResponse {
        try {
            $social_link = SocialMedia::latest('id')->get();
            return view('backend.layouts.settings.social_media', compact('social_link'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update or create social media links.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'social_media.*'    => 'required|string',
            'profile_link.*'    => 'required|url',
            'social_media_id.*' => 'sometimes|nullable|integer',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $idsToUpdate = collect($request->social_media_id)->filter()->all();

            foreach ($request->social_media as $index => $media) {
                $profileLink   = $request->profile_link[$index] ?? null;
                $socialMediaId = $request->social_media_id[$index] ?? null;

                if ($media && $profileLink) {
                    $socialMedia               = $socialMediaId ? SocialMedia::find($socialMediaId) : new SocialMedia();
                    $socialMedia->social_media = $media;
                    $socialMedia->profile_link = $profileLink;
                    $socialMedia->save();

                    if (($key = array_search($socialMediaId, $idsToUpdate)) !== false) {
                        unset($idsToUpdate[$key]);
                    }
                }
            }

            SocialMedia::whereIn('id', $idsToUpdate)->delete();

            return back()->with('t-success', 'Social media links updated successfully.');
        } catch (Exception) {
            return back()->with('t-error', 'Social media links failed update.');
        }
    }

    /**
     * Delete a social media link by its ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        try {
            SocialMedia::destroy($id);

            return response()->json([
                'success' => true,
                'message' => 'Social media link deleted successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete social media link.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
