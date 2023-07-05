<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Jobs\DepositJob;
use App\Jobs\WithdrawalJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function deposit(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'amount' => 'required|numeric',
            'timestamp' => 'required|date_format:Y-m-d H:i:s',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user_id = ($request->user_id) ?? 1;
        $user = User::findOrFail($user_id);

        $response = [
            'order_id' => $request->order_id,
            'amount' => $request->amount,
            'status' => 1,
        ];

        dispatch(new DepositJob($user, $request->amount));

        return response()->json($response, 200);
    }

    public function withdrawal(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'amount' => 'required|numeric',
            'timestamp' => 'required|date_format:Y-m-d H:i:s',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user_id = ($request->user_id) ?? 1;
        $user = User::findOrFail($user_id);

        $response = [
            'order_id' => $request->order_id,
            'amount' => $request->amount,
            'status' => 1,
        ];

        dispatch(new WithdrawalJob($user, $request->amount));

        return response()->json($response, 200);
    }
}
