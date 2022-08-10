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
                         style="display: {{$errors->any()?'none':'flex'}} "
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

                    <form id="movie__properties"
                          action="{{route('dashboard.movies.update',['movie' => $movie->id, 'type' => 'publish'])}}"
                          method="post"
                          style="display: {{$errors->any()?'block':'none'}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @include('dashboard.partials._errors')


                        <div class="form-group" style="display: {{$errors->any()?'none':'block'}} ">
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
                            <input type="text" name="name" value="{{old('name',$movie->name)}}"
                                   id="movie__name" class="form-control">
                        </div>
                        {{-- description--}}
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control">
                               {{old('description',$movie->description)}}
                            </textarea>
                        </div>

                        {{-- categories--}}
                        <div class="form-group">
                            <label>Categories</label>
                            <select class="form-control select2 " name="categories[]" multiple>
                                <option value="" disabled>Select categories</option>
                                @foreach($categories as $category)
                                    <option
                                        value="{{$category->id}}"
                                        {{in_array($category->id,$movie->categories->pluck('id')->toArray()) ? 'selected' : ''}}>
                                        {{$category->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- poster--}}
                        <div class="form-group">
                            <label>Poster</label>
                            <input type="file" name="poster" class="form-control poster">
                            <img class="poster-preview py-2 img-thumbnail" style="max-width: 300px;max-height: 250px"
                                 src="">
                        </div>
                        {{-- image--}}
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control image">
                            <img class="image-preview py-2 img-thumbnail" style="max-width: 300px;max-height: 250px"
                                 src="">
                        </div>
                        {{-- rate--}}
                        <div class="form-group">
                            <label>Rate</label>
                            <input type="text" name="rating" value="{{old('rating',$movie->rating)}}"
                                   class="form-control">
                        </div>
                        {{-- year--}}
                        <div class="form-group">
                            <label>Year</label>
                            <input type="text" value="{{old('year',$movie->year)}}" name="year" class="form-control">
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary bt-lg mt-3"
                                    type="submit" id="movie__submit-button"
                                    style="display: {{$errors->any()?'block':'none'}} ">Publish
                                <i class="fa fa-plus"> </i>
                            </button>
                        </div>


                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection()

