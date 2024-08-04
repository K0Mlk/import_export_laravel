<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Product List</h2>
        <div class="list-group">
            @foreach($products as $product)
                <a href="{{ route('products.show', $product->id) }}" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $product->name }}</h5>
                        <small>{{ $product->price }} USD</small>
                    </div>
                    <p class="mb-1">{{ $product->description }}</p>
                    @if($product->images->isNotEmpty())
                        <img src="{{ $product->images->first()->url }}" class="img-thumbnail" alt="{{ $product->name }}" style="max-width: 150px;">
                    @endif
                </a>
            @endforeach
        </div>
    </div>
</body>

</html>
