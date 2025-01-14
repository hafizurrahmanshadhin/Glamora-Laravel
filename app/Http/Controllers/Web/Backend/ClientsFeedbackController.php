<?php

namespace App\Http\Controllers\Web\Backend;

use Exception;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ClientsFeedback;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class ClientsFeedbackController extends Controller {
    /**
     * Display a listing of the clients feedback.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        if ($request->ajax()) {
            $data = ClientsFeedback::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                // ->addColumn('description', function ($data) {
                //     $description      = $data->description;
                //     $shortDescription = strlen($description) > 100 ? substr($description, 0, 100) . '...' : $description;
                //     return '<p>' . $shortDescription . '</p>';
                // })
                ->addColumn('description', function ($data) {
                    $description = Str::limit($data->description, 50, '...');
                    return '<p>' . $description . '</p>';
                })
                ->addColumn('status', function ($clientsFeedback) {
                    $status = '<div class="form-check form-switch" style="margin-left: 40px; width: 50px; height: 24px;">';
                    $status .= '<input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck' . $clientsFeedback->id . '" ' . ($clientsFeedback->status == 'active' ? 'checked' : '') . ' onclick="showStatusChangeAlert(' . $clientsFeedback->id . ')">';
                    $status .= '</div>';

                    return $status;
                })
                ->addColumn('action', function ($clientsFeedback) {
                    return '
                            <div class="hstack gap-3 fs-base">
                                <a href="' . route('clients-feedback.edit', ['id' => $clientsFeedback->id]) . '" class="link-primary text-decoration-none" title="Edit">
                                    <i class="ri-pencil-line" style="font-size: 24px;"></i>
                                </a>

                                <a href="javascript:void(0);" onclick="showDeleteConfirm(' . $clientsFeedback->id . ')" class="link-danger text-decoration-none" title="Delete">
                                    <i class="ri-delete-bin-5-line" style="font-size: 24px;"></i>
                                </a>
                            </div>
                        ';
                })
                ->rawColumns(['description', 'status', 'action'])
                ->make();
        }
        return view('backend.layouts.clients_feedback.index');
    }

    /**
     * Show the form for creating a new clients feedback.
     *
     * @return View
     */
    public function create(): View {
        return view('backend.layouts.clients_feedback.create');
    }

    /**
     * Store a newly created clients feedback in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'rating'      => 'required|integer',
            'description' => 'required|string',
            'name'        => 'required|string',
            'title'       => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $clientsFeedback              = new ClientsFeedback();
            $clientsFeedback->rating      = $request->rating;
            $clientsFeedback->description = $request->description;
            $clientsFeedback->name        = $request->name;
            $clientsFeedback->title       = $request->title;

            $clientsFeedback->save();
            return redirect()->route('clients-feedback.index')->with('t-success', 'Clients Feedback Create Successfully');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Failed to create');
        }
    }

    /**
     * Show the form for editing the specified client feedback.
     *
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): View {
        $clientsFeedback = ClientsFeedback::findOrFail($id);
        return view('backend.layouts.clients_feedback.edit', compact('clientsFeedback'));
    }

    /**
     * Update the specified client feedback in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'rating'      => 'required|integer',
            'description' => 'required|string',
            'name'        => 'required|string',
            'title'       => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $clientsFeedback              = ClientsFeedback::findOrFail($id);
            $clientsFeedback->rating      = $request->rating;
            $clientsFeedback->description = $request->description;
            $clientsFeedback->name        = $request->name;
            $clientsFeedback->title       = $request->title;

            $clientsFeedback->save();
            return redirect()->route('clients-feedback.index')->with('t-success', 'Clients Feedback Update Successfully');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Failed to update');
        }
    }

    /**
     * Toggle the status of the specified client feedback.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        $clientsFeedback = ClientsFeedback::findOrFail($id);

        if ($clientsFeedback->status == 'active') {
            $clientsFeedback->status = 'inactive';
            $clientsFeedback->save();
            return response()->json([
                'success' => false,
                'message' => 'Unpublished Successfully.',
                'data'    => $clientsFeedback,
            ]);
        } else {
            $clientsFeedback->status = 'active';
            $clientsFeedback->save();
            return response()->json([
                'success' => true,
                'message' => 'Published Successfully.',
                'data'    => $clientsFeedback,
            ]);
        }
    }

    /**
     * Remove the specified client feedback from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        $clientsFeedback = ClientsFeedback::findOrFail($id);
        $clientsFeedback->delete();

        return response()->json([
            't-success' => true,
            'message'   => 'Deleted successfully.',
        ]);
    }
}
