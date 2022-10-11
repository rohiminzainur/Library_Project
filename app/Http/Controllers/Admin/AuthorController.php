<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;


class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.admin.author.index');
    }

    public function api()
    {
        $authors = Author::all();

        // foreach ($authors as $key => $author) {
        //     $author->date = convert_date($author->created_at);
        // }
        
        $datatables = datatables()->of($authors)
        ->addColumn('date', function($author) {
            return convert_date($author->created_at);
        })->addIndexColumn();

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('pages.admin.author.create');
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
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|max:15',
            'address' => 'required'
        ]);

        Author::create($request->all());

        return redirect('admin/authors')->with('success', 'Data Telah Ditambahkan!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('pages.admin.author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
            $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|max:15',
            'address' => 'required'
        ]);

        $author->update($request->all());

        return redirect('admin/authors')->with('success', 'Data Telah di Update!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete($author->id);

        return redirect('admin/authors')->with('success', 'Data Telah Dihapus!!');
    }
}