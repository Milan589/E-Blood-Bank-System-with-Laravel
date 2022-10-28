<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\BankType;
use App\Models\Backend\BloodBank;
use App\Models\Backend\BloodDonation;
use App\Models\Backend\BloodGroup;
use App\Models\Backend\BloodPouch;
use App\Models\Backend\Location;
use App\Models\Backend\Order;
use App\Models\Donor;
use App\Models\User;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DonorController extends FrontendBaseController
{
    function registerForm()
    {
        $data['bloodGroups'] = BloodGroup::pluck('bg_name', 'id');
        return view($this->__LoadDataToView('frontend.donor.register'), compact('data'));
    }

    function register(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'bg_id' => 'required',
            ]
        );
        DB::beginTransaction();
        try {
            $user = User::create([
                'role_id' => 2,
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'bg_id' => $request->input('bg_id'),
            ]);
            if ($user) {
                $request->request->add(['user_id' => $user->id]);
                $donor = Donor::create($request->all());
                if ($donor) {
                    DB::commit();
                    $request->session()->flash('success', 'Your account register successfully!!');
                    return redirect()->route('frontend.donor.login');
                } else {
                    DB::rollBack();
                }
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            $request->session()->flash('error', 'Error: ' . $exception->getMessage());
            return redirect()->route('frontend.donor.register');
        }
        return redirect()->route('frontend.donor.register');
    }

    function login()
    {
        return view('frontend.donor.login');
    }
    function home()
    {

        $data['record'] = BloodDonation::pluck('user_id', 'id')->count();
        return view($this->__LoadDataToView('frontend.donor.home'), compact('data'));
    }
    function donate()
    {
        $data['bloodGroups'] = BloodGroup::pluck('bg_name', 'id');
        $data['banknames'] = BloodBank::pluck('bank_name', 'id');
        return view($this->__LoadDataToView('frontend.donor.wantdonate'), compact('data'));
    }

    function dodonate(Request $request)
    {
        $request->validate(
            [
                'amount' => 'required',
                'b_id' => 'required',
                'donated_date' => 'required',
            ]
        );
        try {
            $request->request->add(['user_id' => Auth::user()->id]);
            //    dd($request);
            $donor = BloodDonation::create($request->all());
            if ($donor) {
                DB::commit();
                $request->session()->flash('success', 'Your donation successfully!!');
                return redirect()->route('frontend.donor.home');
            } else {
                DB::rollBack();
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            $request->session()->flash('error', 'Error: ' . $exception->getMessage());
            return redirect()->route('frontend.donor.register');
        }
        return redirect()->route('frontend.donor.register');
    }

    function bloodbank()
    {
        $data['records'] = BloodBank::orderby('created_at', 'desc')->get();
        return view($this->__LoadDataToView('frontend.donor.bloodbank'), compact('data'));
    }

    function bloodAvailable()
    {
        $data['recordbloodBanks'] = BloodGroup::pluck('bg_name', 'id');
        $data['records'] = BloodPouch::orderby('created_at', 'desc')->get();
        return view($this->__LoadDataToView('frontend.donor.availability'), compact('data'));
    }

    function orderBlood()
    {
        $data['bloodGroups'] = BloodGroup::pluck('bg_name', 'id');
        $data['bloodBank'] = BloodBank::pluck('bank_name', 'id');
        return view($this->__LoadDataToView('frontend.donor.order'), compact('data'));
    }

    function addToCart(Request $request)
    {
        $request->validate(
            [
                'bg_id' => 'required',
                'qty' => 'required',
                'bank_name' => 'required',
            ]
        );
        Cart::add(
            [
                'name' => $request->input('bank_name'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'id' => $request->input('bg_id'),
                'price' => $request->input('price'),
                'qty' => $request->input('qty'),
                'weight' => $request->input('weight'),
            ]
        );
        return view($this->__LoadDataToView('frontend.donor.orderlist'));
    }

    function orderList()
    {
        return view($this->__LoadDataToView('frontend.donor.orderlist'));
    }

    function updateOrder(Request $request)
    {
        $row_ids = $request->input('row_id');
        $qtys = $request->input('qty');
        for ($i = 0; $i < count($row_ids); $i++) {
            Cart::update($row_ids[$i], $qtys[$i]);
        }
        request()->session()->flash('success', 'Blood Request Upadate successfully');
        return redirect()->route('frontend.donor.orderlist');
    }

    function checkout()
    {
        return view($this->__LoadDataToView('frontend.donor.checkout'));
    }
    function doCheckout(Request $request)
    {
        try {
            $order_data = [
                'user_id' => auth()->user()->id,
                'order_code' => uniqid(),
                'order_date' => Carbon::now(),
                'address' => $request->address,
                'phone' => $request->phone,
                'order_status' => 'Placed',
                'total' => Cart::total(),
                'payment_mode' => $request->payment_mode,

            ];
            $order = Order::create($order_data);
            if ($order) {
                $to = 0;
                $order_detail_data['order_id'] = $order->id;
                foreach (Cart::content() as $rowid => $cart_item) {
                    $order_detail_data['b_id'] = $cart_item->id;
                    $order_detail_data['quantity'] = $cart_item->qty;
                    $order_detail_data['price'] = $cart_item->price;
                    $order_detail_data['option'] = 'test';

                    OrderDetail::create($order_detail_data);
                    $to = $to + ($cart_item->qty * $cart_item->price);
                    // Cart::remove($rowid);
                    $request->session()->flash('success', ' Order  successfully!!');
                }
                if ($request->payment_mode == 'online') {
                    Session::put('order_id', $order->id);
                    $response = $this->gateway->purchase(array(
                        'amount' => round($to) / 128,
                        'currency' => env('PAYPAL_CURRENCY'),
                        'returnUrl' => url('success'),
                        'cancelUrl' => url('error'),
                    ))->send();

                    if ($response->isRedirect()) {
                        $response->redirect(); // this will automatically forward the customer
                    } else {
                        // not successful
                        return $response->getMessage();
                    }
                }
            } else {
                $request->session()->flash('error', ' order failed!!');
            }
        } catch (\Exception $exception) {
            $request->session()->flash('error', 'Error: ' . $exception->getMessage());
        }
        return redirect()->route('frontend.checkout');
    }
}
