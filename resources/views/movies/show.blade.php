@extends('layouts.app')
@section('content')
    <!--slider-->
    <section id="banner">
        @include('layouts._navbar')

        <div class=" row movie text-white d-flex justify-content-center align-items-center ">
            <div class="movie__bg" style="background: linear-gradient(rgba(0,0,0, 0.6),
                rgba(0,0,0, 0.6)), url({{$movie->image_path}}) center/cover no-repeat;">
            </div>
            <div class="container">
                <div class="row">
                    <!--                play film-->
                    <div class="col-md-8">
                        <div id="player"></div>
                    </div>

                    <!--                details film-->


                    <div class="col-md-4 ">

                        <div class="d-flex justify-content-between ">

                            <div class="movie__name"><h2>{{$movie->name}}</h2></div>

                            <div class="movie__year align-self-center">{{$movie->year}}</div>

                        </div>

                        <div class="movie_views my-2">Views : <span id="movie__views"> {{$movie->views}}</span></div>

                        <div class=" d-flex movie__rating mx-sm-2">
                            <div class="d-flex">
                                @for($i = 0 ; $i < $movie->rating ;$i++)
                                    <span class="fa fa-star text-primary mx-1"></span>
                                @endfor

                            </div>
                            <span class="align-self-center">{{$movie->rating}}</span>
                        </div>
                        <p class=" movie__desc my-md-2">
                            {{Str::limit($movie->description,250)}}
                        </p>
                        <div class="movie__cat my-md-4 mx-2">
                            @auth()
                                <a href="#" class=" btn btn-outline-light text-capitalize movie__fav-btn"
                                   id="movie__fav-btn">
                                            <span
                                                class="far fa-heart  align-self-center {{$movie->is_favorite?'fw-900':''}}
                                                    movie__fav-icon movie-{{$movie->id}}"
                                                data-url="{{route('movies.toggle_favorite',$movie->id)}}"
                                                data-movie-id="{{$movie->id}}"></span>
                                    Add to favorite
                                </a>
                            @else
                                <a href="{{route('login')}}" class=" btn btn-primary text-capitalize">
                                    add to favorite<i
                                        class="far fa-heart mx-2"></i>
                                </a>

                            @endauth
                        </div>

                    </div>


                </div>
            </div>
        </div>

    </section>
    <!--end slider-->
    <!--listing-->
    <section class="listing p-2">

        <div class="container">

            <div class="row text-white my-3">
                <div class="col-12 d-flex justify-content-between">
                    <h3>Related Movies</h3>
                    <a href="#" class="align-self-center ">See All</a>
                </div>
            </div>

            <div class="row movies owl-carousel owl-theme">
                @foreach($related_movies as $related_movie)
                    <div class=" movie p-0 mx-1">
                        <img src="{{$related_movie->poster_path}}" class="img-fluid img-thumbnail">


                        <div class="movie__details text-white p-2">


                            <div class="d-flex justify-content-between mb-0">
                                <p class="fw-500 mb-0">{{$related_movie->name}} </p>
                                <p class="mb-0">{{$related_movie->year}}</p>
                            </div>

                            <div class="d-flex">
                                <div class="movie__rating">
                                    @for($i=0 ; $i>$related_movie->ratting ; $i++)
                                        <i class="fa fa-star text-primary mr-1"></i>
                                    @endfor

                                </div>
                                <span class="justify-content-center">{{$related_movie->ratting}}</span>

                            </div>

                            <div class="movie_views">

                                <p>Views : {{$related_movie->views}}</p>

                            </div>

                            <div class="movie_act d-flex justify-content-between">
                                <a href="{{route('movies.show',$related_movie->id)}}"
                                   class="btn btn-primary flex-fill mr-1">Watch Naw</a>
                                @auth()
                                    <i class="far fa-heart fa-2x align-self-center {{$related_movie->is_favorite?'fw-900':''}}
                                        movie__fav-icon movie-{{$related_movie->id}}"
                                       data-url="{{route('movies.toggle_favorite',$related_movie->id)}}"
                                       data-movie-id="{{$related_movie->id}}">

                                    </i>
                                @else
                                    <a href="{{route('login')}}"
                                       class="fa fa-heart align-self-center text-white fa-2x"></a>
                                @endauth
                            </div>

                        </div>
                    </div>
                @endforeach


            </div>


        </div>

    </section>
    <!--end listing-->


    <!--footer-->
    @include('layouts._footer')

@endsection

@push('scripts')
    <script>
        var file =
            "[Auto]{{Storage::url('movies/' . $movie->id . '/' . $movie->id . '.m3u8') }}," +
            "[360]{{Storage::url('movies/' . $movie->id . '/' . $movie->id .'_0'. '_100.m3u8') }}," +
            "[480]{{ Storage::url('movies/' . $movie->id . '/' . $movie->id .'_1'. '_250.m3u8') }}," +
            "[720]{{Storage::url('movies/' . $movie->id . '/' . $movie->id .'_2'. '_500.m3u8') }}";
        var player = new Playerjs({
            id: "player",
            file: file,
            poster: "{{ $movie->image_path }}",
            default_quality: "480",
        });

        let viewsCounted = false;

        function PlayerjsEvents(event, id, data) {
            if (event === "duration") {
                duration = data;
            }
            if (event === "time") {
                time = data;
            }
            let percent = (time / duration) * 100;
            if (percent > 10 && !viewsCounted) {
                $.ajax({
                    url: "{{ route('movies.increment_views', $movie->id) }}",
                    method: 'POST',
                    success: function () {
                        let views = parseInt($('#movie__views').html());
                        $('#movie__views').html(views + 1);
                    },
                });//end of ajax call
                viewsCounted = true;
            } //end of if
        }//end of player event function
    </script>
@endpush
