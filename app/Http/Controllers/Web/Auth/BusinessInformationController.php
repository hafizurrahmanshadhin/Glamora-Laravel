<?php

namespace App\Http\Controllers\Web\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\BusinessInformation;
use App\Models\Service;
use App\Models\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BusinessInformationController extends Controller {
    /**
     * Display the business-information view.
     */
    // public function index(): View {
    //     return view('auth.layouts.business-information');
    // }

    // public function store(Request $request) {
    //     $validated = $request->validate([
    //         'avatar'             => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
    //         'name'               => 'required|string|max:255',
    //         'bio'                => 'required|string',
    //         'business_name'      => 'required|string|max:255',
    //         'professional_title' => 'required|string|max:255',
    //         'license'            => 'required|file|mimes:pdf,jpg,png|max:10240',
    //     ]);

    //     $avatarPath  = Helper::fileUpload($request->file('avatar'), 'avatars', $validated['name']);
    //     $licensePath = Helper::fileUpload($request->file('license'), 'licenses', $validated['name']);

    //     if (!$avatarPath || !$licensePath) {
    //         return redirect()->back()->with('t-error', 'Failed to upload files. Please try again.');
    //     }

    //     BusinessInformation::create([
    //         'user_id'            => Auth::id(),
    //         'avatar'             => $avatarPath,
    //         'name'               => $validated['name'],
    //         'bio'                => $validated['bio'],
    //         'business_name'      => $validated['business_name'],
    //         'professional_title' => $validated['professional_title'],
    //         'license'            => $licensePath,
    //     ]);

    //     return redirect()->route('beauty-expert-dashboard')->with('t-success', 'Business information updated successfully.');
    // }

    /**
     * Display the business-information view.
     */
    public function index(): View {
        $services = Service::where('status', 'active')->get();
        return view('auth.layouts.business-information', compact('services'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'avatar'                   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'name'                     => 'required|string|max:255',
            'bio'                      => 'required|string',
            'business_name'            => 'required|string|max:255',
            'professional_title'       => 'required|string|max:255',
            'license'                  => 'required|file|mimes:pdf,jpg,png|max:10240',
            'services'                 => 'required|array',
            'services.*.id'            => 'required|exists:services,id',
            'services.*.selected'      => 'required|boolean',
            'services.*.offered_price' => 'required_if:services.*.selected,true|numeric|min:0',
            'services.*.image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $avatarPath  = Helper::fileUpload($request->file('avatar'), 'avatars', $validated['name']);
        $licensePath = Helper::fileUpload($request->file('license'), 'licenses', $validated['name']);

        if (!$avatarPath || !$licensePath) {
            return redirect()->back()->with('t-error', 'Failed to upload files. Please try again.');
        }

        $businessInformation = BusinessInformation::create([
            'user_id'            => Auth::id(),
            'avatar'             => $avatarPath,
            'name'               => $validated['name'],
            'bio'                => $validated['bio'],
            'business_name'      => $validated['business_name'],
            'professional_title' => $validated['professional_title'],
            'license'            => $licensePath,
        ]);

        foreach ($validated['services'] as $serviceData) {
            if ($serviceData['selected']) {
                $service    = Service::find($serviceData['id']);
                $totalPrice = $serviceData['offered_price'] + ($serviceData['offered_price'] * $service->platform_fee / 100);
                $imagePath  = $serviceData['image'] ? Helper::fileUpload($serviceData['image'], 'service_images', $serviceData['id']) : null;

                UserService::create([
                    'user_id'       => Auth::id(),
                    'service_id'    => $serviceData['id'],
                    'selected'      => $serviceData['selected'],
                    'offered_price' => $serviceData['offered_price'],
                    'total_price'   => $totalPrice,
                    'image'         => $imagePath,
                ]);
            }
        }

        return redirect()->route('beauty-expert-dashboard')->with('t-success', 'Business information updated successfully.');
    }
}
