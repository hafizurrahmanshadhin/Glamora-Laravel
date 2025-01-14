<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
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
        return view('frontend.layouts.contact.index');
    }

    /**
     * Store a newly created contact in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    // public function store(Request $request): JsonResponse {
    //     $validatedData = $request->validate([
    //         'firstName'    => 'required|string|max:255',
    //         'lastName'     => 'required|string|max:255',
    //         'phone_number' => 'required|string|max:25',
    //         'Message'      => 'required|string',
    //     ]);

    //     Contact::create($validatedData);

    //     return response()->json(['success' => 'Your message has been sent successfully!']);
    // }
}
