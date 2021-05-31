<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        //set konfiguration
        Config::$serverKey = config('services.modtrans.serverKey');
        Config::$isProduction = config('services.modtrans.isProduction');
        Config::$isSanitized = config('services.modtrans.isSanitized');
        Config::$is3ds = config('services.modtrans.is3ds');

        //create instance midtrans notifikasi
        $notification = new Notification();

        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id= $notification->order_id;

        //cari transaksi berdasrkan id
        $transaction = Transaction::findOrFail($order_id);

        //handle notifikasi status midtrans
        if($status == 'capture')
        {
            if($type == 'credit_card')
            {
                if($fraud == 'challenge')
                {
                    $transaction->status = 'PENDING';
                }
                else
                {
                    $transaction->status = 'SUCCESS';
                }
            }
        }
        else if($status == 'settlement')
        {
            $transaction->status = 'SUCCESS';
        }
        else if($status == 'pending')
        {
            $transaction->status = 'PENDING';
        }
        else if($status == 'deny')
        {
            $transaction->status = 'CANCELLED';
        }
        else if($status == 'expire')
        {
            $transaction->status = 'CANCELLED';
        }
        else if($status == 'cancel')
        {
            $transaction->status = 'CANCELLED';
        }

        $transaction->save();
    }

    public function success()
    {
        return view('midtrans.success');
    }

    public function unfinish()
    {
        return view('midtrans.unfinish');
    }
    
    public function error()
    {
        return view('midtrans.error');
    }
}
