<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\StoreProfuctRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = new Product;
        $action = route('edit-product.store');
        return view('backend.products.index')->with(compact('data', 'action'));
    }

    public function store(StoreProfuctRequest $request)
    {
        $data = new Product($request->toArray());
        if (!$data) {
            abort(404);
        }
        $data->save();
        return back();
    }

    public function update(StoreProfuctRequest $request)
    {
        $data = Product::find($request->id);
        if (!$data) {
            abort(404);
        }
        $data->name = $request->name;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->category_id = $request->category_id;
        $data->save();
        return redirect(route('edit-product.index'));
    }

    public function destroy(Request $request)
    {
        $data = Product::find($request->id);
        if (!$data) {
            abort(404);
        }
        $data->delete();
        return back();
    }

    public function edit($id)
    {
        $data = Product::find($id);
        $action = route('edit-product.update', ['id' => $id]);
        return view('backend.products.index')->with(compact('data', 'action'));
    }


}
