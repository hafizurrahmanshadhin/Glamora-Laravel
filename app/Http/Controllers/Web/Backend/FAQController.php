<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class FAQController extends Controller {
    /**
     * Display the listing of faqs.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        try {
            if ($request->ajax()) {
                $data = FAQ::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('question', function ($data) {
                        $question      = $data->question;
                        $shortQuestion = strlen($question) > 20 ? substr($question, 0, 20) . '...' : $question;
                        return '<span class="question-tooltip" style="cursor: pointer;" title="' . $question . '">' . $shortQuestion . '</span>';
                    })
                    ->addColumn('answer', function ($data) {
                        $answer      = $data->answer;
                        $shortAnswer = strlen($answer) > 20 ? substr($answer, 0, 20) . '...' : $answer;
                        return '<span class="question-tooltip" style="cursor: pointer;" title="' . $answer . '">' . $shortAnswer . '</span>';
                    })
                    ->addColumn('status', function ($data) {
                        $status = '<div class="form-check form-switch" style="margin-left: 40px; width: 50px; height: 24px;">';
                        $status .= '<input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck' . $data->id . '" ' . ($data->status == 'active' ? 'checked' : '') . ' onclick="showStatusChangeAlert(' . $data->id . ')">';
                        $status .= '</div>';

                        return $status;
                    })
                    ->addColumn('action', function ($data) {
                        return '
                                <div class="hstack gap-3 fs-base">
                                    <a href="' . route('faq.edit', ['id' => $data->id]) . '" class="link-primary text-decoration-none" title="Edit">
                                        <i class="ri-pencil-line" style="font-size: 24px;"></i>
                                    </a>

                                    <a href="javascript:void(0);" onclick="showFAQDetails(' . $data->id . ')" class="link-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewFAQModal" title="View">
                                        <i class="ri-eye-line" style="font-size: 24px;"></i>
                                    </a>

                                    <a href="javascript:void(0);" onclick="showDeleteConfirm(' . $data->id . ')" class="link-danger text-decoration-none" title="Delete">
                                        <i class="ri-delete-bin-5-line" style="font-size: 24px;"></i>
                                    </a>
                                </div>
                            ';
                    })
                    ->rawColumns(['question', 'answer', 'status', 'action'])
                    ->make();
            }
            return view('backend.layouts.faq.index');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        try {
            $data = FAQ::findOrFail($id);
            return Helper::jsonResponse(true, 'Data fetched successfully', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View|JsonResponse
     */
    public function create(): View | JsonResponse {
        try {
            return view('backend.layouts.faq.create');
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'questions.*' => 'required|string',
            'answers.*'   => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            foreach ($request->questions as $key => $question) {
                $faq           = new FAQ();
                $faq->question = $question;
                $faq->answer   = $request->answers[$key];
                $faq->save();
            }
            return redirect()->route('faq.index')->with('t-success', 'Create successfully');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Failed to create');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View|JsonResponse
     */
    public function edit(int $id): View | JsonResponse {
        try {
            $faq = FAQ::findOrFail($id);
            return view('backend.layouts.faq.edit', compact('faq'));
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string',
            'answer'   => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $faq           = FAQ::findOrFail($id);
            $faq->question = $request->question;
            $faq->answer   = $request->answer;
            $faq->save();
            return redirect()->route('faq.index')->with('t-success', 'Update successfully');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Failed to update');
        }
    }

    /**
     * Change the status of the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        try {
            $data = FAQ::findOrFail($id);
            if ($data->status == 'active') {
                $data->status = 'inactive';
                $data->save();

                return response()->json([
                    'success' => false,
                    'message' => 'Unpublished Successfully.',
                    'data'    => $data,
                ]);
            } else {
                $data->status = 'active';
                $data->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Published Successfully.',
                    'data'    => $data,
                ]);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        try {
            $faq = FAQ::findOrFail($id);
            $faq->delete();
            return response()->json([
                't-success' => false,
                'message'   => 'Deleted successfully.',
            ]);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
