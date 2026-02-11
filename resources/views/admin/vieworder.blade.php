@extends('admin.maindesign')

@section('view_order')
    @if(session('change_status'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
        {{ session('change_status') }}
    </div>
    @endif
    <div class="container-fluid">
        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>User</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>PDF</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->product->product_title }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->receiver_address }}</td>
                        <td>{{ $order->receiver_phone_number }}</td>
                        <td>{{ $order->product->product_price }}</td>
                        <td><img style="width: 150px;" src="{{asset('products/'.$order->product->product_image)}}" alt="product image"></td>
                        <td>
                            <form action="{{ route('admin.change_status',$order->id) }}" method="post">
                                @csrf
                                <select name="status">
                                    <option value="{{ $order->status }}">{{ $order->status }}</option>
                                    <option value="delivered">delivered</option>
                                    <option value="pending">pending</option>
                                </select>
                                <input type="submit" name="submit" value="Submit" onclick="return confirm('Are You Sure?')">
                            </form>
                        </td>
                        <td>
                            <a href="{{route('admin.downloadpdf',$order->id)}}" class="btn btn-primary">Download PDF</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection