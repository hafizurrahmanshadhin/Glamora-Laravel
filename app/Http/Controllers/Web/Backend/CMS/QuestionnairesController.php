<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use App\Models\CMS;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class QuestionnairesController extends Controller {
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = CMS::where('section', 'questionnaires')->latest()->get();
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
            'title'   => 'required|string',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $questionnaires          = CMS::firstOrNew(['section' => 'questionnaires']);
        $questionnaires->title   = $request->input('title');
        $questionnaires->content = $request->input('content');
        $questionnaires->section = 'questionnaires';
        $questionnaires->save();

        return redirect()->route('cms.questionnaires.index')->with('t-success', 'Questionnaires updated successfully.');
    }

    // public function store(Request $request) {
    //     $validator = Validator::make($request->all(), [

    //         ]);

    //         if ($validator->fails()) {
    //             return Helper::jsonResponse(false, 'Validation errors', 422, null, $validator->errors());
    //         }

    //         $data =

    //         return Helper::jsonResponse(true, 'Created Successfully.', 201, $data);
    // }
}
