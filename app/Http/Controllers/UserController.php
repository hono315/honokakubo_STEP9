<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function mypage()
    {
        /** @var \App\Models\User $user */ //
        $user = Auth::user();

        $exhibitedProducts = $user->products()
            ->orderBy('id', 'asc')
            ->get();

        $purchasedItems = $user->salesProducts()
            ->orderBy('sales.created_at', 'asc')
            ->get();

        return view('mypage', compact('user','exhibitedProducts', 'purchasedItems'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user-edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'name_kanji' => 'required|string|max:255',
            'name_kana'  => 'required|string|max:255',
            'email'      => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
        ]);

        $user->name       = $validated['name'];
        $user->name_kanji = $validated['name_kanji'];
        $user->name_kana  = $validated['name_kana'];
        $user->email      = $validated['email'];
        $user->save();

        return redirect()->route('mypage')->with('status', 'アカウント情報を更新しました！');
    }
}
