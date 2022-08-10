@extends('layouts.app')
@section('content')
    <section class="listing text-white" style="height:90vh; padding:8% 0;">
        @include('layouts._navbar')
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>
                        {{request()->category_name ?? 'My Favorite '}} Movies
                    </h2>
                </div>

            </div>


            <div class="row">
                @foreach($movies as $movie)
                    <div class="col-md-3 my-2">
                        <div class=" movie p-0 mx-1">
                            <img style="height: 358px !important;"
                                 src="{{$movie->poster_path}}"
                                 class="img-fluid img-thumbnail">


                            <div class="movie__details text-white p-2">


                                <div class="d-flex justify-content-between mb-0">
                                    <p class="fw-500 mb-0">{{$movie->name}} </p>
                                    <p class="mb-0">{{$movie->year}}</p>
                                </div>

                                <div class="d-flex">
                                    <div class="movie__rating">
                                        @for($i=0 ; $i <= $movie->rating ; $i++)
                                            <i class="fa fa-star text-primary mr-1"></i>
                                        @endfor

                                    </div>
                                    <span class="justify-content-center">{{$movie->rating}}</span>

                                </div>

                                <div class="movie_views">

                                    <p>Views : ({{$movie->views}})</p>

                                </div>

                                <div class="movie_act d-flex justify-content-between">
                                    <a href="{{route('movies.show',$movie->id)}}"
                                       class="btn btn-primary flex-fill mr-1">Watch
                                        Naw</a>
                                    @auth()
                                        <i class="far fa-heart fa-2x align-self-center {{$movie->is_favorite?'fw-900':''}}
                                            movie__fav-icon movie-{{$movie->id}}"
                                           data-url="{{route('movies.toggle_favorite',$movie->id)}}"
                                           data-movie-id="{{$movie->id}}">

                                        </i>
                                    @else
                                        <a href="{{route('login')}}"
                                           class="far fa-heart fa-2x align-self-center text-white"></a>
                                    @endauth
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @include('layouts._footer')

    </section>



@endsection
