<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Guide;

class AboutController extends Controller
{
    public function index()
    {
        // Get active tour guides for team section
        $guides = Guide::where('is_active', true)
            ->latest()
            ->get();

        return view('common.about', compact('guides'));
    }
}