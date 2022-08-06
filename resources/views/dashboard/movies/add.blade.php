@extends('layouts.dashboard.app')
@push('styles')
    <style>
        #movie__raper {
            height: 25vh;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid black;
            flex-direction: column;
        }

    </style>
@endpush
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('dashboard.index')}}"> Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('dashboard.movies.index')}}">movies</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Add</li>
        </ol>
    </nav>

    <div class="tile my-4">
        <div class="container">
            <div class="row ">
                <div class="col-12">
                    <div class=""
                         id="movie__raper"
                         onclick="document.getElementById('movie__file-input').click()"
                    >
                        <i class="fa fa-video fa-2x"></i>
                        <p>Click to upload</p>
                        <input type="file" name=""
                               id="movie__file-input"
                               data-movie-id="{{$movie->id}}"
                               data-url="{{route('dashboard.movies.store')}}"
                               style="display:none">
                    </div>

                    <form id="movie__properties" action="{{route('dashboard.movies.update',$movie->id)}}" method="post"
                          style="display: none">
                        @csrf
                        @method('post')

                        @include('dashboard.partials._errors')


                        <div class="form-group">
                            <lable id="movieUploading__statues" class="my-2">Uploading</lable>

                            <div class="progress">
                                <div class="progress-bar bg-" role="progressbar"
                                     id="movie__upload-progress"
                                     style=";background-color:#009688 !important;"
                                >
                                </div>
                            </div>
                        </div>

                        {{-- name--}}
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" id="movie__name" class="form-control">
                        </div>
                        {{-- description--}}
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        {{-- poster--}}
                        <div class="form-group">
                            <label>Poster</label>
                            <input type="file" name="poster" class="form-control">
                        </div>
                        {{-- image--}}
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        {{-- rate--}}
                        <div class="form-group">
                            <label>Rate</label>
                            <input type="text" name="rate" class="form-control">
                        </div>
                        {{-- year--}}
                        <div class="form-group">
                            <label>Year</label>
                            <input type="number" name="year" class="form-control">
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary bt-lg mt-3" type="submit">Publish
                                <i class="fa fa-plus"> </i>
                            </button>
                        </div>


                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection()

