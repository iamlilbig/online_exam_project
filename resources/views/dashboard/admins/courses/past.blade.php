@extends('layouts.dashboard.admin')
@section('pageName')
Past Courses
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
        <th scope="col">instructor_id</th>
        <th scope="col">description</th>
        <th scope="col">started_at</th>
        <th scope="col">ended_at</th>
    </tr>
</thead>
<tbody>
    @foreach($results as $result)
    <tr>
        <th scope="row">{{$result->id}}</th>
        <td>{{$result->unique_id}}</td>
        <td>{{$result->title}}</td>
        <td>{{$result->instructor_id}}</td>
        <td>{{$result->description}}</td>
        <td>{{$result->started_at}}</td>
        <td>{{$result->ended_at}}</td>
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
                       No have past courses!
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endif








@endsection
