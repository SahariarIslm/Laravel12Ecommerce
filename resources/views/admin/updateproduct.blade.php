@extends('admin.maindesign')

@section('update_product')
    @if(session('product_message'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
        {{ session('product_message') }}
    </div>
    @endif
    <div class="container-fluid">
        <form enctype="multipart/form-data" action="{{route('admin.postupdateproduct',$product->id)}}" method="POST">
            @csrf
            <input type="text" name="product_title" value="{{ $product->product_title }}" placeholder="Enter Product Title"></br>
            <img style="width:100px;" src="{{asset('products/'.$product->product_image)}}" alt=""><br>
            <input type="file" name="product_image" placeholder="Enter Product Image"><label>Add New Image Here</label></br>
            <textarea name="product_description">{{ $product->product_description }}</textarea></br>
            <Select name="product_category"></br>
                <option value="{{ $product->category }}">{{ $product->category }}</option>
                @foreach($categories as $category)
                <option value="{{ $category->category }}">{{ $category->category }}</option>
                @endforeach
            </Select></br>
            <input type="number" value="{{ $product->product_price }}" name="product_price" placeholder="Enter Product Price"></br>
            <input type="number" value="{{ $product->product_quantity }}" name="product_quantity" placeholder="Enter Product Quantity"></br>
            <input type="submit" name="Submit" value="Update Product">
        </form>
    </div>
@endsection