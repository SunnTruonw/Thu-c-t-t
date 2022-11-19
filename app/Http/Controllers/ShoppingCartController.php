<?php

namespace App\Http\Controllers;

use App\Helper\CartHelper;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Product;

use App\Models\City;
use App\Models\District;
use App\Models\Commune;
use App\Mail\TransactionEmail;
use Illuminate\Support\Facades\Mail;
use App\Helper\AddressHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Setting;

class ShoppingCartController extends Controller
{
    //

    private $product;
    private $order;
    private $cart;
    private $city;
    private $district;
    private $commune;
    private $transaction;
    private $unit;
    private $setting;
    public function __construct(Product $product, City $city, District $district, Commune $commune, Order $order, Transaction $transaction, Setting $setting)
    {
        $this->product = $product;
        $this->order = $order;
        $this->city = $city;
        $this->district = $district;
        $this->commune = $commune;
        $this->transaction = $transaction;
        $this->setting = $setting;
        $this->unit = "đ";
    }
    public function list()
    {
        $address = new AddressHelper();
        $dataCity = $this->city->orderby('name')->get();
        $cities = $address->cities($dataCity);
        //  dd($this->city->get());
        $this->cart = new CartHelper();
        $data = $this->cart->cartItems;
        $totalPrice =  $this->cart->getTotalPrice();
        $totalOldPrice =  $this->cart->getTotalOldPrice();

        $totalQuantity =  $this->cart->getTotalQuantity();
        $vanchuyen = $this->setting->find(140);
        $thanhtoan = $this->setting->find(293);
        $chinhanh = $this->setting->find(143);

        return view('frontend.pages.cart', [
            'data' => $data,
            'cities' => $cities,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity,
            'totalOldPrice' => $totalOldPrice,
            'vanchuyen' => $vanchuyen,
            'thanhtoan' => $thanhtoan,
            'chinhanh' => $chinhanh,
        ]);
    }

    public function add($id, Request $request)
    {
        $this->cart = new CartHelper();

        $quantity = 1;
        if ($request->has('quantity') && $request->input('quantity')) {
            $quantity = (int) $request->input('quantity');
            if ($quantity <= 0) {
                $quantity = 1;
            }
        }

        if ($request->has('option') && $request->input('option')) {
            // dd($this->product->mergeOption($request->input('option'))->where('products.id',$id)->get());
            $product =  $this->product->join('options', 'products.id', '=', 'options.product_id')
                ->select('products.*', 'options.size as size', 'options.price as price', 'options.id as option_id')
                ->where('options.id', $request->input('option'))
                ->where('products.id', $id)
                ->first();
        } else {
            $product = $this->product->find($id);
        }

        // dd($product, $quantity);

        $this->cart->add($product, $quantity);

        //load cart
        $data = $this->cart->cartItems;
        $totalPrice =  $this->cart->getTotalPrice();
        $totalOldPrice =  $this->cart->getTotalOldPrice();
        $totalQuantity =  $this->cart->getTotalQuantity();

        $address = new AddressHelper();
        $dataCity = $this->city->orderby('name')->get();
        $cities = $address->cities($dataCity);

        $html = view('frontend.components.load-cart-product', [
            'data' => $data,
            'cities' => $cities,
            'totalPrice' => $totalPrice,
            'totalOldPrice' => $totalOldPrice,
            'totalQuantity' => $totalQuantity,
        ])->render();

        return response()->json([
            'code' => 200,
            'data' => $html,
            'messange' => 'success'
        ]);

        // return response()->json([
        //     'code' => 200,
        //     'messange' => 'success'
        // ], 200);
    }

    public function buy($id, Request $request)
    {
        $this->cart = new CartHelper();

        $quantity = 1;
        $color = $request->color;
        $size = $request->size;
        if ($request->has('quantity') && $request->input('quantity')) {
            $quantity = (int) $request->input('quantity');
            if ($quantity <= 0) {
                $quantity = 1;
            }
        }
        if ($request->has('option') && $request->input('option')) {
            // dd($this->product->mergeOption($request->input('option'))->where('products.id',$id)->get());
            $product =  $this->product->join('options', 'products.id', '=', 'options.product_id')
                ->select('products.*', 'options.size as size', 'options.price as price', 'options.id as option_id')
                ->where('options.id', $request->input('option'))
                ->where('products.id', $id)
                ->first();
        } else {

            $product = $this->product->find($id);
        }
        $this->cart->add($product, $quantity, $color, $size);
        //  dd($this->cart->cartItems);
        return redirect()->route("cart.list");
    }
    public function remove($id, Request $request)
    {
        $this->cart = new CartHelper();
        if ($request->option) {
            $this->cart->remove($id, $request->option);
        } else {
            $this->cart->remove($id);
        }

        $address = new AddressHelper();
        $dataCity = $this->city->orderby('name')->get();
        $cities = $address->cities($dataCity);

        $totalPrice =  $this->cart->getTotalPrice();
        $totalQuantity =  $this->cart->getTotalQuantity();
        $totalOldPrice =  $this->cart->getTotalOldPrice();

        if (!empty($request->type) && $request->type === 'popup') {
            return response()->json([
                'code' => 200,
                'data' => view('frontend.components.load-cart-product', [
                    'data' => $this->cart->cartItems,
                    'totalPrice' => $totalPrice,
                    'totalQuantity' => $totalQuantity,
                    'totalOldPrice' => $totalOldPrice,
                ])->render(),
                'totalPrice' => $totalPrice,
                'totalQuantity' => $totalQuantity,
                'messange' => 'success'
            ], 200);
        } else {
            return response()->json([
                'code' => 200,
                'htmlcart' => view('frontend.components.cart-component', [
                    'data' => $this->cart->cartItems,
                    'totalPrice' => $totalPrice,
                    'cities' => $cities,
                    'totalQuantity' => $totalQuantity,
                    'totalOldPrice' => $totalOldPrice,
                ])->render(),
                'totalPrice' => $totalPrice,
                'messange' => 'success'
            ], 200);
        }
    }
    public function update($id, Request $request)
    {
        $this->cart = new CartHelper();
        $quantity = $request->quantity;
        if ($request->option) {
            $this->cart->update($id, $quantity, $request->option);
        } else {
            $this->cart->update($id, $quantity);
        }

        $address = new AddressHelper();
        $dataCity = $this->city->orderby('name')->get();
        $cities = $address->cities($dataCity);

        $totalPrice =  $this->cart->getTotalPrice();
        $totalQuantity =  $this->cart->getTotalQuantity();
        $totalOldPrice =  $this->cart->getTotalOldPrice();

        if (!empty($request->type) && $request->type === 'popup') {
            return response()->json([
                'code' => 200,
                'data' => view('frontend.components.load-cart-product', [
                    'data' => $this->cart->cartItems,
                    'totalPrice' => $totalPrice,
                    'totalQuantity' => $totalQuantity,
                    'totalOldPrice' => $totalOldPrice,
                ])->render(),
                'totalPrice' => $totalPrice,
                'totalQuantity' => $totalQuantity,
                'messange' => 'success'
            ], 200);
        } else {
            return response()->json([
                'code' => 200,
                'htmlcart' => view('frontend.components.cart-component', [
                    'data' => $this->cart->cartItems,
                    'cities' => $cities,
                    'totalPrice' => $totalPrice,
                    'totalQuantity' => $totalQuantity,
                    'totalOldPrice' => $totalOldPrice,
                ])->render(),
                'totalPrice' => $totalPrice,
                'totalQuantity' => $totalQuantity,
                'messange' => 'success'
            ], 200);
        }
    }
    public function clear(Request $request)
    {
        $this->cart = new CartHelper();
        $this->cart->clear();
        $totalPrice =  $this->cart->getTotalPrice();
        $totalQuantity =  $this->cart->getTotalQuantity();
        $totalOldPrice =  $this->cart->getTotalOldPrice();

        if (!empty($request->type) && $request->type === 'popup') {
            return response()->json([
                'code' => 200,
                'data' => view('frontend.components.load-cart-product', [
                    'data' => $this->cart->cartItems,
                    'totalPrice' => $totalPrice,
                    'totalQuantity' => $totalQuantity,
                    'totalOldPrice' => $totalOldPrice,
                ])->render(),
                'totalPrice' => $totalPrice,
                'totalQuantity' => $totalQuantity,
                'messange' => 'success'
            ], 200);
        } else {
            return response()->json([
                'code' => 200,
                'htmlcart' => view('frontend.components.cart-component', [
                    'data' => $this->cart->cartItems,
                    'totalPrice' => $totalPrice,
                    'totalQuantity' => $totalQuantity,
                    'totalOldPrice' => $totalOldPrice,
                ])->render(),
                'totalPrice' => $totalPrice,
                'totalQuantity' => $totalQuantity,
                'messange' => 'success'
            ], 200);
        }
    }

    public function postOrder(Request $request)
    {
        $this->cart = new CartHelper();
        $dataCart = $this->cart->cartItems;
        if (!count($dataCart)) {
            return redirect()->route('cart.order.error')->with("error", __('contact.dat_hang_khong_thanh_cong'));
        }
        try {
            DB::beginTransaction();
            // dd( $dataCart);
            $totalPrice =  $this->cart->getTotalPrice();
            $totalQuantity =  $this->cart->getTotalQuantity();
            // $dataOrderCreate = [
            //     "quantity" => $request->input('quantity'),
            // ];
            $dataTransactionCreate = [
                'total' => $totalPrice,
                'name' => $request->input('nameCart'),
                'gender' => $request->input('gender'), // gioi tinh
                'phone' => $request->input('phoneCart'),
                'email' => $request->input('emailCart'),
                'note' => $request->input('note') ?? '',
                'status' => 1,
                'city_id' => $request->input('city_id') ?? null,
                'district_id' => $request->input('district_id') ?? null,
                'commune_id' => $request->input('commune_id') ?? null,
                'address_detail' => $request->addressCart ?? null,
                'httt' => $request->input('httt'),

                'eInvoiceType' => $request->input('eInvoiceType') ?? 0, // = 1 cong ty , = 2 ca nhan
                'companyName' => $request->input('companyName') ?? '', // ten cong ty
                'companyTax' => $request->input('companyTax') ?? '', // ma so thue
                'companyAddress' => $request->input('companyAddress') ?? '', // dia chi cong ty


                'hiddenLocation' => $request->input('hiddenLocation') ?? 0, // hinh thuc nhan hang
                'payment' => $request->input('payment') ?? 0, // 



                'cn' => $request->input('cn'),
                'admin_id' => 0,
                'user_id' => Auth::check() ? Auth::user()->id : 0,
                'code' => makeCodeTransaction($this->transaction),
            ];

            //  dd($this->transaction->create($dataTransactionCreate));
            $transaction = $this->transaction->create($dataTransactionCreate);
            $dataOrderCreate = [];
            foreach ($dataCart as $cart) {
                $dataOrderCreate[] = [
                    'name' => $cart['name'],
                    'quantity' => $cart['quantity'],
                    'new_price' => $cart['totalPriceOneItem'],
                    'old_price' => $cart['totalOldPriceOneItem'],
                    'avatar_path' => $cart['avatar_path'],
                    'sale' => $cart['sale'],
                    'size' => $cart['size'],
                    'option_id' => $cart['option_id'] ?? 0,
                    'product_id' => $cart['id'],
                ];
                $product = $this->product->find($cart['id']);
                $pay = $product->pay;
                $product->update([
                    'pay' => $pay + $cart['quantity'],
                ]);
            }
            //   dd($dataOrderCreate);
            // insert database in orders table by createMany
            $transaction->orders()->createMany($dataOrderCreate);

            $this->cart->clear();
            DB::commit();
            // Mail::to('minskitchenmart@gmail.com')->send(new TransactionEmail($transaction));

            return response()->json([
                'code' => 200,
                'id' => $transaction->id,
                'messange' => __('home.dat_hang_thanh_cong')
            ], 200);
            // return redirect()->route('cart.order.sucess', [])->with("sucess", __('home.dat_hang_thanh_cong'));
        } catch (\Exception $exception) {
            // throw $th;
            DB::rollBack();
            // dd($exception);
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'id' => $transaction->id,
                'messange' =>  __('home.dat_hang_khong_thanh_cong')
            ], 500);
            // return redirect()->route('cart.order.error')->with("error", __('home.dat_hang_khong_thanh_cong'));
        }
    }
    public function getOrderSuccess(Request $request)
    {
        $id = $request->id;
        $data = $this->transaction->find($id);
        return view('frontend.pages.order-sucess', [
            'data' => $data,
        ]);
    }
    public function getOrderError(Request $request)
    {
        $data = null;
        return view('frontend.pages.order-sucess', [
            'data' => $data,
        ]);
    }
}
