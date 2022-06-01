@extends('front.layout.layout')

@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active"> SHOPPING CART</li>
    </ul>
	<h3>  SHOPPING CART [ <small>3 Item(s) </small>]<a href="products.html" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>	
	<hr class="soft"/>					
	<table class="table table-bordered">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Name</th>
                  <th>Quantity/Update</th>
				  <th>Select</th>
				  <th>Price</th>
				</tr>
              </thead>
              <tbody>
				  @php $sum = 0; @endphp
				  @foreach ($carts as $cart)
				  @php $sum = $sum + $cart->product->price; @endphp
                <tr>
                  <td> <img width="60" src="{{asset('uploads/'.$cart->product->image)}}" alt=""/></td>
                  <td>{{$cart->product->name}}</td>
				  <td>
					<div class="input-append"><input class="span1" style="max-width:34px" placeholder="1"
						id="appendedInputButtons" size="16" value="{{$cart->qty}}" type="text"><button class="btn" type="button">
						<i class="icon-minus"></i></button><button class="btn" type="button"><i class="icon-plus"></i>
						</button><button class="btn btn-danger btn_close" data-id="{{$cart->id}}" type="button"><i class="icon-remove icon-white"></i></button>			
					</div>
				  </td>
				  <td><input type="checkbox" name="select_products[]"></td>
                  <td>{{$cart->product->price}}</td>	
				  @endforeach			
                <tr>
                  <td colspan="4" style="text-align:right">Total Price:	</td>
                  <td> ${{$sum}}</td>
                </tr>
			
				 <tr>
                  <td colspan="4" style="text-align:right"></td>
                  <td class="label label-important" style="display:block"> <strong>Buy</strong></td>
                </tr>
				</tbody>
            </table>
		
		
	<a href="products.html" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
	<a href="login.html" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></a>
	
</div>
@endsection

@push('footer-script')
	<script>
        $('.btn_close').on('click',function(){
            if(confirm('Are You Remove This Product.')){
                var id = $(this).data('id');
                $.ajax({
                    url:'{{route("cart.delete")}}',
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