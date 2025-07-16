@if($products->isEmpty())
    <tr class="scroll-{{ $scroll ?? '' }}">
        <td colspan="100%" class="text-center py-3">No Products Found</td>
    </tr>
@else
    @foreach ($products as $product)
        <tr class="scroll-{{$scroll  ?? ''}}">
            <td><a class="product-single" href="{{ route('product.detail', ['id' => $product->productId]) }}">{{ $product->productId }}</a></td>
            <td><a class="product-single" href="{{ route('product.detail', ['id' => $product->productId]) }}">{{ $product->name }}</a></td>
            <td>{{config('app.currency_symbol')}}{{ number_format($product->price, 2) }}</td>
            <td class="bulk-price">{!! calculatePrice($product->price, 12) !!}</td>
            <td class="bulk-price">{!! calculatePrice($product->price, 50) !!}</td>
            <td class="bulk-price">{!! calculatePrice($product->price, 100) !!}</td>
            <td>
                <div class="quantity-container">
                    <div class="qty-container">
                        <button class="quantity-btn minus">−</button>
                        <input type="text" class="quantity-input" value="1"/>
                        <button class="quantity-btn plus">+</button>
                    </div>
                    <button class="add-btn" data-product-id="{{ $product->productId }}" data-product-name="{{ $product->name }}" data-product-image="{{ $product->thumbnailUrl ?? ''}}"
                            data-product-retail-price="{{number_format($product->price, 2)}}" data-product-bulk-price-12="{{ calculatePrice($product->price, 12, false) }}"
                            data-product-bulk-price-50="{{ calculatePrice($product->price, 50, false) }}" data-product-bulk-price-100="{{ calculatePrice($product->price, 100, false) }}">
                        ADD
                    </button>
                </div>
            </td>
        </tr>
    @endforeach
@endif
