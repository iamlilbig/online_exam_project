@extends('layouts.dashboard.admin')
@section('pageName')
Create course
@endsection
@section('content')
<div class="card shadow-lg border-0 rounded-lg mt-5">
    <div class="card-header"><h3 class="text-center font-weight-light my-4">@yield('pageName')</h3></div>
    <div class="card-body">
        <form action="{{route('admin.courses.store')}}" method="post">
        @csrf
            <div class="form-floating mb-3">
                <input class="form-control" id="inputTitle" name="title" type="text" placeholder="courseTitle" />
                <label for="inputTitle">Course Title</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="inputUniqueId" name="unique_id" type="text" placeholder="unique id" />
                <label for="inputUniqueId">Course Unique ID</label>
            </div>
            <div class="form-floating mb-3">
            <select class="form-select" name="instructor_id" id="instructor_id" aria-label="Default select example">
                @foreach($instructors as $instructor)
                <option value="{{$instructor->id}}">(instructor name: {{$instructor->name}}) (instructor email: {{$instructor->email}})</option>
                @endforeach
            </select>
            <label for="instructor_id" class="form-label">Instructor</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="description" id="inputDescription"></textarea>
                <label for="inputDescription" class="form-label">Course Description</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="inputStartedAt" name="started_at" type="date" placeholder="Start date" />
                <label for="inputStartedAt">Start Time</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="inputEndedAt" name="ended_at" type="date" placeholder="End date" />
                <label for="inputEndedAt">End Time</label>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                <input type="submit" class="btn btn-success" value="Submit">
            </div>
        </form>
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
@endsection
