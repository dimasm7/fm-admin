<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Exception;

class TransactionController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $food_id = $request->input('food_id');
        $status = $request->input('status');

        if($id){
            $transaction = Transaction::with(['food', 'user'])->find($id); //'food','user' dari model transaction

            if($transaction){
                return ResponseFormatter::success($transaction, 'Data transaction berhasil diambil');
            }else{
                return ResponseFormatter::error(null, 'Data transaction tidak ada', 404);
            }
        }

        $transaction = Transaction::with(['food', 'user'])->where('user_id', Auth::user()->id);

        if($food_id){
            $transaction->where('name',$food_id);
        }

        if($status){
            $transaction->where('status',$status);
        }

        return ResponseFormatter::success(
            $transaction->paginate($limit), 'Data list transaksi berhasil diambil'
        );
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id); //ambil data berdasarkan id

        $transaction->update($request->all());

        return ResponseFormatter::success($transaction, 'Transaksi berhasil diperbarui');
    }

    public function chexkout(Request $request)
    {
        $request->validate([
            'food_id' => 'required|exists:food,id',
            'user_id' => 'required|exists:user,id',
            'quantity' => 'required',
            'total' => 'required',
            'status' => 'required',
        ]);

        $transaction = Transaction::create([
            'food_id' => $request->food_id,
            'user_id' => $request->user_id,
            'quantity' => $request->quantity,
            'total' => $request->total,
            'status' => $request->status,
            'payment_url' => ''
        ]);

        //konfigurasi midtrans
        Config::$serverKey = config('services.modtrans.serverKey');
        Config::$isProduction = config('services.modtrans.isProduction');
        Config::$isSanitized = config('services.modtrans.isSanitized');
        Config::$is3ds = config('services.modtrans.is3ds');

        $transaction = Transaction::with(['food','user'])->find($transaction->id);

        //create transaksi midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $transaction->id,
                'gross_amount' => (int) $transaction->total,
            ],
            'customer_details' => [
                'first_name' => $transaction->user->name,
                'email' => $transaction->user->email
            ],
            'enabled_payments' => ['gopay', 'bank_transfer'],
            'vtweb' => []
        ];

        //call midtrans
        try {
            //get halaamn ayment
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            $transaction->payment_url = $paymentUrl;
            $transaction->save();

            //mengenbalikan data ke Api
            return ResponseFormatter::success($transaction, 'Transaksi berhasil');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 'Transaksi gagal');
        }

    }
}
