<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Exception;
use Illuminate\Http\Request;

class MakananController extends Controller
{

    public function indexAdminMakanan()
    {

        // get all menu type makanan
        $makanan = Menu::where('type', 'food')->get();

        // return view
        return view('pages.admin.menu.makanan.index', [
            'makanan' => $makanan,
        ]);
    }

    public function showFormTambahAdminMakanan()
    {
        return view('pages.admin.menu.makanan.add');
    }

    public function addAdminMakanan(Request $request){
        // validate request
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'stock' => 'required'
        ]);

        // get image
        $image = $request->file('image');

        // get name image
        $imageName = time().'.'.$image->extension();

        // move image to public folder
        $image->move(public_path('images/menu/makanan'), $imageName);

        // create new menu
        $menu = new \App\Models\Menu;

        // set menu name
        $menu->name = $request->name;

        // set menu slug
        $menu->slug = \Str::slug($request->name);

        // set menu price
        $menu->price = $request->price;

        // set menu description
        $menu->description = $request->description;

        // set menu image
        $menu->image = '/images/menu/makanan/' . $imageName;

        // set menu type
        $menu->type = 'food';

        // set menu stock
        $menu->stock = $request->stock;

        // status
        $menu->status = true;

        // save menu
        $menu->save();

        // redirect to admin menu makanan
        return redirect()->route('admin.menu.makanan')->with('add', 'Item successfully deleted.');
    }

    public function detailAdminMakanan($slug){

        // get menu by slug
        $makanan = \App\Models\Menu::where('slug', $slug)->first();

        // return view
        return view('pages.admin.menu.makanan.detail', [
            'makanan' => $makanan,
        ]);
    }

    public function editDetailAdminMakanan($slug) {

        // get menu by slug
        $makanan = \App\Models\Menu::where('slug', $slug)->first();

        // return view
        return view('pages.admin.menu.makanan.edit', [
            'makanan' => $makanan,
        ]);
    }

    public function editAdminMakanan(Request $request, $slug){

        // get menu by slug
        $makanan = \App\Models\Menu::where('slug', $slug)->first();

        // set menu name
        $makanan->name = $request->name;

        // set menu slug
        $makanan->slug = \Str::slug($request->name);

        // set menu price
        $makanan->price = $request->price;

        // set menu description
        $makanan->description = $request->description;

        // set menu type
        $makanan->type = 'food';

        // set menu stock
        $makanan->stock = $request->stock;

        // status
        // jika tersedia maka true dan sebaliknya
        if ($request->status == 'tersedia') {
            $makanan->status = true;
        } else {
            $makanan->status = false;
        }

        // check if request image is not null
        if ($request->file('image') != null) {

            // hapus file lama
            unlink(public_path($makanan->image));

            // get image
            $image = $request->file('image');

            // get name image
            $imageName = time().'.'.$image->extension();

            // move image to public folder
            $image->move(public_path('images/menu/makanan'), $imageName);

            // set menu image
            $makanan->image = '/images/menu/makanan/' . $imageName;

        }

        // save menu
        $makanan->save();

        // redirect to admin menu makanan
        return redirect()->route('admin.menu.makanan')->with('edit', 'Item successfully deleted.');

    }

    public function deleteAdminMakanan($slug){

        // get menu by slug
        $makanan = \App\Models\Menu::where('slug', $slug)->first();


        try{
            $makanan->delete();
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Menu tidak dapat dihapus karena sudah terdapat di transaksi');
        }

        // hapus file lama
        unlink(public_path($makanan->image));

        // delete menu

        // redirect to admin menu makanan

        // back to with delete
        return redirect()->route('admin.menu.makanan')->with('delete', 'Item successfully deleted.');
    }

}
