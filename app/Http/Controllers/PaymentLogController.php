<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentLog;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class PaymentLogController extends Controller
{
    public function index($id) {
        $tenant = Tenant::findorfail($id);

        $paymentLogs = PaymentLog::where('tenant_id', $id)->orderBy('date', 'desc')->get();

        $user = User::where('id', $tenant->user_id)->first();
        $data = compact('user', 'paymentLogs', 'tenant');

        return view('landowner.main.paymentLog', $data);
    }

    public function create(Request $request, $id) {
        $request->validate([
            'amount' => 'required|numeric|gt:0',
            'date' => 'required|date|before:now'
        ]);

        $paymentLog = new PaymentLog($request->all());
        $paymentLog->tenant_id = $id;
        $paymentLog->save();

        return redirect(route('paymentLog', ['id' => $id]))->with('success', 'yey');
    }
}
