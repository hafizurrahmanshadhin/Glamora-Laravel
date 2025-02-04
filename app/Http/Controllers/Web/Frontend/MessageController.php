<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class MessageController extends Controller {
    /**
     * Display the chat message page.
     *
     * @return View
     */
    public function index(): View {
        return view('frontend.layouts.chat.index');
    }
}
