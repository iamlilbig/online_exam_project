@extends('layouts.dashboard.admin')
@section('pageName')
active instructors
@endsection
@section('content')
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
@if (\Session::has('success'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5 bg-dark text-white">
                    <div class="bg-dark card-header">
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if (\Session::has('error'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5 bg-dark text-white">
                    <div class="bg-dark card-header">
                        <div class="alert alert-danger">
                            <ul>
                                <li>{!! \Session::get('error') !!}</li>
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
    <form method="get" action="{{route('admin.edit.instructors',$result->id)}}">
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
                       No Student fonded!
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endif
@endsection
