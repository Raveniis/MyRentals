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
    public function getTenantApplication() {
        $user_id = auth()->user()->id;
 
        $tenantApplications =  TenantApplication::whereHas('houseRental', function($query) use ($user_id){
            $query->where('user_id', $user_id);  //palit user id nalang
        })->with('houseRental', 'user')->paginate(10);

        // return $tenantApplications;
        return view('landowner.main.application')->with('tenantApplications', $tenantApplications);
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
    public function apply(Request $request, $id) {
        $validatedData = Validator::make($request->all(), [
            'occupants_number' => 'required|numeric|max:8',
            'move_in_date' => 'required|date|after:today',
            'lease_term' => 'required|numeric|max:8',
            'monthly_income' => 'required|numeric',
            'employment_status' => 'required|in:employed,unemployed',
        ]);

        if($validatedData->fails()){
            return response()->json(['error' => $validatedData->errors()]);
        }
        
        //check if house rental exist
        HouseRental::findorfail($id);

        $tenantApplication = new TenantApplication($validatedData->validated());
        // $tenantApplication->tenant_id = Auth()->user()->id;
        $tenantApplication->tenant_id = 2;
        $tenantApplication->rental_id = $id;
        $tenantApplication->save();

        return response()->json(['success' => 'item has been created']);

    }
}
