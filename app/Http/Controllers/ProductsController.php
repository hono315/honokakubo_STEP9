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
    public function index()
    {
        $items = Product::all();
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

    /**
     * 👈 修正：商品編集画面を表示（これが足りていませんでした！）
     */
    public function edit(Product $item)
    {
        return view('products.edit', compact('item'));
    }

    /**
     * 商品をデータベースに保存
     */
    public function store(Request $request)
    {
        // 簡易バリデーション（必要に応じて追加してください）
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
            'company_id' => 1, // 仮の会社ID
            'product_name' => $request->input('product_name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'description' => $request->input('description'),
            'image_path' => $path,
        ]);

        // 👈 追記：登録が終わったら一覧画面に戻すリダイレクト
        return redirect()->route('products.index')
            ->with('success', '商品を登録しました。');
    }

    /**
     * 商品の更新処理
     */
    public function update(Request $request, Product $item)
    {
        // 1. バリデーション（入力値のチェック）
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'description'  => 'required|string',
            'stock'        => 'required|integer|min:0',
            'image_path'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. フォームの入力値をセット（画像以外）
        $item->product_name = $request->input('product_name');
        $item->price        = $request->input('price');
        $item->description  = $request->input('description');
        $item->stock        = $request->input('stock');

        // 3. 画像が新しくアップロードされた場合の処理
        if ($request->hasFile('image_path')) {

            // 古い画像がすでに存在していれば、サーバーから削除する
            if ($item->image_path) {
                Storage::disk('public')->delete($item->image_path);
            }

            // 新しい画像を 'public/products' フォルダに保存し、そのパスを取得
            $path = $request->file('image_path')->store('products', 'public');

            // データベースに新しいパスを保存
            $item->image_path = $path;
        }

        // 4. データベースを更新
        $item->save();

        // 5. 更新完了後、商品詳細ページにリダイレクト
        return redirect()->route('products.detail', $item)
            ->with('success', '商品を更新しました。');
    }

    /**
     * 商品を削除する
     */
    public function destroy(Product $item)
    {
        // もし商品画像があれば、サーバーから画像ファイルも一緒に削除する（親切設計）
        if ($item->image_path) {
            Storage::disk('public')->delete($item->image_path);
        }

        // データベースから商品を削除
        $item->delete();

        // 削除完了後、一覧画面にリダイレクト
        return redirect()->route('products.index')
            ->with('success', '商品を削除しました。');
    }
}
