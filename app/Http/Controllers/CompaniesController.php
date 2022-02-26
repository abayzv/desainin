<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Company;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Companies = Company::paginate('10');
        return view('companies.index', compact(['Companies']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
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

      Company::create([
        'name' => $request->name,
        'logo' => $FileName,
        'address' => $request->address,
        'website' => $request->website,
        'email' => $request->email,
      ]);

      return redirect('/companies');
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
      $Company = Company::find($id);
      return view('companies.edit', compact(['Company']));
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
       Company::where('id', $id)->update([
        'name' => $request->name,
        'logo' => $request->logo,
        'address' => $request->address,
        'website' => $request->website,
        'email' => $request->email,
      ]);
      return redirect(route('companies.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Company::where('id', $id)->delete();
        return redirect('/companies');
    }
}
