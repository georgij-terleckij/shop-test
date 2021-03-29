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
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </nav>
                <h1>{{ $product->name }}</h1>
                <p>{{ $product->description }}</p>
                <span>$ {{ $product->price }}</span><br/>
                <a href="{{ route('addToCart', $product->id) }}" class="btn btn-primary">Купить</a>
            </div>
        </div>
    </div>
    </div>
@stop
