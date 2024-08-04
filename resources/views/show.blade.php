<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">{{ $product->name }}</h2>
        <div class="row">
            <div class="col-md-6">
                @if($product->images->isNotEmpty())
                    <img src="{{ $product->images->first()->url }}" class="img-fluid" alt="{{ $product->name }}">
                @endif
            </div>
            <div class="col-md-6">
                <p><strong>Description:</strong> {{ $product->description }}</p>
                <p><strong>Price:</strong> {{ $product->price }}</p>
                <p><strong>Discount:</strong> {{ $product->discount }}</p>
                <h4>Extra Fields</h4>
                <ul>
                    @foreach($product->extraFields as $field)
                        <li><strong>{{ $field->key }}:</strong> {{ $field->value }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-secondary mt-4">Back to List</a>
    </div>
</body>

</html>
