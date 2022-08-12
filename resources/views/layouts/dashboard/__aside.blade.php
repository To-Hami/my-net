<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <div>
            <p class="app-sidebar__user-name">{{auth()->user()->name}} </p>
            {{--            <p class="app-sidebar__user-designation"> {{implode(',',auth()->user()->roles()->pluck('name')->toArray())}} </p>--}}
        </div>
    </div>
    <ul class="app-menu">

        <li><a class="app-menu__item {{request()->routeIs('*/dashboard/dashboard*') ? 'active' : ''}} "
               href="{{route('dashboard.index')}}"><i
                    class="app-menu__icon fa fa-dashboard"></i><span
                    class="app-menu__label">Dashboard</span>
            </a>
        </li>

        <li><a class="app-menu__item {{request()->routeIs('*categories*') ? 'active' : ''}}"
               href="{{route('dashboard.categories.index')}}"><i
                    class="app-menu__icon fa fa-list"></i><span
                    class="app-menu__label">Categories</span>
            </a>
        </li>

        <li><a class="app-menu__item {{request()->routeIs('*movies*') ? 'active' : ''}} "
               href="{{route('dashboard.movies.index')}}"><i
                    class="app-menu__icon fa fa-video"></i><span
                    class="app-menu__label">Movies</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{request()->routeIs('*users*') ? 'users' : ''}} "
               href="{{route('dashboard.users.index')}}"><i
                    class="app-menu__icon fa fa-users"></i><span
                    class="app-menu__label">Users</span>
            </a>
        </li>


        <li class="treeview">
            <a class="app-menu__item {{request()->routeIs('*setting*') ? 'active' : ''}}"
               href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-gear"></i>
                <span class="app-menu__label">Setting</span>
                <i class="treeview-indicator"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item" href="{{route('dashboard.setting.social_login')}}">
                        <i class="icon fa fa-circle-o"></i>
                        Social Login
                    </a>
                </li>

                <li><a class="treeview-item" href="{{route('dashboard.setting.social_link')}}"><i
                            class="icon fa fa-circle-o"></i>
                        Social Link</a>
                </li>

            </ul>
        </li>


    </ul>
</aside>
