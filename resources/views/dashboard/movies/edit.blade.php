@extends('layouts.dashboard.app')

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


                    <form id="movie__properties"
                          action="{{route('dashboard.movies.update',['movie' => $movie->id,
                               'type' => 'updaate'])}}"
                          method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @include('dashboard.partials._errors')


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
                            <img class="poster-preview" style="width: 300px;height: 400px ;margin-top: 10px"
                                 src="{{$movie->poster_path}}">
                        </div>
                        {{-- image--}}
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control image ">
                            <img class="image-preview" style="width: 300px;height: 200px ;margin-top: 10px"
                                 src="{{$movie->image_path}}">

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
                                    type="submit" id="movie__submit-button">Publish
                                <i class="fa fa-plus"> </i>
                            </button>
                        </div>


                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection()



