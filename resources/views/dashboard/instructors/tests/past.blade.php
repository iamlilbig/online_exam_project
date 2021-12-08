@extends('layouts.dashboard.instructor')
@section('pageName')
Past Tests
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
        <th scope="col">id</th>
        <th scope="col">title</th>
        <th scope="col">course unique id</th>
        <th scope="col">description</th>
        <th scope="col">duration</th>
        <th scope="col">total score</th>
        <th scope="col">date</th>
        <th scope="col">time</th>
        <th scope="col">information</th>
    </tr>
</thead>
<tbody>
    @foreach($results as $result)
    <tr>
        <th scope="row">{{$result->id}}</th>
        <td>{{$result->title}}</td>
        <td>{{$result->course->unique_id}}</td>
        <td>{{$result->description}}</td>
        <td>NULL</td>
        <td>{{$result->date}}</td>
        <td>{{$result->time}}</td>
        <td><a href="{{route('instructors.exams.edit')}}"><button class="btn btn-primary">more information</button></a></td>
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
