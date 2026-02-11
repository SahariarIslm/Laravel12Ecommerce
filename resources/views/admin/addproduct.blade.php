@extends('admin.maindesign')

@section('add_product')
    @if(session('product_message'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
        {{ session('product_message') }}
    </div>
    @endif
    <div class="container-fluid">
        <form enctype="multipart/form-data" action="{{route('admin.postaddproduct')}}" method="POST">
            @csrf
            <input type="text" name="product_title" placeholder="Enter Product Title"></br>
            <input type="file" name="product_image" placeholder="Enter Product Image"></br>
            <textarea name="product_description">Product Description</textarea></br>
            <Select name="product_category"></br>
                @foreach($categories as $category)
                <option value="{{ $category->category }}">{{ $category->category }}</option>
                @endforeach
            </Select></br>
            <input type="number" name="product_price" placeholder="Enter Product Price"></br>
            <input type="number" name="product_quantity" placeholder="Enter Product Quantity"></br>
            <input type="submit" name="Submit" value="Add Product">
        </form>
    </div>
@endsection