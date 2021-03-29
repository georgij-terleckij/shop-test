<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $products = Product::paginate(9);
        return view('front/main', compact('products'));
    }

    public function view($id)
    {
        $product = Product::find($id);
        if (!$product) {
            abort(404);
        }
        return view('front/view', compact('product'));
    }

    public function cart()
    {
        return view('front/cart');
    }

    public function catalog(Request $request)
    {
        $result = null;
        $name = '';
        $products = [];
        $breadcrumb = [];
        if (isset($request->id)) {
            $temp = Category::where('id', $request->id)->first();
            $name = ' - ' . $temp->name;
//            $result = $temp->categories();
//            $products = $temp->products();
            // Рилейшены чего-то не работали я сделал так не обессудьте


            $result = Category::where('parentId', $temp->id)->get()->toArray();
            $products = Product::where('category_id', $temp->id)->get()->toArray();
            $breadcrumb = $temp->takeBreadcrumb();

        } else {
            $result = Category::TakeParent()->toArray();
        }
        $data = (object)[
            'name' => $name,
            'catalogs' => $result,
            'products' => $products,
            'breadcrumb' => $breadcrumb,
        ];

        return view('front/categories', compact('data'));
    }

    public function addToCart($id)
    {
        $product = Product::find($id);
        if (!$product) {
            abort(404);
        }
        $cart = session()->get('cart');

        // если корзина пуста, то это первый товар
        if (!$cart) {
            $cart = [
                $id => [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // если корзина не пуста, проверяет , существует ли этот товар, затем увеличьте количество
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // если товара нет в корзине, добавьте в корзину с количеством = 1
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if ($request->id and $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category_id');
        $products = Product::search($search, $category);
//        $products = $query->paginate(6)->withQueryString();
        return view('front.search', compact('products', 'search'));
    }
}
