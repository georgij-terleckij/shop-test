<h1>Каталог</h1>
<?php
$category = new \App\Models\Category;
$rootCategories = $category->rootCategories(); ?>
<ul>
    @foreach($rootCategories as $rootCategory)
        <li><a href="{{ route('catalog', $rootCategory->id) }}">{{ $rootCategory->name }}</a></li>
        @if($rootCategory->ProductCategory->count() > 0)
            @include('layouts.treeChildMenu', ['categories' => $rootCategory->ProductCategory])
        @endif
    @endforeach
</ul>
