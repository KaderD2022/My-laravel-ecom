@extends('layouts.base')

@section('title')
    
@endsection

@section('content')

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>S'inscrire
                    </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Account</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row new-account-login">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <form class="mt-3 collapse review-form-box" id="formLogin">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="InputEmail" class="mb-0">Email Address</label>
                                <input type="email" class="form-control" id="InputEmail" placeholder="Enter Email"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputPassword" class="mb-0">Password</label>
                                <input type="password" class="form-control" id="InputPassword" placeholder="Password"> </div>
                        </div>
                        <button type="submit" class="btn hvr-hover">Login</button>
                    </form>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <form class="mt-3 collapse review-form-box" id="formRegister">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="InputName" class="mb-0">First Name</label>
                                <input type="text" class="form-control" id="InputName" placeholder="First Name"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputLastname" class="mb-0">Last Name</label>
                                <input type="text" class="form-control" id="InputLastname" placeholder="Last Name"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputEmail1" class="mb-0">Email Address</label>
                                <input type="email" class="form-control" id="InputEmail1" placeholder="Enter Email"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputPassword1" class="mb-0">Password</label>
                                <input type="password" class="form-control" id="InputPassword1" placeholder="Password"> </div>
                        </div>
                        <button type="submit" class="btn hvr-hover">Register</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3 offset-sm-3 offset-lg-3">
                    <div class="Account-address">
                        <div class="title-left">
                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            
                                @endforeach
                            </ul>
                            </div>  
                            @endif
                            
                            @if (Session::has('status'))
                            <br>
                            <div class="alert alert-success">
                            <strong>{{ Session::get('status') }}</strong>
                            </div>  
                            @endif
                            @if (Session::has('error'))
                            <br>
                            <div class="alert alert-danger">
                            <strong>{{ Session::get('error') }}</strong>
                            </div>  
                            @endif
                            <h3>
                              Register  /  Don't have  an account ? 
                              <a href="{{url('/sign')}}" target="_blank" rel="noopener noreferrer">
                                Sign up here
                              </a>
                            </h3>
                        </div> 
                        <form class="needs-validation"  action="{{ url('/accessaccount')}}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="email">Email Address *</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="" required>
                                <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                            </div>

                            <div class="mb-3">
                                <label for="email">Password *</label>
                                <input type="password" name="password" class="form-control" id="email" placeholder="" required>
                                <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                            </div>

                            <div class="row">
                                    <div class="col-md-12 mb-12">
                                        <input type="submit" value="Sign up" class="btn btn-default hvr-hover btn-cart w-100">
                                    </div>
                            </div>
                            <hr class="mb-1"> 
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->

@endsection