<?php

namespace App\Http\Controllers;

use App\Models\Tables;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {

        $meja = session('meja');

        // ambil data makanaan
        $makanan = \App\Models\Menu::where('type', 'food')->get();

        // ambil data minuman
        $minuman = \App\Models\Menu::where('type', 'drink')->get();

        // return view
        return view('home', [
            'makanan' => $makanan,
            'minuman' => $minuman,
            'meja' => $meja,
        ]);

    }

    public function cart()
    {
        $table = new Tables();

        // get all table
        $tables = $table->all();

        return view('pages.cart', [
            'tables' => $tables,
        ]);
    }

    public function indexAdmin()
    {
        return view('pages.admin.dashboard');
    }

    public function indexPengelola()
    {
        return view('pages.pengelola.dashboard');
    }

}
