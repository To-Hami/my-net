@extends('layouts.dashboard.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><h5>Dashboard</h5></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4>Users</h4>
                    <p><b>{{$users_count}}</b></p>
                </div>
            </div>
        </div>


        <div class="col-md-6 col-lg-4">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-list fa-3x"></i>
                <div class="info">
                    <h4>Categories</h4>
                    <p><b>{{$categories_count}}</b></p>
                </div>
            </div>
        </div>


        <div class="col-md-6 col-lg-4">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-video fa-3x"></i>
                <div class="info">
                    <h4>Movies</h4>
                    <p><b>{{$movies_count}}</b></p>
                </div>
            </div>
        </div>
    </div>

@endsection
