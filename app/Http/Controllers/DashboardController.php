<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HouseRental;
use App\Models\TenantApplication;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{
    public function dashboard(){
        $user_id = auth()->user()->id;

        $houseRentalCount = HouseRental::whereHas('user', function($query) use ($user_id) {
            $query->where('id', $user_id);
        })->count();

        $applicantsCount =  $tenantApplications =  TenantApplication::whereHas('houseRental', function($query) use ($user_id){
            $query->where('user_id', $user_id);  //palit user id nalang
        })->count(); 

        $data = compact('houseRentalCount', 'applicantsCount'); 

        return view('landowner.main.dashboard', $data);
    }
}
