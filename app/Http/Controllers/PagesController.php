<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function rules(Request $request)
    {
        return Inertia::render('Rules', [
        ]);
    }
}
