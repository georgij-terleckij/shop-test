@extends('layouts.app')

@section('title', 'Mane Page')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        Product
                    </div>
                    <div class="card-body">
                        <table class="w-100">
                            <thead>
                            <tr>
                                <th style="width:90%">Name</th>
                                <th style="width:10%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $products = \App\Models\Product::paginate(10);?>
                            @forelse($products as $product)
                                <tr>
                                    <td style="width:90%"><a
                                            href="{{ route('edit-product.edit',$product->id) }}">{{ $product->name }}</a>
                                    </td>
                                    <td class="actions" data-th="">
                                        <form action="{{ route('edit-product.delete', $product->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger btn-sm remove-from-cart">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <p>No Products</p>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        фыв
                    </div>
                    <div class="card-body">
                        {{--                        @dd($action)--}}
                        <form action="{{ $action }}"
                              method="POST"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            @if(isset($data->id))
                                @method('PATCH')
                                <input type="text" name="id" value="{{ $data->id }}" hidden>
                            @endif
                            <div class="form-group">
                                <label for="name">Название</label>
                                <input type="text" name="name" class="form-control" id="name"
                                       aria-describedby="emailHelp" required
                                       maxlength="100"
                                       value="{{old('name', $data->name)}}"
                                />
                                @if($errors->has('name')) <small id="emailHelp"
                                                                 class="form-text text-muted">{{ $errors->first('name') }}</small> @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Категория</label>
                                <select
                                    class="form-control"
                                    id="exampleFormControlSelect1"
                                    name="category_id"
                                    value="{{old('category_id', $data->category_id)}}"
                                >
                                    @forelse(\App\Models\Category::all() as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @empty
                                        <option value="0" disabled selected>No catalog</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price">Название</label>
                                <input type="number" name="price" class="form-control" id="price"
                                       aria-describedby="emailHelp"
                                       required maxlength="100"
                                       value="{{old('price', $data->price)}}"
                                />
                            </div>
                            <div class="form-group">
                                <label for="description">Example textarea</label>
                                <textarea class="form-control" name="description" id="description" rows="3" required
                                          maxlength="300">{{old('description', $data->description)}}</textarea>
                                @if($errors->has('description')) <small id="emailHelp"
                                                                        class="form-text text-muted">{{ $errors->first('description') }}</small>
                                <@endif
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop
