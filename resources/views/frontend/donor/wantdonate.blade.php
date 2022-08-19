@extends('layouts.frontend')
@section('title', 'Donor Want to Donate')
{{-- <link href="{{ asset('assets/backend/css/login.css') }}" rel="stylesheet"> --}}
@section('main-content')
<div class="container pt-4">
    <section class="content-header">
        <div class="container-fluid ">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="row-mb-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('frontend.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Donor Login</li>
                        </ol>
                    </div>
                </div>
                
            </div>
        </div><!-- /.container-fluid -->
    </section> 
</div>
    <div class="container-fluid">
        <div id="login-overlay" class="modal-dialog">
            <div class="modal-content" style="background-color:#faebd7; outline:none; border:none;">
                <div class="row">
                    <div class=" col-md-7 col-lg-7 m-auto p-4">
                        <h3 class="modal-title text-danger" id="myModalLabel" style="align:center;font-weight:650;">Donor
                            Registration</h3>
                    </div>
                </div>
                <hr>
                <form action="" method="POST" class=" p-4" style="background-color:#faebd7; ">
                    @csrf
                    <div class="row form-group">
                        <div class="col-sm-12">
                            <div class="well">
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <label for="username">Name</label>
                                        <input type="text" name="name" value=" {{auth()->user()->name}}" class="form-control">
                                        @error('name')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        {!! Form::label('bg_name', 'Blood Group Name') !!}
                                        {!! Form::select('bg_name',$data['bloodGroups'], null, ['class' => 'form-control','placeholder' => 'Select Blood Groups' ]) !!}
                                        @error('bg_name')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    </div>
                                    
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-12 col-sm-12">
                                    <label for="username" class="control-label">Amount in ml</label>
                                    <select name="amount" tabindex="1" class="form-control">
                                        <option value="">Select Blood Amount</option>
                                        <option value="1">500</option>
                                        <option value="2">400</option>
                                    </select>
                                    @error('amount')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <h4 class="modal-title text-danger" id="myModalLabel" style="align:center;">
                                        Willing to Donate?&nbsp;&nbsp;Choose from your Nearby Bloodbanks</h4>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12 col-sm-6">
                                   <div class="form-group">
                                            {!! Form::label('bank_name', 'Bank Type'); !!}
                                            {!! Form::select('bank_name',$data['banknames'], null,['class' => 'form-control','placeholder' => 'Select Bank Name']); !!}
                                            @error('bloodbank')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                  
                                </div>
                                <div class=" col-12 col-sm-6">
                                    <label for="password" class="control-label">Tentative Date</label>
                                    <input class="form-control" type="date" name="date">
                                    @error('name')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row mt-2">
                                <div class="col-12 col-sm-4 m-auto">
                                    <button type="submit" tabindex="1" onclick="signup()"
                                        class="btn btn-primary btn-block btn-danger">Save</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
