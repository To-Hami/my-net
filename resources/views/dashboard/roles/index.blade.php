@extends('layouts.dashboard.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('dashboard.index')}}"> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Roles</li>
        </ol>
    </nav>

    <section class="tile my-4">

        <div class="col-12 ">
            <form action="">
                <div class="row">
                    <div class="form-group col-4 ">
                        <input type="text" name="search" value="{{request()->search}}" class="form-control"
                               placeholder="Search">
                    </div>
                    <div class="form-group col-4 ">
                        <button type="submit" class="btn btn-primary"> Search <i class="fa fa-search"></i></button>
                        <a href="{{route('dashboard.roles.create')}}" class="btn btn-primary"> Add
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>

            </form>

        </div>


        <div class="row">
            <div class="col-12 ">
                @if($roles->count() > 0)

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>

                        @foreach($roles as $index=>$role)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$role->name}}</td>
                                <td>
                                    <a href="{{route('dashboard.roles.edit',$role->id)}}"
                                       class="btn btn-primary">Edit</a>
                                    <form action="{{route('dashboard.roles.destroy',$role->id)}}"
                                          method="post" style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="delete btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                    {{--                    {{ $categories->appends(request()->query())->links() }}--}}

                @else
                    <p class="font-weight:900px">Sorry no data records</p>
                @endif
            </div>

        </div>

    </section>
@endsection


