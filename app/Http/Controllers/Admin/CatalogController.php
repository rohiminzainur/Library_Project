<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        // Role::create(['name'=>'writer']);
        // Permission::create(['name'=>'edit catalog']);
        // auth()->user()->givePermissionTo('edit catalog');
        // auth()->user()->assignRole('writer');
        // return auth()->user()->permissions;
            $catalogs = Catalog::with('books')->get();
    
            // return $catalogs;
            return view('pages.admin.catalog.index', compact('catalogs'));
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.catalog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required|max:255'
    ]);
        // Cara Pertama 1
        // $catalog = new Catalog;
        // $catalog->name = $request->name;
        // $catalog->save();

        // Cara Kedua 2
        Catalog::create($request->all());

        return redirect('admin/catalogs')->with('success', 'Data Telah Ditambahkan!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function show(Catalog $catalog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function edit(Catalog $catalog)
    {
        return view('pages.admin.catalog.edit', compact('catalog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catalog $catalog)
    {
        $request->validate([
        'name' => 'required|max:255'
    ]);
        $catalog->update($request->all());

        return redirect('admin/catalogs')->with('success', 'Data Telah Diupdate!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catalog $catalog)
    {
        $catalog->delete($catalog->id);

        return redirect('admin/catalogs')->with('success', 'Data Telah Dihapus!!');
    }
}