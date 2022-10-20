@extends('layouts.frontend')
@section('title', 'Checkout Home')
@section('main-content')
    <div class="container">
        <section class="content-header">
            <div class="container-fluid ">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="row-mb-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Request Blood</li>
                            </ol>
                        </div>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>
        @include('backend.includes.flash')
    </div>

    <div class="container2">

        <h4>Request Blood</h4>

        <form action="{{ route('frontend.donor.doregister') }}" method='post' name="form" id="form">
            @csrf
            <div class="form-handler pt-4">
                <label for="">Name : </label>
                <span style="font-weight: 700"> {{ Auth()->user()->name }} </span>
            </div>
            <div class="form-handler pt-4">
                <label for="">Address : </label>
                <span style="font-weight: 700"> {{ Auth()->user()->donor->address }} </span>
            </div>
            <div class="form-handler  pt-4">
                <label for="">Phone : </label>
                <span style="font-weight: 700"> {{ Auth()->user()->phone }} </span>
            </div>
            <div class="form-handler  pt-4">
                <label for="">Email : </label>
                <span style="font-weight: 700"> {{ Auth()->user()->email }} </span>
            </div>
            <div class="form-handler pt-4">
                {!! Form::select('bg_id', $data['bloodGroups'], null, [
                    'class' => 'form-control',
                    'placeholder' => 'Select Blood Groups',
                ]) !!}
                @include('backend.common.validation_field', ['field' => 'bg_id'])
            </div>
            <div class="form-handler">
                <button type="submit" class="btn-register">Register</button>
                <button type="reset" class="btn-register">Reset</button>
            </div>
        </form>
    </div>

@endsection
