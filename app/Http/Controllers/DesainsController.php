<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Desain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DesainsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $desain = Desain::paginate('10');
        $categories = Category::all();
        return view('desain.index', compact(['desain', 'categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('desain.create', compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Validated = $request->validate([
            'file' => 'required|image|max:1024',
            'name' => 'required'
        ]);

        $File = $request->file('file');
        $FileName = $File->getClientOriginalName();
        $Upload = Storage::disk('public')->putFileAs('logo', $File, $FileName);

        $File2 = $request->file('link');
        $FileName2 = $File2->getClientOriginalName();
        $Upload2 = Storage::disk('public')->putFileAs('file', $File2, $FileName2);


        Desain::create([
            'thumbnail' => $FileName,
            'name' => $request->name,
            'category' => $request->category,
            'link' => $FileName2,
        ]);

        return redirect('/desain');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $desain = Desain::find($id);
        $categories = Category::all();
        return view('desain.edit', compact(['desain', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ($request->thumbnail) {
            Desain::where('id', $id)->update([
                'thumbnail' => $request->thumbnail,
                'name' => $request->name,
                'category' => $request->category,
                'link' => $request->category,
            ]);
        } else {
            Desain::where('id', $id)->update([
                'name' => $request->name,
                'category' => $request->category,
                'link' => $request->category,
            ]);
        }
        return redirect(route('desain.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Desain::where('id', $id)->delete();
        return redirect('/desain');
    }
}
