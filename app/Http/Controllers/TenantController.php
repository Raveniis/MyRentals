<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;

class TenantController extends Controller
{
    public function getTenants() {
        $user_id = auth()->user()->id;
        // return Tenant::with('tenantApplication')->get();
        $tenants = Tenant::whereHas('tenantApplication', function($query) use ($user_id) {
            $query->whereHas('houseRental', function($query) use ($user_id) {
                $query->where('user_id',  $user_id);
            });
        })->with('tenantApplication', 'user', 'tenantApplication.houseRental')->paginate(10);

        return view('landowner.main.tenant')->with('tenants', $tenants);
    }
}
