<?php

namespace App\Http\Controllers;

use App\Designation;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Displays dashboard
     *
     */
    public function index()
    {
        // Data for pie chart
        $data = Designation::select('title as name')->withCount('employees as value')->get()->toArray();
        return view('admin.index', ['Data' => $data]);
    }
}
