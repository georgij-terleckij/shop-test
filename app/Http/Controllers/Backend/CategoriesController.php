<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = new Category();
        $action = route('edit-categories.store');
        return view('backend.categories.index')->with(compact('data', 'action'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = new Category($request->toArray());
        if (!$data) {
            abort(404);
        }
        $data->save();
        return back();
    }

    public function update(StoreCategoryRequest $request)
    {
        $data = Category::find($request->id);
        if (!$data) {
            abort(404);
        }
        $data->name = $request->name;
        $data->parentId = $request->parentId;
        $data->save();
        return redirect(route('edit-categories.index'));
    }

    public function destroy(Request $request)
    {
        $data = Category::find($request->id);
        if (!$data) {
            abort(404);
        }
        $data->delete();
        return back();
    }

    public function edit($id)
    {
        $data = Category::find($id);
        $action = route('edit-categories.update', ['id' => $id]);
        return view('backend.categories.index')->with(compact('data', 'action'));
    }
}
