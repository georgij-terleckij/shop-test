@extends('layouts.app')

@section('title', 'Mane Page')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                @include('layouts.catalogs')
            </div>
            <div class="col-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Продукты</a></li>
                        <li class="breadcrumb-item"><a href="#">Library</a></li>
                        {{--                        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>--}}
                    </ol>
                </nav>
                <form
                    class="form-inline my-2 my-lg-0"
                    method="get"
                    action="{{ route('search') }}"
                >
                    <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search"
                           aria-label="Search"
                           value="{{$_GET['search']}}"
                    >
                    <select
                        class="form-control"
                        id="exampleFormControlSelect1"
                        name="category_id"
                    >
                        <option value="">Все категории</option>
                        @forelse(\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}" @if($category->id == $_GET['category_id']) selected @endif>{{ $category->name }}</option>
                        @empty
                            <option value="" disabled selected>No catalog</option>
                        @endforelse
                    </select>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
                <h3>{{ $search }}</h3>
                {{--                @dd($products)--}}
                <div class="row">
                    @forelse($products as $product)
                        <div class="col-4">
                            <div class="card w-100">
                                <img class="card-img-top"
                                     src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17878c85e64%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17878c85e64%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22107.1875%22%20y%3D%2296.2765625%22%3E286x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                                     alt="Card image {{ $product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ mb_strimwidth($product->name, 0, 20, "...") }}</h5>
                                    <p class="card-text">{{ mb_strimwidth($product->description, 0, 50, "...") }}</p>
                                    <p>$ {{ $product->price }}</p>
                                    <a href="{{ route('view', $product->id) }}" class="btn btn-primary">Посмотреть</a>
                                    <a href="{{ route('addToCart', $product->id) }}" class="btn btn-primary">Купить</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No Product</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    </div>
@stop
