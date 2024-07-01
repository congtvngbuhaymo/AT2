<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Under;
use App\Models\Employ;
use App\Models\Unemploy;

class DashboardController extends Controller
{
    public function index()
    {
        $Alumni = Alumni::count();
        $Under = Under::count();
        $Employ = Employ::count();
        $Unemploy = Unemploy::count();

        return view('dashboard', compact('Alumni', 'Under', 'Employ', 'Unemploy'));
    }
}
