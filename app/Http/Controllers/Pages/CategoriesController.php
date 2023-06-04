<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Models\CategoriesBooks;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    public function index()
    {
        $allCategories = CategoriesBooks::latest()->get();
        return view("pages.categories.index")->with('allCategories', $allCategories);
    }
    public function create()
    {
        return view("pages.categories.create");
    }
    public function store(Request $request)
    {
        Session::flash('name', $request->name);

        $request->validate([
            'name' => 'required|unique:categories_books,name'
        ], [
            'name.required' => 'name cannot be blank',
            'name.unique' => 'name already taken'
        ]);

        $data = [
            'name' => $request->name,
        ];

        CategoriesBooks::create($data);
        return redirect()->to('perpus/categories')->with('success', 'Added data successfully');
    }
    public function show(Request $request, string $id)
    {
    }

    public function edit(string $id)
    {
        return "HI";
    }

    public function update(Request $request, string $id)
    {
    }

    public function destroy($id)
    {
    }
}
