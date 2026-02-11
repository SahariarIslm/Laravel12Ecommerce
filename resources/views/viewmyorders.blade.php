<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->receiver_address }}</td>
                        <td>{{ $order->receiver_phone_number }}</td>
                        <td>{{ $order->product->product_title }}</td>
                        <td>{{ $order->product->product_price }}</td>
                        <td><img style="width: 150px;" src="{{asset('products/'.$order->product->product_image)}}" alt="product image"></td>
                        <td>
                            {{ $order->status }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>