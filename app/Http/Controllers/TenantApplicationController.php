<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TenantApplication;
use App\Models\HouseRental;
use App\Models\Tenant;
use Database\Seeders\TenantApplicationSeeder;
use GuzzleHttp\Psr7\Query;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TenantApplicationController extends Controller
{
    public function applicationForm($id) {
        $rentals = HouseRental::findorfail($id);

        if($rentals->status === 0) {
            return redirect(route('houseRentals', ['id' => $id]))->with("notAvailable", 'no');
        }

        return view('user.main.applicationForm')->with('houseRental', $rentals);
    }
    public function getTenantApplication() {
        $user_id = auth()->user()->id;
 
        $tenantApplications =  TenantApplication::whereHas('houseRental', function($query) use ($user_id){
            $query->where('user_id', $user_id);  //palit user id nalang
        })->with('houseRental', 'user')->orderby('created_at', 'desc')->paginate(10);

        // return $tenantApplications;
        return view('landowner.main.application')->with('tenantApplications', $tenantApplications);
    }

    public function userApplicationStatus() {
        $user_id = auth()->user()->id;
 
        $tenantApplications =  TenantApplication::where('tenant_id', $user_id)->with('houseRental')->withTrashed()->orderby('created_at', 'desc')->paginate(10);

        // return $tenantApplications;
        return view('user.main.application')->with('tenantApplications', $tenantApplications);
    }

    public function accept($id) {
        $tenantApplication = TenantApplication::findorfail($id);

        if($tenantApplication->application_status !== 'pending')
        {
            return response()->json(['error' => 'oops']);
        }

        $tenantApplication->update([
            'application_status' => 'accepted'
        ]);

        $user_id = auth()->user()->id;
        //reject the rest of the application related to the house rentals
        TenantApplication::whereHas('houseRental', function($query) use ($user_id){
            $query->where('user_id', $user_id);  //palit user id nalang
        })->where('rental_id', $tenantApplication->rental_id)
          ->where('application_status', 'pending')
          ->update([
            'application_status' => 'rejected'
          ]);

        HouseRental::where('id', $tenantApplication->rental_id)->update(['status' => 0]);  //set to inactive
          
        //create new tenant
        $tenant = new Tenant();
        $tenant->user_id = $tenantApplication->tenant_id;
        $tenant->application_id = $id;
        $tenant->save();

        return redirect(route('applications'))->with('success', 'Tenant application has been accepted.');
    }

    public function reject($id) {
        $tenantApplication = TenantApplication::findorfail($id);

        if($tenantApplication->application_status !== 'pending')
        {
            return response()->json(['error' => 'oops']);
        }

        $tenantApplication->update([
            'application_status' => 'rejected'
        ]);


        return redirect(route('applications'))->with('success', 'Tenant application has been rejected.');
    }

    public function delete($id){
        $tenantApplication = TenantApplication::findorfail($id)->delete(); //for improvement purposes kaya naka store sa variable

        return redirect(route('applications'))->with('success', 'Tenant application has been archived.');
    }

    public function show($id) {
        $tenant = TenantApplication::with('user', 'houseRental')->findorfail($id);

        return view('landowner.main.applicationReview')->with('tenant', $tenant);
    }

    public function apply(Request $request, $id) {
        $rentals = HouseRental::findorfail($id);

        $request->validate([
            'occupants_number' => 'required|numeric|max:' . $rentals->maximum_occupants,
            'move_in_date' => 'required|date|after:today',
            'lease_term' => 'required|numeric|min:12|max:60',
            'monthly_income' => 'required|numeric',
            'employment_status' => 'required|in:employed,unemployed',
            'emergency_num' => 'required|size:11|regex:/(09)[0-9]{9}/',
        ]);
        
        //check if house rental exist
        

        $user_id = auth()->user()->id;

        $tenantApplication = new TenantApplication($request->all());
        // $tenantApplication->tenant_id = Auth()->user()->id;
        $tenantApplication->tenant_id = $user_id;
        $tenantApplication->rental_id = $id;
        $tenantApplication->save();

        return redirect(route('houseRentals', ['id' => $id]))->with(['success' => 'item has been created']);

    }
}
