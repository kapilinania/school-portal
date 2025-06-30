<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Home Page
    public function index()
    {
        return view('basic.index');  // Look for resources/views/basic/index.blade.php
    }

    // About Page
    public function about()
    {
        return view('basic.about');  // Look for resources/views/basic/about.blade.php
    }

    // Contact Page
    public function contact()
    {
        return view('basic.contact');  // Look for resources/views/basic/contact.blade.php
    }

    // Course Page
    public function course()
    {
        return view('basic.course');  // Look for resources/views/basic/course.blade.php
    }

    // Detail Page
    public function detail()
    {
        return view('basic.detail');  // Look for resources/views/basic/detail.blade.php
    }

    // Feature Page
    public function feature()
    {
        return view('basic.feature');  // Look for resources/views/basic/feature.blade.php
    }

    // Team Page
    public function team()
    {
        return view('basic.team');  // Look for resources/views/basic/team.blade.php
    }

    // Testimonials Page
    public function testimonial()
    {
        return view('basic.testimonial');  // Look for resources/views/basic/testimonial.blade.php
    }

    public function enroll()
    {
        // Logic for enrolling a user
        return view('enroll'); // Ensure you have an `enroll.blade.php` view
    }

    
}
