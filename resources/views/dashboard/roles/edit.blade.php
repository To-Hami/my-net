@extends('layouts.dashboard.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('dashboard.index')}}"> Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('dashboard.categories.index')}}">Categories</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <div class="tile my-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('dashboard.partials._errors')

                    <form action="{{route('dashboard.categories.update',$category->id)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="row d-flex ">
                            <div class="form-group col-4">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control"
                                       value="{{old('name',$category->name)}}">
                            </div>
                            <div class="col-4 d-flex align-self-center">
                                <button class="btn btn-primary bt-lg mt-3" type="submit">Edit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection()



