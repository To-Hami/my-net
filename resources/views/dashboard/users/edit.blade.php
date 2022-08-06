@extends('layouts.dashboard.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('dashboard.index')}}"> Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('dashboard.users.index')}}">Roles</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <div class="tile my-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('dashboard.partials._errors')

                    <form action="{{route('dashboard.users.update',$user->id)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="row d-flex ">
                            <div class="form-group col-12 ">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{$user->name}}">
                            </div>
                            <div class="form-group col-12 ">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control"
                                       value="{{$user->email}}">
                            </div>
                            {{--                            <div class="form-group col-12 ">--}}
                            {{--                                <label>Password</label>--}}
                            {{--                                <input type="password" name="password" class="form-control">--}}
                            {{--                            </div>--}}
                            {{--                            <div class="form-group col-12 ">--}}
                            {{--                                <label>Password Confirmation</label>--}}
                            {{--                                <input type="password" name="password_confirmation" class="form-control">--}}
                            {{--                            </div>--}}


                            <div class="col-12">
                                <button class="btn btn-primary bt-lg mt-3" type="submit"><i class="fa fa-gear"></i>
                                    Update
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection()

