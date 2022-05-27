@extends('admin.layout.layout')

@section('content')

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>S.no</th>
            <th>Product Name</th>
            <th>Category Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $key=>$data)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$data->name}}</td>
            <td>
                @if ($data->category_id)
                    {{$data->category->name}}
                @else
                    No Parent category
                @endif
            </td>
            <td>{{$data->price}}</td>
            <td><img src="{{asset('uploads/'.$data->image)}}" style="height:80px; width:80px;"></td>
            
            <td>
                <a href="{{route('product.edit' , $data->id)}}" style="font-size: 17px; padding:5px;" ><i  class="fa fa-edit"></i></a>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection