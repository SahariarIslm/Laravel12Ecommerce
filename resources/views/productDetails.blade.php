@extends('maindesign')
@section('product_details')
    @if(session('cart_message'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
        {{ session('cart_message') }}
    </div>
    @endif
    <section class="contact_section ">
        <div class="container">
            <div class="product-card">

                <!-- Product Image -->
                <div class="product-image">
                    <img id="mainImage" src="{{asset('products/'.$product->product_image)}}" alt="Product Image">
                </div>

                <!-- Product Info -->
                <div class="product-info">
                    <h1 class="product-title">{{$product->product_title}}</h1>
                    <p class="product-category">Category: {{$product->product_category}}</p>

                    <div class="price">
                        $<span id="price">{{$product->product_price}}</span>
                    </div>

                    <p class="description">
                        {{$product->product_description}}
                    </p>

                    <!-- Quantity -->
                    <div class="quantity">
                        <button onclick="decreaseQty()">−</button>
                        <input type="text" id="quantity" value="1" readonly>
                        <button onclick="increaseQty()">+</button>
                    </div>

                    <!-- Buttons -->
                    <div class="actions">
                        <a href="{{route('add_to_cart',$product->id)}}" class="btn cart">Add to Cart</a>
                        <button class="btn buy">Buy Now</button>
                    </div>

                    <!-- Extra Info -->
                    <ul class="meta">
                        <li><strong>Stock:</strong> @if($product->product_quantity>0) In Stock @else Out of Stock @endif</li>
                    </ul>
                </div>

            </div>
        </div>
    </section>
@endsection
