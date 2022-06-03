@extends('admin.layout.layout')

@section('content')

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>S.no</th>
            <th>Product Name</th>
            <th>User Name</th>
            <th>Qty</th>
            <th>Total Amount</th>
            <th>Payment Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($booking_products as $key=>$booking_product)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$booking_product->product->name}}</td>
            <td>{{$booking_product->user->name}}</td>
            <td>{{$booking_product->qty}}</td>
            <td>{{$booking_product->qty * $booking_product->product->price}}</td>
            <td>{{$booking_product->payment_status}}</td>

            <td>
                <a href="javaseript::void(0)" style="font-size: 17px; padding:5px;" data-id="{{$booking_product->id}}"
                class="delete"><i class="fa fa-trash" ></i></a>
            </td> 
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@push('footer-script')
    <script>
        $('.delete').on('click',function(){
            if(confirm('Are You Delete This Product.')){
                var id = $(this).data('id');
                $.ajax({
                    url:'{{route("booking.product.delete")}}',
                    data:{
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