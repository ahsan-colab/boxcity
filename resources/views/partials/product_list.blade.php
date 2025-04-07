@foreach ($products as $product)
    <tr>
        <td><a class="product-single" href="product/{{$product->productId}}">{{ $product->productId }}</a></td>
        <td><a class="product-single" href="product/{{$product->productId}}">{{ $product->name }}</a></td>
        <td>${{ number_format($product->price, 2) }}</td>
        <td class="bulk-price">${{ number_format($product->price * 0.84, 2) }}</td>
        <td class="bulk-price">${{ number_format($product->price * 0.70, 2) }}</td>
        <td class="bulk-price">${{ number_format($product->price * 0.50, 2) }}</td>
        <td>
            <div class="quantity-container">
                <div class="qty-container">
                    <button class="quantity-btn">−</button>
                    <input type="text" class="quantity-input" value="1">
                    <button class="quantity-btn">+</button>
                </div>
                <button class="add-btn">ADD</button>
            </div>
        </td>
    </tr>
@endforeach
