<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use App\Http\Controllers\Controller;
use App\Models\CMS;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class QuestionMarkTextController extends Controller {
    /**
     * Display the question-mark-text Section of the CMS.
     *
     * @return RedirectResponse|View
     */
    public function index(): RedirectResponse | View {
        try {
            $questionMarkText = CMS::firstOrNew(['section' => 'question-mark-text']);
            return view('backend.layouts.cms.question-mark-text.index', compact('questionMarkText'));
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Update the question-mark-text section.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'description' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $questionMarkText              = CMS::firstOrNew(['section' => 'question-mark-text']);
            $questionMarkText->description = $request->input('description');
            $questionMarkText->section     = 'question-mark-text';
            $questionMarkText->save();

            return redirect()->route('cms.question-mark-text.index')->with('t-success', 'Question mark text updated successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }
}
