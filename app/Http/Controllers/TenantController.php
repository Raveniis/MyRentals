<?php

namespace App\Http\Controllers;

use App\Models\HouseRental;
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
        })->with('tenantApplication', 'user', 'tenantApplication.houseRental')
          ->orderBy('status', 'desc')
          ->paginate(10);

        return view('landowner.main.tenant')->with('tenants', $tenants);
    }

    public function removeTenant($id) {
        Tenant::findorfail($id)->update([
            'status' => 0,
        ]);

        
        $tenant = Tenant::with('tenantApplication')->findorfail($id);

        $houseRentalId =  $tenant->tenantApplication->rental_id;

        HouseRental::findorfail($houseRentalId)->update(['status' => 1]);

        return redirect(route('tenants'))->with('success', 'Tenant has been successfully removed');
    }
}
