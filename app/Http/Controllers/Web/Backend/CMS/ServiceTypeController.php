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

class ServiceTypeController extends Controller {
    /**
     * Display service type page.
     *
     * @return RedirectResponse|View
     */
    public function index(): RedirectResponse | View {
        try {
            $serviceTypes = CMS::where('section', 'user-type-container')->get();

            // If no records exist, create two default ones
            if ($serviceTypes->isEmpty()) {
                $serviceTypes = collect([
                    CMS::create([
                        'section'     => 'user-type-container',
                        'title'       => '',
                        'description' => '',
                        'image'       => null,
                    ]),
                    CMS::create([
                        'section'     => 'user-type-container',
                        'title'       => '',
                        'description' => '',
                        'image'       => null,
                    ]),
                ]);
            }

            // Ensure we always have exactly 2 service types
            while ($serviceTypes->count() < 2) {
                $serviceTypes->push(CMS::create([
                    'section'     => 'user-type-container',
                    'title'       => '',
                    'description' => '',
                    'image'       => null,
                ]));
            }

            return view('backend.layouts.cms.service-type.index', compact('serviceTypes'));
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Update service types.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'service_types'                => 'required|array|min:1|max:2',
                'service_types.*.id'           => 'nullable|integer|exists:c_m_s,id',
                'service_types.*.title'        => 'required|string|max:255',
                'service_types.*.description'  => 'required|string',
                'service_types.*.image'        => 'nullable|image|mimes:jpg,jpeg,png,gif|max:20480',
                'service_types.*.remove_image' => 'nullable|boolean',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            foreach ($request->service_types as $index => $serviceTypeData) {
                if (isset($serviceTypeData['id']) && $serviceTypeData['id']) {
                    // Update existing record
                    $serviceType = CMS::findOrFail($serviceTypeData['id']);
                } else {
                    // Create new record
                    $serviceType          = new CMS();
                    $serviceType->section = 'user-type-container';
                }

                $serviceType->title       = $serviceTypeData['title'];
                $serviceType->description = $serviceTypeData['description'];

                // Handle image file
                $imageFieldName       = "service_types.{$index}.image";
                $removeImageFieldName = "service_types.{$index}.remove_image";

                if (isset($serviceTypeData['remove_image']) && $serviceTypeData['remove_image']) {
                    if ($serviceType->image) {
                        Helper::fileDelete(public_path($serviceType->image));
                        $serviceType->image = null;
                    }
                } elseif ($request->hasFile($imageFieldName)) {
                    if ($serviceType->image) {
                        Helper::fileDelete(public_path($serviceType->image));
                    }
                    $serviceType->image = Helper::fileUpload(
                        $request->file($imageFieldName),
                        'serviceType',
                        $serviceType->image
                    );
                }

                $serviceType->save();
            }

            return redirect()->route('cms.service-type.index')->with('t-success', 'Service Types Updated Successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Delete a service type.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse {
        try {
            $serviceType = CMS::where('section', 'user-type-container')
                ->findOrFail($request->id);

            // Delete associated image if exists
            if ($serviceType->image) {
                Helper::fileDelete(public_path($serviceType->image));
            }

            $serviceType->delete();

            return redirect()->route('cms.service-type.index')->with('t-success', 'Service Type Deleted Successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', $e->getMessage());
        }
    }
}
