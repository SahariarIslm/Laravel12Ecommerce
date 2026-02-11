@extends('admin.maindesign')

@section('view_product')
    @if(session('delete_product'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
        {{ session('delete_product') }}
    </div>
    @endif
    <div class="container-fluid">
        <div class="list-inline-item">
            <form action="{{route('admin.searchproduct')}}" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" name="search" placeholder="What are you searching for...">
                    <button type="submit" class="submit">Search</button>
                </div>
            </form>   
        </div>
        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $prod)
                    <tr>
                        <td>{{ $prod->id }}</td>
                        <td>{{ $prod->product_title }}</td>
                        <td>{{ Str::limit($prod->product_description,50) }}</td>
                        <td>{{ $prod->product_category }}</td>
                        <td><img style="width: 150px;" src="{{asset('products/'.$prod->product_image)}}" alt="product image"></td>
                        <td>{{ $prod->product_price }}</td>
                        <td>{{ $prod->product_quantity }}</td>
                        <td>
                            <a class="btn edit" href="{{ route('admin.updateproduct',$prod->id) }}">Edit</a>
                             <a class="btn delete" href="{{ route('admin.deleteproduct',$prod->id) }}" onclick="return confirm('Are You Sure?')">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    {{ $products->links()}}
                </tbody>
            </table>
        </div>
    </div>
@endsection