@extends('layouts.dashboard.student')
@section('pageName')
My Courses
@endsection
@section('content')

@if(isset($results))
    @if(count($results) > 0)
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">unique_id</th>
        <th scope="col">title</th>
        <th scope="col">instructor name</th>
        <th scope="col">description</th>
        <th scope="col">started_at</th>
        <th scope="col">ended_at</th>
        <th scope="col">information</th>
    </tr>
</thead>
<tbody>
    @foreach($results as $result)
    <tr>
        <th scope="row">{{$result->id}}</th>
        <td>{{$result->unique_id}}</td>
        <td>{{$result->title}}</td>
        <td>{{$result->instructor->name}}</td>
        <td>{{$result->description}}</td>
        <td>{{$result->started_at}}</td>
        <td>{{$result->ended_at}}</td>
        <td><a class="btn btn-info" href="{{route('students.courses.exams',['course'=>$result->id,'question_number'=>1])}}">Exams</td>
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
