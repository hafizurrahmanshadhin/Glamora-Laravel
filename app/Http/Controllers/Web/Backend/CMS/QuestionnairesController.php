<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\RegisterQuestionSurvey;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class QuestionnairesController extends Controller {
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = RegisterQuestionSurvey::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('description', function ($data) {
                    $description      = $data->description;
                    $shortDescription = strlen($description) > 150 ? substr($description, 0, 150) . '...' : $description;
                    return '<p>' . $shortDescription . '</p>';
                })
                ->addColumn('status', function ($data) {
                    return '
                            <div class="d-flex justify-content-center">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck' . $data->id . '" ' . ($data->status == 'active' ? 'checked' : '') . ' onclick="showStatusChangeAlert(' . $data->id . ')">
                                </div>
                            </div>
                        ';
                })
                ->addColumn('action', function ($data) {
                    return '
                            <div class="d-flex justify-content-center hstack gap-3 fs-base">
                                <a href="javascript:void(0);" class="link-primary text-decoration-none edit-blog" data-id="' . $data->id . '" title="Edit">
                                    <i class="ri-pencil-line" style="font-size:24px;"></i>
                                </a>

                                <a href="javascript:void(0);" onclick="showBlogDetails(' . $data->id . ')" class="link-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewBlogModal" title="View">
                                    <i class="ri-eye-line" style="font-size: 24px;"></i>
                                </a>

                                <a href="javascript:void(0);" onclick="showDeleteConfirm(' . $data->id . ')" class="link-danger text-decoration-none" title="Delete">
                                    <i class="ri-delete-bin-5-line" style="font-size:24px;"></i>
                                </a>
                            </div>
                        ';
                })
                ->rawColumns(['description', 'status', 'action'])
                ->make();
        }
        $questionnaires = CMS::firstOrNew(['section' => 'questionnaires']);
        return view('backend.layouts.cms.questionnaires.index', compact('questionnaires'));
    }

    public function updateQuestionnaires(Request $request) {
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $questionnaires              = CMS::firstOrNew(['section' => 'questionnaires']);
        $questionnaires->title       = $request->input('title');
        $questionnaires->description = $request->input('description');
        $questionnaires->section     = 'questionnaires';
        $questionnaires->save();

        return redirect()->route('cms.questionnaires.index')->with('t-success', 'Questionnaires updated successfully.');
    }

    public function show(int $id) {
        try {
            $data = RegisterQuestionSurvey::findOrFail($id);
            return Helper::jsonResponse(true, 'Data fetched successfully', 200, $data);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function store(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'description' => 'required|string',
            ]);

            if ($validator->fails()) {
                return Helper::jsonResponse(false, 'Validation errors', 422, null, $validator->errors());
            }

            $questionnaires = RegisterQuestionSurvey::create($request->only('description'));

            return Helper::jsonResponse(true, 'Questionnaires created successfully.', 201, $questionnaires);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Error creating questionnaires: ' . $e->getMessage(), 500);
        }
    }

    public function update(Request $request, int $id) {
        try {
            $validator = Validator::make($request->all(), [
                'description' => 'required|string',
            ]);

            if ($validator->fails()) {
                return Helper::jsonResponse(false, 'Validation errors', 422, null, $validator->errors());
            }

            $questionnaires = RegisterQuestionSurvey::findOrFail($id);
            $questionnaires->update($request->only('description'));

            return Helper::jsonResponse(true, 'Questionnaires updated successfully.', 200, $questionnaires);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Error updating questionnaires: ' . $e->getMessage(), 500);
        }
    }

    public function status(int $id) {
        try {
            $questionnaires = RegisterQuestionSurvey::findOrFail($id);

            if ($questionnaires->status === 'active') {
                $questionnaires->status = 'inactive';
                $questionnaires->save();

                return Helper::jsonResponse(false, 'Unpublished Successfully.', 200, $questionnaires);
            } else {
                $questionnaires->status = 'active';
                $questionnaires->save();

                return Helper::jsonResponse(true, 'Published Successfully.', 200, $questionnaires);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function destroy(int $id) {
        try {
            $questionnaires = RegisterQuestionSurvey::findOrFail($id);

            // Delete the record
            $questionnaires->delete();

            return Helper::jsonResponse(true, 'Deleted successfully.', 200, $questionnaires);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'An error occurred while deleting.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
