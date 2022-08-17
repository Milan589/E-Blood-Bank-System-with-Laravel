<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DonorController extends Controller
{
    function registerForm()
    {
        return view('frontend.donor.register');
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
    
}
