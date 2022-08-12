@extends('layouts.dashboard.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('dashboard.index')}}"> Dashboard</a></li>
            <li class="breadcrumb-item active " aria-current="page">Social Link</li>
        </ol>
    </nav>

    <div class="tile my-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('dashboard.partials._errors')

                    <form action="{{route('dashboard.setting.store')}}" method="post">
                        @csrf
                        @method('post')
                        <div class="row d-flex ">

                            @php
                                $social_sites = ['facebook','google','youtube'];
                            @endphp

                            @foreach($social_sites as $social_site)
                                <div class="form-group col-12 ">
                                    <label class="text-uppercase">{{$social_site}} Link</label>
                                    <input type="text" name="{{$social_site}}_link" class="form-control"
                                           value="{{setting($social_site .'_link')}}">
                                </div>

                            @endforeach


                            <div class="col-12">
                                <button class="btn btn-primary bt-lg mt-3 disabled" type="submit">
                                    Save
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection()

