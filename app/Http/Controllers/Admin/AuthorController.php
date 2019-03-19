<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return view('admin.author.index', compact('authors'));
    }

    public function create()
    {
        return view('admin.author.create');
    }

    public function store(Request $request)
    {
        $author = Author::create(['name' => $request->name]);

        $redirect_arr = [
            'edit' => route('admin.author.edit', ['author' => $author->id]),
            'create' => route('admin.author.create')
        ];

        return redirect($redirect_arr[$request->redirect]);
    }

    public function edit(Author $author)
    {
        return view('admin.author.edit', compact('author'));
    }

    public function destroy(Request $request, Author $author)
    {
        $author->delete();

        if ($request->has("redirect")) {
            return redirect($request->redirect);
        }

        return redirect()->back();
    }

    public function update(Request $request, Author $author)
    {
        $author->update($request->all());
        return redirect()->route('admin.author.index');
    }
}
