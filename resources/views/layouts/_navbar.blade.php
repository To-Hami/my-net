<nav class="  navbar navbar-expand-lg navbar-dark fixed-top py-2">
    <div class="container">

        <a class="navbar-brand fw-500" href="{{route('welcome')}}">Netflix<span class="text-primary">ify</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="  collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav col-md-8 col-lg-8">
                <form class="form-inline my-2 my-lg-0 mr-auto  p-sm-0 " style="width: 100%">
                    <input class="form-control  mr-sm-2 bg-transparent border-1" type="search"
                           placeholder="Search of your favorite movie"
                           aria-label="Search movie" style="width: 70%">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">
                        Search<span> <i class="fa fa-search"></i>  </span>
                    </button>
                </form>
            </ul>

            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item mx-2">
                        <a href="{{route('movies.index',['favorite' => auth()->user()->id])}}"
                           class="nav-link text-white" style="position:relative;">
                            <i class="fa fa-heart fa-2x"></i>
                            <span class="bg-primary text-white d-flex justify-content-center align-items-center"
                                  style="
                              position: absolute;
                                  top: -8px;
                                  right: -8px;
                                  width:30px;height: 25px;
                                  border: 1px solid #2591cb;
                                  border-radius: 50%;" id="nav__fav-icon"
                                  data-fav-count="{{auth()->user()->movies_count}}">
                                          {{auth()->user()->movies_count < 9 ? auth()->user()->movies_count : '9+'}}
                                      </span>
                        </a>
                    </li>
                    <li class="nav-item dropdown text-white">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                           data-toggle="dropdown" aria-expanded="false">
                            {{auth()->user()->name  }}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('dashboard.index')}}">
                                <i class="fa fa-dashboard"></i>
                                Dashboard</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('logout')}}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i>
                                Logout</a>
                            <form style="display: none" id="logout-form" action="{{route('logout')}}" method="post">
                                @csrf
                                @method('post')
                            </form>
                        </div>
                    </li>

                @else
                    <a href="{{route('login')}}" class="btn btn-primary btn-block  mx-md-1  my-2 my-smd-0  "
                       style="border-radius: 0"> <i class="fa fa-acorn"></i>
                        login
                    </a>
                    <a href="{{route('register')}}" class="btn btn-outline-light mx-md-1 btn-block my-2 my-smd-0  "
                       style="border-radius: 0">register</a>
                @endauth


            </ul>


        </div>
    </div>

</nav>
