<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Data kategori berhasil diambil',
            'data' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        $category = Category::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Kategori berhasil ditambahkan',
            'data' => $category
        ], 201);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['status' => 'error', 'message' => 'Kategori tidak ditemukan'], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail kategori berhasil diambil',
            'data' => $category
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['status' => 'error', 'message' => 'Kategori tidak ditemukan'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        $category->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Kategori berhasil diupdate',
            'data' => $category
        ]);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['status' => 'error', 'message' => 'Kategori tidak ditemukan'], 404);
        }

        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Kategori berhasil dihapus'
        ]);
    }
}