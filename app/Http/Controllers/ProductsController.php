<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * 商品一覧画面を表示
     */
    public function index(Request $request)
    {
        $search   = $request->input('search');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        $items = Product::query()
            ->when(auth()->check(), function ($query) {
                $query->where('user_id', '!=', auth()->id());
            })
            ->when($search, function ($query) use ($search) {
                $query->where('product_name', 'like', "%{$search}%");
            })
            ->when($minPrice, function ($query) use ($minPrice) {
                $query->where('price', '>=', $minPrice);
            })
            ->when($maxPrice, function ($query) use ($maxPrice) {
                $query->where('price', '<=', $maxPrice);
            })
            ->get();


        if ($request->ajax()) {
            return response()->json([
                'html' => view('products.partials.items', compact('items'))->render()
            ]);
        }

        return view('products.index', compact('items'));
    }

    /**
     * 商品新規登録画面を表示
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * 商品詳細画面を表示
     */
    public function detail(Product $item)
    {
        return view('products.detail', compact('item'));
    }

    public function edit(Product $item)
    {
        return view('products.edit', compact('item'));
    }

    /**
     * 商品をデータベースに保存
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'description'  => 'required|string',
            'image'        => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('images', 'public');

        Product::create([
            'user_id' => auth()->id(),
            'company_id' => auth()->user()->company_id,
            'product_name' => $request->input('product_name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'description' => $request->input('description'),
            'image_path' => $path,
        ]);

        return redirect()->route('products.index')
            ->with('success', '商品を登録しました。');
    }

    /**
     * 商品の更新処理
     */
    public function update(Request $request, Product $item)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'description'  => 'required|string',
            'stock'        => 'required|integer|min:0',
            'image_path'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $item->product_name = $request->input('product_name');
        $item->price        = $request->input('price');
        $item->description  = $request->input('description');
        $item->stock        = $request->input('stock');

        if ($request->hasFile('image_path')) {

            if ($item->image_path) {
                Storage::disk('public')->delete($item->image_path);
            }
            $path = $request->file('image_path')->store('products', 'public');

            $item->image_path = $path;
        }

        $item->save();

        return redirect()->route('products.detail', $item)
            ->with('success', '商品を更新しました。');
    }

    /**
     * 商品を削除する
     */
    public function destroy(Product $item)
    {
        if ($item->image_path) {
            Storage::disk('public')->delete($item->image_path);
        }

        $item->delete();

        return redirect()->route('products.index')
            ->with('success', '商品を削除しました。');
    }

    /**
     * 商品にいいねを追加する
     */
    public function like(Product $item)
    {
        if (!$item->isLikedBy(auth()->user())) {
            $item->likes()->create([
                'user_id' => auth()->id(),
            ]);
        }

        $likes_count = $item->likes()->count();

        return response()->json([
            'likes_count' => $likes_count
        ]);
    }

    public function unlike(Product $item)
    {
        if ($item->isLikedBy(auth()->user())) {
            $item->likes()->where('user_id', auth()->id())->delete();
        }

        $likes_count = $item->likes()->count();

        return response()->json([
            'likes_count' => $likes_count
        ]);
    }

    /**
     * 出品商品の詳細画面を表示
     */
    public function exhibit_detail(Product $item)
    {
        return view('products.exhibit_detail', compact('item'));
    }

    /**
     * 購入画面
     */
    public function checkout(Product $item)
    {
        return view('products.checkout', compact('item'));
    }

    public function processCheckout(Request $request, Product $item)
    {
        if ($item->stock <= 0) {
            return redirect()->back()->withErrors(['quantity' => 'この商品は売り切れたため、購入できません。']);
        }

        $request->validate([
            'quantity' => "required|integer|min:1|max:{$item->stock}",
        ]);

        $quantity = $request->input('quantity');

        $item->stock = $item->stock - $quantity;
        $item->save();

        \App\Models\Sale::create([
            'user_id'     => auth()->id(),
            'products_id' => $item->id,
            'quantity'    => $quantity,
        ]);

        return redirect()->route('products.index')
            ->with('success', '購入が完了しました！');
    }
}
