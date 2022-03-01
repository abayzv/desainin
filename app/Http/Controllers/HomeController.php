<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Desain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        Cookie::queue('user', 'Aji Bayu Nugroho', 365 * 24 * 60 * 60);
        $desain = Desain::all();
        $categories = Category::all();

        if ($request->search) {
            $desain = Desain::where('name', 'like', '%' . $request->search . '%')->get();
        }

        if ($request->category) {
            $cat_id = Category::where('name', $request->category)->first()->id;
            $desain = Desain::where('category', $cat_id)->get();
        }

        return view('index', compact(['desain', 'categories']));
    }
}
