@extends('layouts.dashboard.admin')
@section('pageName')
Search students
@endsection
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5 bg-dark text-white">
                <div class="bg-dark card-header"><h3 class="text-center font-weight-light my-4">@yield('pageName')</h3>
                </div>
                <form class="form-horizontal" method="post" action="{{route('admin.search.students')}}">
                    <div class="card-body" >
                        @csrf
                        <div>
                            <label for="searchMethod" class=" d-inline">search method</label>
                            <div class="d-flex justify-content-end">
                                <div class="form-check form-check-inline d-inline">
                                    <input class="form-check-input" type="radio" name="searchMethod" id="inlineRadio1" checked value="id">
                                    <label class="form-check-label" for="inlineRadio1">id</label>
                                </div>

                                <div class="form-check form-check-inline d-inline">
                                    <input class="form-check-input" type="radio" name="searchMethod" id="inlineRadio2" value="name">
                                    <label class="form-check-label" for="inlineRadio2">name</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="searchMethod" id="inlineRadio3" value="email">
                                    <label class="form-check-label" for="inlineRadio3">email</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="searchMethod" id="inlineRadio4" value="phone">
                                    <label class="form-check-label" for="inlineRadio4">phone</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputEmail" name="search" type="text" placeholder="search" />
                            <label for="inputEmail">search</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <input type="submit" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if($errors->any())
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="bg-dark card-header">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if(isset($results))
    @if(count($results) > 0)
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">email</th>
        <th scope="col">phone</th>
        <th scope="col">is active</th>
        <th scope="col">is confirmed</th>
        <th scope="col">edit</th>
    </tr>
</thead>
<tbody>
    @foreach($results as $result)
    <form method="get" action="{{route('admin.edit.students',$result->id)}}">
    @csrf
    <tr>
        <th scope="row">{{$result->id}}</th>
        <td>{{$result->name}}</td>
        <td>{{$result->email}}</td>
        <td>{{$result->phone}}</td>
        <td>{{$result->is_active}}</td>
        <td>{{$result->is_confirmed}}</td>
        <td><input type="submit" value="Edit" name="confirmation" class="btn btn-info"></td>
    </tr>
    </form>
    @endforeach
</tbody>
</table>
    @else
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5 bg-dark text-white">
                <div class="bg-dark card-header">
                    <h3 class="text-center font-weight-light my-4">
                       No result fonded!
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endif
@endsection
