<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('search')->trim()->value();
        $categoryFilter = $request->integer('category');
        $minPrice = $request->integer('min_price');
        $maxPrice = $request->integer('max_price');

        $products = Product::with('category')
            ->when($search, fn ($query) => $query->where('name', 'like', '%' . $search . '%'))
            ->when($categoryFilter, fn ($query) => $query->where('category_id', $categoryFilter))
            ->when($minPrice, fn ($query) => $query->where('price', '>=', $minPrice))
            ->when($maxPrice, fn ($query) => $query->where('price', '<=', $maxPrice))
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();
        $latestPosts = Post::latest()->take(3)->get();

        return view('user.home', compact('products', 'categories', 'search', 'categoryFilter', 'minPrice', 'maxPrice', 'latestPosts'));
    }

    public function show(Product $product)
    {
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->whereKeyNot($product->getKey())
            ->latest()
            ->take(4)
            ->get();

        return view('user.product-show', compact('product', 'relatedProducts'));
    }

    public function posts()
    {
        $posts = Post::latest()->paginate(9);

        return view('user.posts', compact('posts'));
    }

    public function postShow(Post $post)
    {
        $post->increment('views');

        return view('user.post-show', compact('post'));
    }
}
