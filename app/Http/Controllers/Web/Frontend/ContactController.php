<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\SystemSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller {
    /**
     * Display the contact page.
     *
     * @return View
     */
    public function index(): View {
        $systemSettings = SystemSetting::first();
        // dd($systemSettings);

        return view('frontend.layouts.contact.index', compact('systemSettings'));
    }

    /**
     * Store a newly created contact in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse {
        $validatedData = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|string|email|max:255',
            'phone_number' => 'required|string|max:25|regex:/^([0-9\s\-\+\(\)]*)$/',
            'message'      => 'required|string',
        ]);

        Contact::create($validatedData);

        return response()->json(['success' => 'Your message has been sent successfully!']);
    }
}
