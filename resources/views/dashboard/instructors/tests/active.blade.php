@extends('layouts.dashboard.instructor')
@section('pageName')
Active Tests
@endsection
@section('content')
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


@if(isset($results))
    @if(count($results) > 0)
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Course unique id</th>
        <th scope="col">Description</th>
        <th scope="col">Duration</th>
        <th scope="col">Total score</th>
        <th scope="col">Date</th>
        <th scope="col">Time</th>
        <th scope="col">Information</th>
        <th scope="col">Delete</th>
    </tr>
</thead>
<tbody>
    @foreach($results as $result)
    <tr>
        <th scope="row">{{$result->id}}</th>
        <td>{{$result->title}}</td>
        <td>{{$result->course->unique_id}}</td>
        <td>{{$result->description}}</td>
        <td>{{$result->duration}}</td>
        <td>NULL</td>
        <td>{{$result->date}}</td>
        <td>{{$result->time}}</td>
        <td><a href="{{route('instructors.exams.edit',['id'=>$result->id])}}"><button class="btn btn-primary">More information</button></a></td>
        <td><a href="{{route('instructors.exams.delete',['id'=>$result->id])}}"><button class="btn btn-danger">Delete</button></a></td>
    </tr>
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
                       No Course is active!
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endif
@endsection
