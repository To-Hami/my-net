<!-- Navbar-->
<header class="app-header"><a class="app-header__logo" href="{{route('welcome')}}">Netflixify
    </a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
                                    aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">


        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i
                    class="fa fa-user fa-lg"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li>
                    <a class="dropdown-item" href="{{route('logout')}}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-lg"></i> Logout
                        <form style="display: none" id="logout-form" action="{{route('logout')}}" method="post">
                            @csrf
                            @method('post')
                        </form>

                    </a>
                </li>
            </ul>
        </li>
    </ul>

</header>
