<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 1. Tampil Semua Data (GET)
    public function index()
    {
        $products = Product::with(['category', 'user'])->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Data produk berhasil diambil',
            'data' => $products
        ]);
    }

    // 2. Tambah Data Baru (POST)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id'
        ]);

        $product = Product::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil ditambahkan',
            'data' => $product
        ], 201);
    }

    // 3. Tampil Detail Satu Data (GET)
    public function show($id)
    {
        $product = Product::with(['category', 'user'])->find($id);

        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Produk tidak ditemukan'], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail produk berhasil diambil',
            'data' => $product
        ]);
    }

    // 4. Update Data (PUT/PATCH)
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Produk tidak ditemukan'], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
            'quantity' => 'sometimes|required|integer|min:0',
            'price' => 'sometimes|required|numeric|min:0',
            'user_id' => 'sometimes|required|exists:users,id'
        ]);

        $product->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil diupdate',
            'data' => $product
        ]);
    }

    // 5. Hapus Data (DELETE)
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Produk tidak ditemukan'], 404);
        }

        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil dihapus'
        ]);
    }
}