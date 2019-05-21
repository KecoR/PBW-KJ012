<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

class CategoryController extends Controller
{
    /**
     * Action untuk menampilkan semua kategori
     */
    public function index(){
        // $daftar_kategori = Category::all();
        $daftar_kategori = Category::paginate(3);

        return view("kategori.index", ["daftar_kategori" => $daftar_kategori]);
    }

    /**
     * Action untuk mencari kategori berdasarkan nama
     */
    public function search(Request $request){
        // dapatkan keyword dari querystring ?name=keyword
        $keyword = $request->get("name");

        // cari kategori where name == keyword dari querystring
        return Category::where("name", "LIKE", "%$keyword%")->get();
    }

    /**
     * Action untuk delete kategori
     */
    public function delete($id){
        $category = Category::findOrFail($id);

        $category->delete();
        return "Kategori $category->name berhasil dihapus";
    }
}
