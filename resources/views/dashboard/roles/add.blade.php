@extends('layouts.dashboard.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('dashboard.index')}}"> Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('dashboard.roles.index')}}">Roles</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Add</li>
        </ol>
    </nav>

    <div class="tile my-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('dashboard.partials._errors')

                    <form action="{{route('dashboard.roles.store')}}" method="post">
                        @csrf
                        @method('post')
                        <div class="row d-flex ">
                            <div class="form-group col-12 ">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{old('name')}}">
                            </div>
                            <div class="permissions col-12">
                                <h3>permissions</h3>
                                <table class="table-hover col-12">
                                    <thead>
                                    <tr>
                                        <td style="width: 15%">#</td>
                                        <td style="width: 20%">Model</td>
                                        <td>Permissions</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $models = ['users','categories']
                                    @endphp

                                    @foreach($models as $index=>$model)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$model}}</td>
                                            <td>
                                                @php
                                                    $permissions = ['create','read','update','delete']
                                                @endphp


                                                <select name="permissions[]" class="form-control select2" multiple>
                                                    @foreach($permissions as $permission)
                                                        <option
                                                            value="{{$permission . '_' .$model }}">{{$permission}}
                                                        </option>
                                                    @endforeach
                                                </select>


                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>


                            <div class="col-12">
                                <button class="btn btn-primary bt-lg mt-3" type="submit">Add</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection()

