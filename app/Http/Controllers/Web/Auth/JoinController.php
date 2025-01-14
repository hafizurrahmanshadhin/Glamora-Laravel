<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class JoinController extends Controller {
    /**
     * Display the join view.
     */
    public function create(): View {
        return view('auth.layouts.join');
    }
}
