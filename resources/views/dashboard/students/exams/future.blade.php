@extends('layouts.dashboard.student')
@section('pageName')
Active Exams
@endsection
@section('content')
@if(isset($results))
    @if(count($results) > 0)
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">Title</th>
        <th scope="col">Course unique id</th>
        <th scope="col">Description</th>
        <th scope="col">Duration</th>
        <th scope="col">Total score</th>
        <th scope="col">start</th>
        <th scope="col">end</th>
    </tr>
</thead>
<tbody>
    @foreach($results as $result)
    @foreach($result as $test)
    <form method="get" action="{{route('admin.edit.students',$test->id)}}">
    <tr>
        <td>{{$test->title}}</td>
        <td>{{$test->course->unique_id}}</td>
        <td>{{$test->description}}</td>
        <td>{{$test->duration}}</td>
        <td>{{$scores[$test->title]}}</td>
        <td>{{$test->datetime}}</td>
        <td>{{$test->endtime}}</td>
    </tr>
    </form>
    @endforeach
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
                       No exam fonded!
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endif
@endsection
