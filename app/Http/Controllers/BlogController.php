<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function __construct()
    {
        // Pastikan hanya admin yang bisa mengakses create, edit, dan destroy
        // $this->middleware(middleware: middleware: 'admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
    public function index(Request $request) {
        $query = Blog::query();
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }
        $blogs = Blog::latest()->paginate(10);
        return view('blogs.index', compact('blogs'));
    }
    

    public function create() {
        return view('blogs.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255|unique:blogs,title,' ,
            'content' => 'required|min:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        Blog::create($data);
        return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
    }

    public function show(Blog $blog) {
        return view('blogs.show', compact('blog'));
    }

    public function edit(Blog $blog) {
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog) {
        $data = $request->validate([
            'title' => 'required|string|max:255|unique:blogs,title,' . $blog->id,
            'content' => 'required|min:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $blog->update($data);
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully!');
    }

    public function destroy(Blog $blog) {
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully!');
    }
}
