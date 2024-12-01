<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class BlogManagementController extends Controller
{
    public function showBlogs()
    {
        $blogs = Blog::all();
        return view('admin.community.blogs-index', ['blogs' => $blogs]);
    }


    // Add logic to handle blog creation
    public function addBlog(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'blog_title' => ['required', Rule::unique('blogs', 'blog_title')],
                'blog_info' => ['required'],
                'admin_id' => ['required'],
                'blog_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max: 4096',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('admin.blog')->withErrors($e->errors());
        }

        if ($request->hasFile('blog_pic')) {
            $imageName = time() . '.' . $request->blog_pic->extension();
            $request->blog_pic->move(public_path('img/blog'), $imageName);
            $validatedData['blog_pic'] = 'img/blog/' . $imageName;
        } else {
            return redirect()->route('admin.blog')->withErrors(['blog_pic' => 'No image uploaded.']);
        }

        Blog::create($validatedData);
        return redirect()->route('admin.blog')->with('message', 'Blog added successfully.');
    }

    // Add logic to handle blog editing
    public function editBlog($blog)
    {
        // Find the blog by id
        try {
            $blog = Blog::findOrFail($blog);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.blog')->withErrors(['blog' => 'Blog not found.']);
        }

        // Return the view with the blog
        return view('admin.community.edit-blog', ['blog' => $blog]);
    }

    // Add logic to handle blog update
    public function updateBlog($blog, Request $request)
    {
        // Validate the request data
        try {
            $validatedData = $request->validate([
                'blog_title' => ['required', Rule::unique('blogs', 'blog_title')->ignore($blog)],
                'blog_info' => ['required'],
                'blog_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('admin.blog.edit', ['blog' => $blog])->withErrors($e->errors());
        }

        // Find the blog by id
        $blog = Blog::findOrFail($blog);

        // Update the blog
        if ($request->hasFile('blog_pic')) {
            // Delete the old image if it exists
            if ($blog->blog_pic) {
                Storage::delete($blog->blog_pic);
            }

            $imageName = time() . '.' . $request->blog_pic->extension();
            $request->blog_pic->move(public_path('img/blog'), $imageName);
            $validatedData['blog_pic'] = 'img/blog/' . $imageName;
        }

        $blog->update($validatedData);
        return redirect()->route('admin.blog')->with('message', 'Blog updated successfully.');
    }

    // Add logic to handle blog deletion
    public function deleteBlog($blog)
    {
        // Find the blog by id
        try {
            $blog = Blog::findOrFail($blog);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.blog')->withErrors(['blog' => 'Blog not found.']);
        }

        // Delete the blog
        $blog->delete();

        // Delete the blog image if it exists
        if ($blog->blog_pic) {
            Storage::delete($blog->blog_pic);
        }

        return redirect()->route('admin.blog')->with('message', 'Blog deleted successfully.');
    }

}
