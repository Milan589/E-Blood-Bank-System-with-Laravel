@extends('layouts.frontend')
@section('title', 'Donor Want to Donate')
@section('main-content')

    <div class="container-fluid"  >
        <div id="login-overlay" class="modal-dialog" >
            <div class="modal-content" style="background-color:#faebd7;">
                <div class="row" >
                    <div class=" col-md-7 col-lg-7 m-auto p-4" >
                        <h3 class="modal-title text-danger" id="myModalLabel" style="align:center;font-weight:650;">Donor
                            Registration</h3>
                    </div>
                </div>
                <hr>
                <form  class=" p-4" style="background-color:#faebd7; " >
                    <div class="row form-group">
                        <div class="col-sm-12">
                            <div class="well">
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <label for="username">Name<font color="red">*</font>
                                        </label>
                                        <input type="text" name="name" class="form-control">
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
                                    <label for="username" class="control-label">Blood Group</label>
                                    <select name="bloodgroup" tabindex="1" class="form-control">
                                        <option value="-1">Select Blood Group</option>

                                        <option value="18">AB-Ve</option>
                                        <option value="17">AB+Ve</option>
                                        <option value="12">A-Ve</option>
                                        <option value="11">A+Ve</option>
                                        <option value="14">B-Ve</option>
                                        <option value="13">B+Ve</option>
                                        <option value="23">Oh-VE</option>
                                        <option value="22">Oh+VE</option>
                                        <option value="16">O-Ve</option>
                                        <option value="15">O+Ve</option>
                                    </select>
                                    @error('bloodgroup')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                                    <label for="Pincode" class="control-label">Blood Bank Name
                                    </label>
                                    <select tabindex="1" id="bbnamelist" name="bloodbank" class="form-control">
                                        <option value="-1">Select Blood Bank</option>
                                    </select>
                                    @error('bloodbank')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

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
