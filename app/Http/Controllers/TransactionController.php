<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransferPaymentMail;
use App\Models\Transaction;
use App\Models\User;

class TransactionController extends Controller
{
    public function show($id)
    {
        $transaction = Transaction::where('id', $id)->where('is_paid', 0)->firstOrFail();
        $user = User::find($transaction->user_id);

        return view('pages.dashboard._transfer-payment', compact('transaction', 'user'));
    }

    public function store(Request $request)
    {
        $transaction = Transaction::find($request->id);
        $user = User::find($transaction->user_id);

        $transaction->update($request->all());

        $transaction_info = array(
            'full_name' => $user->firstname . ' ' . $user->lastname,
            'email' => $user->email,
            'phone' => $user->phone,
            'payment' => $transaction->payment,
            'mode_of_payment' => $transaction->mode_of_payment,
        );

        Mail::to($user->email)->send(new TransferPaymentMail($transaction_info));

        return redirect()->route('dashboard.index')->with('success', 'You have successfully transferred the payment');
    }
}
