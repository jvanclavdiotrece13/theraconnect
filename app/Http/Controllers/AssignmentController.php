<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssignmentController extends Controller
{
      public function index()
{
    return view('assignments'); // This tells Laravel to load assignments.blade.php
}
}
