@extends('admin.layout.layout')

@section('content')

<table class="table">
    <thead>
        <tr>
            <th>S.no</th>
            <th>Category Name</th>
            <th>Parent Category Name</th>
            <th>Category Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $key=>$data)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$data->name}}</td>
            <td>
                @if ($data->category_id)
                    {{$data->parent->name}}
                @else
                    No Parent category
                @endif
            </td>
            <td>{{$data->created_at}}</td>
            <td><a href="{{route('category.edit' , $data->id)}}" style="font-size: 17px; padding:5px;" ><i  class="fa fa-edit"></i></a>
            <a href="javascript::void(0)" style="font-size: 17px; padding:5px;" data-id="{{$data->id}}"
            class="category_delete"><i class="fa fa-trash" ></i></a></td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@push('footer-script')
    <script>
        $('.category_delete').on('click',function(){
            if(confirm('Are You Delete This Category.')){
                var id = $(this).data('id');
                $.ajax({
                    url:'{{route("category.delete")}}',
                    mathod:'post',
                    data:{
                        _token: "{{ csrf_token() }}",
                        'id':id
                    },
                    success: function(data){
                        location.reload();
                    }   
                });  
            }
        });
    </script>
@endpush
