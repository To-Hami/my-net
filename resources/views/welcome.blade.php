@extends('layouts.app')
@section('content')

    <!--slider-->
    <section id="banner">
        {{--        navbar--}}
        @include('layouts._navbar')
        {{--carosal--}}
        <div class="movies owl-carousel owl-theme">
            @foreach($latest_movies as $latest_movie)
                <div class="movie text-white d-flex justify-content-center align-items-center my-sm-2">

                    <div class="movie__bg" style="background: linear-gradient(rgba(0,0,0, 0.6),
                        rgba(0,0,0, 0.6)), url({{$latest_movie->image_path}}) center/cover no-repeat;"></div>

                    <div class="container">

                        <div class="row">

                            <div class="col-md-6 ">

                                <div class="d-flex justify-content-between ">

                                    <div class="movie__name"><h2>{{$latest_movie->name}}</h2></div>

                                    <div class="movie__year align-self-center">{{$latest_movie->year}}</div>

                                </div>

                                <div class=" d-flex movie__rating mx-sm-2">
                                    <div class="d-flex">
                                        @for( $i = 0 ;$i< $latest_movie->rating ;$i++)
                                            <span class="align-self-center fa fa-star text-primary mx-1"></span>
                                        @endfor
                                        <span class="mx-2">{{$latest_movie->rating}}</span>
                                    </div>
                                </div>
                                <p class=" movie__desc my-md-2">{{Str::limit($latest_movie->description,350)}} </p>
                                <div class="movie__cat my-md-4">
                                    <a href="{{route('movies.show',$latest_movie->id)}}"
                                       class=" btn btn-primary text-capitalize">
                                        <i class="fa fa-play text-white"></i>
                                        Watch Now</a>
                                    @auth()
                                        <a href="#" class=" btn btn-outline-light text-capitalize movie__fav-btn"
                                           id="movie__fav-btn">
                                            <span
                                                class="far fa-heart  align-self-center {{$latest_movie->is_favorite?'fw-900':''}}
                                                    movie__fav-icon movie-{{$latest_movie->id}}"
                                                data-url="{{route('movies.toggle_favorite',$latest_movie->id)}}"
                                                data-movie-id="{{$latest_movie->id}}"></span>
                                            Add to favorite
                                        </a>
                                    @else
                                        <a href="{{route('login')}}" class=" btn btn-outline-light text-capitalize">
                                            <i class="far fa-heart "></i>
                                            Add To Favorite
                                        </a>
                                    @endauth
                                </div>

                            </div>

                            <div class="movie__image   col-6 mt-3 mx-auto mx-md-0 col-md-5 ml-md-auto  col-lg-3  ">
                                <img src="{{$latest_movie->poster_path}}" class="img-fluid" alt="">
                            </div>

                        </div>

                    </div>

                </div>
            @endforeach
        </div>

    </section>
    <!--end slider-->

    <!--listing-->
    @foreach( $categories as $category)
        <section class="listing p-2">

            <div class="container">

                <div class="row text-white my-3">
                    <div class="col-12 d-flex justify-content-between">
                        <h3>{{$category->name}}</h3>
                        <a href="{{route('movies.index',['category_name' => $category->name ])}}"
                           class="align-self-center ">See All</a>
                    </div>
                </div>

                <div class="row movies owl-carousel owl-theme">
                    @foreach($category->movies as $movie)
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
                    @endforeach
                </div>


            </div>

        </section>
        <!--end listing-->
    @endforeach

    @include('layouts._footer')

@endsection

