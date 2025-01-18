<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\BusinessInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BusinessInformationController extends Controller {
    /**
     * Display the business-information view.
     */
    public function index(): View {
        return view('auth.layouts.business-information');
    }

    /**
     * Store the business information.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'avatar'             => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'name'               => 'required|string|max:255',
            'bio'                => 'required|string',
            'business_name'      => 'required|string|max:255',
            'professional_title' => 'required|string|max:255',
            'license'            => 'required|file|mimes:pdf,jpg,png|max:10240',
        ]);

        $avatarPath  = $request->file('avatar')->store('avatars');
        $licensePath = $request->file('license')->store('licenses');

        BusinessInformation::create([
            'user_id'            => Auth::id(),
            'avatar'             => $avatarPath,
            'name'               => $validated['name'],
            'bio'                => $validated['bio'],
            'business_name'      => $validated['business_name'],
            'professional_title' => $validated['professional_title'],
            'license'            => $licensePath,
        ]);

        return redirect()->route('beauty-expert-dashboard')->with('t-success', 'Business information updated successfully.');
    }
}
