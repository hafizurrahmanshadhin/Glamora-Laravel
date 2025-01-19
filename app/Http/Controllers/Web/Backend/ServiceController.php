<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ServiceController extends Controller {
    /**
     * Display a listing of Service packages.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        if ($request->ajax()) {
            $data = Service::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($service) {
                    $status = '<div class="form-check form-switch" style="margin-left: 40px; width: 50px; height: 24px;">';
                    $status .= '<input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck' . $service->id . '" ' . ($service->status == 'active' ? 'checked' : '') . ' onclick="showStatusChangeAlert(' . $service->id . ')">';
                    $status .= '</div>';

                    return $status;
                })
                ->addColumn('action', function ($service) {
                    return '
                            <div class="hstack gap-3 fs-base">
                                <a href="' . route('service.edit', ['id' => $service->id]) . '" class="link-primary text-decoration-none" title="Edit">
                                    <i class="ri-pencil-line" style="font-size: 24px;"></i>
                                </a>

                                <a href="javascript:void(0);" onclick="showDeleteConfirm(' . $service->id . ')" class="link-danger text-decoration-none" title="Delete">
                                    <i class="ri-delete-bin-5-line" style="font-size: 24px;"></i>
                                </a>
                            </div>
                        ';
                })
                ->rawColumns(['status', 'action'])
                ->make();
        }
        return view('backend.layouts.service.index');
    }

    /**
     * Show the form for creating a new service package.
     *
     * @return View
     */
    public function create(): View {
        return view('backend.layouts.service.create');
    }

    /**
     * Store a newly created service package in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'services_name' => 'required|string|max:255|unique:services,services_name',
            'platform_fee'  => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->route('service.create')->withErrors($validator)->withInput();
        }

        try {
            Service::create([
                'services_name' => $request->input('services_name'),
                'platform_fee'  => $request->input('platform_fee'),
            ]);

            return redirect()->route('service.index')->with('t-success', 'Service package created successfully.');
        } catch (Exception $e) {
            return redirect()
                ->route('service.create')
                ->with('t-error', 'An error occurred while creating the service package: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified service package.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View {
        $service = Service::findOrFail($id);
        return view('backend.layouts.service.edit', compact('service'));
    }

    /**
     * Update the specified service package in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'services_name' => 'required|string|max:255|unique:services,services_name,' . $id,
            'platform_fee'  => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->route('service.edit', $id)->withErrors($validator)->withInput();
        }

        $service = Service::findOrFail($id);

        try {
            $service->update([
                'services_name' => $request->input('services_name'),
                'platform_fee'  => $request->input('platform_fee'),
            ]);

            return redirect()->route('service.index')->with('t-success', 'Service package updated successfully.');
        } catch (Exception $e) {
            return redirect()
                ->route('service.edit', $id)
                ->with('t-error', 'An error occurred while updating the service package: ' . $e->getMessage());
        }
    }

    /**
     * Toggle the status of the specified service package.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        $service = Service::findOrFail($id);

        if ($service->status == 'active') {
            $service->status = 'inactive';
            $service->save();

            return response()->json([
                'success' => false,
                'message' => 'Service package unpublished successfully.',
                'data'    => $service,
            ]);
        } else {
            $service->status = 'active';
            $service->save();
            return response()->json([
                'success' => true,
                'message' => 'Service package published successfully.',
                'data'    => $service,
            ]);
        }
    }

    /**
     * Remove the specified service package from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        $service = Service::findOrFail($id);
        $service->delete();

        return response()->json([
            't-success' => true,
            'message'   => 'Service package deleted successfully.',
        ]);
    }
}
