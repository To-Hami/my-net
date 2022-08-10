@extends('layouts.app')

@section('content')


    <div class="login">

        <div class="login__bg"></div>

        <div class="container">

            <div class="row">

                <div class=" col-10 mx-auto col-md-6 mx-auto  bg-white p-3  ">

                    <h2 class="fw-500 text-center">Netflixi<span class="text-primary ">fiy</span></h2>
                    <hr>

                    <form action="{{route('login')}}" method="post">
                    @csrf
                    @method('post')

                    @include('dashboard.partials._errors')

                    <!--email-->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="email" value="tohami@app.com">
                        </div>


                        <!--password-->
                        <div class="form-group ">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" value="password">
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Remember me</label>
                            </div>
                        </div>

                        <!--login-->
                        <div class="form-group ">
                            <button class=" btn btn-primary  btn-block">Login</button>
                        </div>

                        <hr>

                        <p class="text-center">Create an account <a class="text-primary"
                                                                    href="{{route('register')}}">Register</a></p>

                        <a href="/login/facebook" class="btn btn-block text-white" style="background-color: #3B5998;">
                            Login with
                            facebook
                        </a>
                        <a href="/login/google" class="btn btn-block text-white" style="background-color:  #ea4335;">Login
                            with Gmail
                        </a>


                    </form>

                </div>

            </div>

        </div>


    </div>


@endsection
