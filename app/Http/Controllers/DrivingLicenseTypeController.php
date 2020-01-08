<?php

namespace App\Http\Controllers;

use App\DrivingLicenseType;

class DrivingLicenseTypeController extends Controller
{
    public function index()
    {
        return DrivingLicenseType::select(['code', 'name', 'icon'])->get();
    }
}
