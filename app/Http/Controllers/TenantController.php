<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;

class TenantController extends Controller
{
    public function getTenants() {
        // Auth()->user->id;
        return Tenant::all();
    }
}
