<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Content;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;

class InclusionsCancellationController extends Controller {
    /**
     * Display the inclusions & cancellation page.
     *
     * @return View
     */
    public function index(): View | JsonResponse {
        try {
            $inclusions_cancellation = Content::where('type', 'inclusionsCancellation')->first();
            return view('backend.layouts.settings.inclusions_cancellation', compact('inclusions_cancellation'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the inclusions & cancellation policy.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $inclusions_cancellation = Content::where('type', 'inclusionsCancellation')->first();

            if ($inclusions_cancellation) {
                $inclusions_cancellation->title   = $request->input('title');
                $inclusions_cancellation->slug    = Str::slug($request->input('title'));
                $inclusions_cancellation->content = $request->input('content');
                $inclusions_cancellation->save();
            } else {
                Content::create([
                    'type'    => 'inclusionsCancellation',
                    'title'   => $request->input('title'),
                    'slug'    => Str::slug($request->input('title')),
                    'content' => $request->input('content'),
                ]);
            }

            return back()->with('t-success', 'Inclusions & Cancellation Updated Successfully');
        } catch (Exception $e) {
            return back()->with('t-error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
