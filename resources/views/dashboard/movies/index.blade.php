@extends('layouts.dashboard.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('dashboard.index')}}"> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Movies</li>
        </ol>
    </nav>

    <section class="tile my-4">

        <div class="col-12 ">
            <form action="">
                <div class="row">
                    <div class="form-group col-4 ">
                        <input type="text" name="search" value="{{request()->search}}"
                               class="form-control"
                               placeholder="Search by name, desc, year, rating ...">
                    </div>
                    <div class="form-group col-4 ">
                        <select class="form-control" name="category">
                            <option value="">All categories</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}"
                                    {{request()->category == $category->id ? 'selected' : ''}}>
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-4 ">
                        <button type="submit" class="btn btn-primary"> Search <i class="fa fa-search"></i></button>
                        <a href="{{route('dashboard.movies.create')}}" class="btn btn-primary"> Add
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>

                </div>

            </form>

        </div>


        <div class="row">
            <div class="col-12 ">
                @if($movies->count() > 0)

                    <table class="table table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th style="width: 20%">Name</th>
                            <th style="width: 30%">Description</th>
                            <th style="width: 10%">Categories</th>
                            <th>Year</th>
                            <th>Rating</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>

                        @foreach($movies as $index=>$movie)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$movie->name}}</td>
                                <td>{{Str::limit($movie->description,50)}}</td>
                                <td>
                                    @foreach($movie->categories as $category)
                                        <h5 style="display: inline-block"><span
                                                class="badge badge-primary"> {{$category->name}}</span>

                                        </h5>
                                    @endforeach
                                </td>
                                <td>{{$movie->year}}</td>
                                <td><i class="fa fa-star text-warning "></i>{{$movie->rating}}</td>
                                <td>
                                    <a href="{{route('dashboard.movies.edit',$movie->id)}}"
                                       class="btn btn-primary disabled">Edit</a>
                                    <form action="{{route('dashboard.movies.destroy',$movie->id)}}"
                                          method="post" style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="delete btn btn-danger disabled" disabled>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>

                    </table>

                    {{--                    {{ $movies->appends(request()->query())->links() }}--}}
                @else
                    <p class="font-weight:900px">Sorry no data records</p>
                @endif
            </div>

        </div>

    </section>
@endsection


