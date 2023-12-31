<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // get all transaction
        $transaction_true = Reserve::where('status', "terbayar")->get();

        // dapat semua transaksi yang berstatus false serta pastikan semua order yang berelasi status selesai
        $transaction_false = Reserve::where('status', "kekasir")->whereHas('order', function($query){
            $query->where('status', "selesai");
        })->get();

        // return view
        return view('pages.admin.transaction.index', [
            'transaction_true' => $transaction_true,
            'transaction_false' => $transaction_false,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $transaksi_id)
    {

        // cari reserve berdasarkan transaksi_id
        $transaksi = Reserve::where('transaksi_id', $transaksi_id)->first();

        // // return view
        return view('pages.admin.transaction.detail', [
            'transaksi' => $transaksi,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

    }

    public function pay(Request $request, string $transaksi_id){

        // cari reserve berdasarkan transaksi_id
        $transaksi = Reserve::where('transaksi_id', $transaksi_id)->first();

        // jika uang bayar kurang maka beri warning
        if($transaksi->total_harga > $request->uang_bayar){
            return redirect()->back()->with('warning', 'Uang bayar kurang');
        }

        // jika uang bayar lebih maka beri kembalian
        if($transaksi->total_harga < $request->uang_bayar){
            $transaksi->uang_kembali = $request->uang_bayar - $transaksi->total_harga;
        }

        // ubah status menjadi 1
        $transaksi->status = "terbayar";

        // simpan transaksi
        $transaksi->save();

        // return view
        return redirect()->route('transaction.index')->with('success', 'Costumer membayar '.$request->uang_bayar.' dengan total '.$transaksi->total_harga.' maka kembalianya adalah '.$transaksi->uang_kembali);

        // // jika uang bayar lebih maka beri kembalian
        // if($transaksi->total < $transaksi->uang_bayar){
        //     $transaksi->kembalian = $transaksi->uang_bayar - $transaksi->total;
        // }

        // return view
        // return redirect()->route('transaction.index');

    }
}

