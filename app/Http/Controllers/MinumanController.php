<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class MinumanController extends Controller
{

    public function indexAdminMinuman()
    {

        // get all menu type Minuman
        $minuman = \App\Models\Menu::where('type', 'drink')->get();

        // return view
        return view('pages.admin.menu.minuman.index', [
            'minuman' => $minuman,
        ]);
    }

    public function showFormTambahAdminMinuman()
    {
        return view('pages.admin.menu.minuman.add');
    }

    public function addAdminMinuman(Request $request){
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
        $image->move(public_path('images/menu/minuman'), $imageName);

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
        $menu->image = '/images/menu/minuman/' . $imageName;

        // set menu type
        $menu->type = 'drink';

        // set menu stock
        $menu->stock = $request->stock;

        // status
        $menu->status = true;

        // save menu
        $menu->save();

        // redirect to admin menu Minuman
        return redirect()->route('admin.menu.minuman')->with('add', 'Item successfully deleted.');;
    }

    public function detailAdminMinuman($slug){

        // get menu by slug
        $minuman = \App\Models\Menu::where('slug', $slug)->first();

        // return view
        return view('pages.admin.menu.minuman.detail', [
            'minuman' => $minuman,
        ]);
    }

    public function editDetailAdminMinuman($slug) {

        // get menu by slug
        $minuman = \App\Models\Menu::where('slug', $slug)->first();

        // return view
        return view('pages.admin.menu.minuman.edit', [
            'minuman' => $minuman,
        ]);
    }

    public function editAdminMinuman(Request $request, $slug){

        // get menu by slug
        $minuman = \App\Models\Menu::where('slug', $slug)->first();

        // set menu name
        $minuman->name = $request->name;

        // set menu slug
        $minuman->slug = \Str::slug($request->name);

        // set menu price
        $minuman->price = $request->price;

        // set menu description
        $minuman->description = $request->description;

        // set menu type
        $minuman->type = 'drink';

        // set menu stock
        $minuman->stock = $request->stock;

        // status
        // jika tersedia maka true dan sebaliknya
        if ($request->status == 'tersedia') {
            $minuman->status = true;
        } else {
            $minuman->status = false;
        }

        // check if request image is not null
        if ($request->file('image') != null) {

            // hapus file lama
            unlink(public_path($minuman->image));

            // get image
            $image = $request->file('image');

            // get name image
            $imageName = time().'.'.$image->extension();

            // move image to public folder
            $image->move(public_path('images/menu/minuman'), $imageName);

            // set menu image
            $minuman->image = '/images/menu/minuman/' . $imageName;

        }

        // save menu
        $minuman->save();

        // redirect to admin menu Minuman
        return redirect()->route('admin.menu.minuman')->with('edit', 'Item successfully deleted.');;

    }

    public function deleteAdminMinuman($slug){

        // get menu by slug
        $minuman = \App\Models\Menu::where('slug', $slug)->first();

        try{
            $minuman->delete();
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Menu tidak dapat dihapus karena sudah terdapat di transaksi');
        }

        // hapus file lama
        unlink(public_path($minuman->image));

        // delete menu

        // redirect to admin menu minuman$minuman
        return redirect()->route('admin.menu.minuman')->with('delete', 'Item successfully deleted.');;
    }

}
