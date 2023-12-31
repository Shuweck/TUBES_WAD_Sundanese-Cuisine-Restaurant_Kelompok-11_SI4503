<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Reserve;
use App\Models\Tables;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(){

        $meja = session('meja');

        // $reserve = Reserve::where('table_id', $meja)->first();

        // $orders = Orders::where('reserve_id', $reserve->id)->get();
        $meja = session('meja');

        // ambil daftar pesanan sesuai table id dan yang berstatus 0
        $reserve = Reserve::where('table_id', $meja)->where('status', 0)->first();

        // ambil semua daftar order yang dipesan sesuai meja
        $orders = Orders::where('reserve_id', $reserve->id)->get();

        // ambil semua daftar meja
        $table = Tables::where('id', $meja)->first();

        return view('pages.order', compact('orders', 'table','reserve'));
    }


    public function indexWaiter(){
        return view('pages.waiter.index');
    }

    public function orderStore(Request $request){

        // dd($request);

        $listPesanan = $request->list_pesanan;
        $arrayPesanan = json_decode($listPesanan, true);

        $totalHarga = $request->total_price;

        // Fungsi untuk menghasilkan huruf acak
        function generateRandomLetter() {
            // ASCII value of 'A' is 65, 'Z' is 90
            return chr(rand(65, 90));
        }

        // Fungsi untuk menghasilkan angka acak
        function generateRandomNumber() {
            return rand(0, 9);
        }

        // Menghasilkan bagian huruf acak
        $randomLetters = generateRandomLetter() . generateRandomLetter() . generateRandomLetter();

        // Menghasilkan bagian angka acak
        $randomNumbers = generateRandomNumber() . generateRandomNumber() . generateRandomNumber();

        $reserve = new Reserve();

        $reserve->transaksi_id = 'TRX-'. $randomNumbers . "-" . $randomLetters;
        $reserve->table_id = $request->table;
        $reserve->total_harga = $totalHarga;
        $reserve->status = "menunggu";

        $reserve->save();

        foreach ($arrayPesanan as $pesanan) {
            $order = new Orders();
            $order->reserve_id = $reserve->id;
            $order->menu_id = $pesanan['id'];
            $order->quantity = $pesanan['quantity'];
            $order->status = 'antri';
            $order->save();
        }

        // bentuk session di session storage sesuai nomor meja
        session(['meja' => $request->table]);

        return redirect()->route('order');
    }

    public function finishOrder(Request $request){

        $meja = session('meja');

        // ambil daftar pesanan sesuai table id dan yang berstatus 0
        $reserve = Reserve::where('table_id', $meja)->where('status', "menunggu")->first();

        // update status menjadi 1
        $reserve->status = "kekasir";
        $reserve->save();

        // hapus session meja
        $request->session()->forget('meja');

        // back ke home dengan status finish
        return redirect()->route('home')->with('finish', 'Silahkan ke kasir untuk membayar pesanaan dengan total '.$reserve->total_harga);

    }

}
