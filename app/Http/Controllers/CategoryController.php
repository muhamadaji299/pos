<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categori.index', compact('categories')); // Sesuaikan dengan folder "category"
    }

    public function create()
    {
        return view('admin.categori.create'); // Sesuaikan dengan folder "category"
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255'
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(Category $category)
    {
        return view('admin.categori.edit', compact('category')); // Sesuaikan dengan folder "category"
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id
        ]);

        $category->update(['name' => $request->name]);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus');
    }
}
