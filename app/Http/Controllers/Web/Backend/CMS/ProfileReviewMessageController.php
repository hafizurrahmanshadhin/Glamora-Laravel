<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProfileReviewMessageController extends Controller {
    /**
     * Display the profile review message of the CMS.
     *
     * @return RedirectResponse|View
     */
    public function index(): RedirectResponse | View {
        try {
            $profileReviewMessage = CMS::firstOrNew(['section' => 'profile-review-message']);
            return view('backend.layouts.cms.profile-review-message.index', compact('profileReviewMessage'));
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Update the hero section.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'title'        => 'required|string',
                'description'  => 'required|string',
                'content'      => 'required|string',
                'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
                'remove_image' => 'nullable|boolean',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $profileReviewMessage              = CMS::firstOrNew(['section' => 'profile-review-message']);
            $profileReviewMessage->title       = $request->input('title');
            $profileReviewMessage->description = $request->input('description');
            $profileReviewMessage->content     = $request->input('content');

            //* Handle Image File
            if ($request->boolean('remove_image')) {
                if ($profileReviewMessage->image) {
                    Helper::fileDelete(public_path($profileReviewMessage->image));
                    $profileReviewMessage->image = null;
                }
            } elseif ($request->hasFile('image')) {
                if ($profileReviewMessage->image) {
                    Helper::fileDelete(public_path($profileReviewMessage->image));
                }
                $profileReviewMessage->image = Helper::fileUpload($request->file('image'), 'profileReviewMessage', $profileReviewMessage->image);
            }

            $profileReviewMessage->section = 'profile-review-message';
            $profileReviewMessage->save();

            return redirect()->route('cms.profile-review-message.index')->with('t-success', 'profile review message page updated successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }
}
