<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ItemController extends Controller
{
    public function index()
    {
        $items = Products::all();
        return view('items', compact('items'));
    }
}
