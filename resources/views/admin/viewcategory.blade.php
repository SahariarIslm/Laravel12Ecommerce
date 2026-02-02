@extends('admin.maindesign')

@section('view_category')
    @if(session('delete_category'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
        {{ session('delete_category') }}
    </div>
    @endif
<div class="container-fluid">
    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->category }}</td>
                    <td>
                        <a class="btn edit" href="{{ route('admin.categoryupdate',$cat->id) }}">Edit</a>
                        <a class="btn delete" href="{{ route('admin.categorydelete',$cat->id) }}" onclick="return confirm('Are You Sure?')">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection