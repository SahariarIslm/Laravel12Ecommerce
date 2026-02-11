@extends('maindesign')
@section('viewcartproducts')
    @if(session('cart_message'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('cart_message') }}
        </div>
    @endif
    @if(session('confirm_order'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('confirm_order') }}
        </div>
    @endif
<div class="table-container">
    
    <table class="custom-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Image</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $price = 0;
            @endphp
            @foreach($cart as $cart_prod)
            <tr>
                <td>{{ $cart_prod->product->product_title }}</td>
                <td>
                    <img 
                        style="width: 150px;" 
                        src="{{asset('products/'.$cart_prod->product->product_image)}}" 
                        alt="product image"
                    >
                </td>
                <td>{{ $cart_prod->product->product_price }}</td>
                <td>
                    <a class="btn delete" href="{{ route('removecartproduct',$cart_prod->id) }}" onclick="return confirm('Are You Sure?')">Remove</a>
                </td>
            </tr>
            @php
                $price += $cart_prod->product->product_price;
            @endphp
            @endforeach
            <tr>
                <td></td>
                <td>Total Price:</td>
                <td>$ {{$price}}</td>
                <td></td>
            </tr>
            
        </tbody>
    </table>
    <form action="{{route('confirm_order')}}" method="post" style="margin-top=20px;">
        @csrf
        <input name="receiver_address" type="text" placeholder="Enter your address" required><br>
        <input name="receiver_phone_number" type="text" placeholder="Enter your phone number" required><br>
        <input name="Submit" type="submit" value="Confirm Order"><br>
    </form>
</div>
@endsection