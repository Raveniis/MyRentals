<?php

namespace App\Http\Controllers;

use App\Models\HouseRental;
use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\TenantApplication;

class TenantController extends Controller
{
    public function getTenants() {
        $user_id = auth()->user()->id;
        // return Tenant::with('tenantApplication')->get();
        $tenants = Tenant::whereHas('tenantApplication', function($query) use ($user_id) {
            $query->withTrashed()->whereHas('houseRental', function($query) use ($user_id) {
                $query->where('user_id',  $user_id);
            });
        })->with(['tenantApplication' => function($query) {
            $query->withTrashed(); // Include soft-deleted tenantApplication
        }, 'user', 'tenantApplication.houseRental'])
        ->orderBy('status', 'desc')
        ->paginate(10);

        return view('landowner.main.tenant')->with('tenants', $tenants);
    }

    public function userTenant() {
        $user_id = auth()->user()->id;
        // return Tenant::with('tenantApplication')->get();
        $tenants = Tenant::where('user_id', $user_id)->with('tenantApplication.houseRental')
                                                ->orderBy('status', 'desc')
                                                ->get();

        return view('user.main.history')->with('tenants', $tenants);
    }

    public function show($id) {
        $tenant = Tenant::with('tenantApplication', 'user', 'tenantApplication.houseRental')->findorfail($id);

        // return $tenant;
        return view('landowner.main.editTenant')->with('tenant', $tenant);
    }

    public function edit(Request $request, $id) {
        $request->validate([
            'lease_term' => 'required|numeric|gt:0',
            'occupants_number' => 'required|numeric|gt:0',
            'remarks' => 'nullable|max:128'
        ]);

        Tenant::findOrFail($id)->update(['remarks' => $request->remarks]);

        $tenant = Tenant::findOrFail($id);

        TenantApplication::findorfail($tenant->application_id)->update([
            'lease_term' => $request->lease_term,
            'occupants_number' => $request->occupants_number,
        ]);

        // return $tenant;
        return redirect(route('tenants.show', ['id' => $id]))->with('success', 'tenant has been updated');
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

    public function delete($id) {
        Tenant::findorfail($id)->delete();

        return redirect(route('tenants'))->with('archived', 'Tenant has been archived');
    }
}
