<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $customerReviews = \App\Models\CustomerReview::where('status', 'approved')->orderBy('created_at', 'desc')->take(6)->get();
        $teamMembers = \App\Models\TeamMember::orderBy('created_at', 'desc')->get();
        return view('website.about', compact('customerReviews', 'teamMembers'));
    }
}
