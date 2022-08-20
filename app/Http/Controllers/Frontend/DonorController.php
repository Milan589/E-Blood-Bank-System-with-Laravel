<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\BankType;
use App\Models\Backend\BloodBank;
use App\Models\Backend\BloodDonation;
use App\Models\Backend\BloodGroup;
use App\Models\Backend\BloodPouch;
use App\Models\Backend\Location;
use App\Models\Donor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DonorController extends Controller
{
    function registerForm()
    {
        $data['bloodGroups'] = BloodGroup::pluck('bg_name', 'id');
        return view('frontend.donor.register', compact('data'));
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
        return view('frontend.donor.home');
    }
    function donate()
    {
        $data['bloodGroups'] = BloodGroup::pluck('bg_name', 'id');
        $data['banknames'] = BloodBank::pluck('bank_name', 'id');
        return view('frontend.donor.wantdonate', compact('data'));
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

    function bloodbank(){
        $data['records'] = BloodBank::orderby('created_at', 'desc')->get();
        return view('frontend.donor.bloodbank',compact('data'));
    }
    function bloodAvailable(){
        $data['records'] = BloodGroup::pluck('bg_name','id');
        $data['records'] = BloodPouch::orderby('created_at','desc')->get();      
        return view('frontend.donor.availability',compact('data'));
    }
}
