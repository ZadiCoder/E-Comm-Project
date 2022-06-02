<?php

namespace App\Http\Controllers;

use App\Models\ProductBooking;
use App\Models\Cart;
use Illuminate\Http\Request;
use Session;
use Omnipay\Ominpay;
class ProductBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart_id = $request->cart_id;
        $data = array();
        $ammount = 0;
            foreach($cart_id as $i=>$value){
                $cart = Cart::find($value);
                $ammount = $ammount + $cart->product->price;
                $data[$i]['user_id'] = $cart->user_id;
                $data[$i]['product_id'] = $cart->product_id;
                $data[$i]['qty'] = $cart->qty;
                $data[$i]['payment_status'] = '0';
            }
            $productBooking = ProductBooking::insert($data);
            $bookIds = ProductBooking::orderBy('id','desc')->take(count($data))->pluck('id');
            if($productBooking){
                Cart::destroy($cart_id);
                if($request->payment_type == 'eway'){
                    Session::put('bookIds',$bookIds);
                    $url = $this->ewayPayment($ammount);
                    return response()->json(['type'=>'eway','url'=>$url]);
                }
                else{
                    return response()->json(['type'=>'pay_person']);
                }
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductBooking  $productBooking
     * @return \Illuminate\Http\Response
     */
    public function show(ProductBooking $productBooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductBooking  $productBooking
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductBooking $productBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductBooking  $productBooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductBooking $productBooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductBooking  $productBooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductBooking $productBooking)
    {
        //
    }
    public function ewayPayment($ammount){
        $total_ammount = $ammount;
        $apiKey = 'A1001CHvpzo9IibvCa1cGDdl+Vc0ET8hgC2Vblp6Lzi4kzjZKBE/ZlpagHS4xe1jFe//bB';
        $apiPassword = 'zlYEq0KS';
        $apiEndpoint = 'Sandbox';
        $client = \Eway\Rapid::createClient($apiKey,$apiPassword,$apiEndpoint);

        //Transection Details

        $transaction = [
            'RedirectUrl'=> route('product.bookingSuccess'),
            'CancelUrl' => route('product.bookingFail'),
            'TransactionType'=> \Eway\Rapid\Enum\TransactionType::PURCHASE,
            'Payment'=> [
                'TotalAmount' => $total_ammount*100,
            ],
        ];
        
        //Submit data eway to get a shared page URL
        $response = $client->createTransaction(\Eway\Rapid\Enum\ApiMethod::RESPONSIVE_SHARED, 
        $transaction);

        // Check for any Error
        $sharedURL = '';
            if (!$response->getErrors()) {
                $sharedURL = $response->SharedPaymentUrl;
            }        
            return $sharedURL;
    }
    public function bookingFail(){
        Session::forget('bookIds');
        return redirect()->route('cart');
    }
    public function bookingSuccess(){
        $bookIds = Session::get('bookIds');
        ProductBooking::whereIn('id',$bookIds)->update(['payment_status' => '1']);
        Session::forget('bookIds');
        return redirect()->route('cart');
    }
}
