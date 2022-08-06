@extends('layouts.dashboard.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('dashboard.index')}}"> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                        <a href="{{route('dashboard.users.create')}}" class="btn btn-primary"> Add
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>

            </form>

        </div>


        <div class="row">
            <div class="col-12 ">
                @if($Users->count() > 0)

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>

                        @foreach($Users as $index=>$User)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$User->name}}</td>
                                <td>{{$User->email}}</td>
                                <td>
                                    <a href="{{route('dashboard.users.edit',$User->id)}}"
                                       class="btn btn-primary"> <i class="fa fa-gear align-self-center"></i> Edit</a>
                                    <form action="{{route('dashboard.users.destroy',$User->id)}}"
                                          method="post" style="display: inline-block">
                                        @csrf
                                        @method('delete')

                                        <button type="submit" class="delete btn btn-danger"><i class="fa fa-trash"></i>Delete
                                        </button>

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


