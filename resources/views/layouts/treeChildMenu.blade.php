<ul>
    @foreach($categories as $category)
        <li class="pl-3"><a href="{{ route('catalog', $category->id) }}">{{ $category->name }}</a></li>
        @if($category->ProductCategory->count() > 0)
            @include('layouts.treeChildMenu', ['categories' => $category->ProductCategory])
        @endif
    @endforeach
</ul>
