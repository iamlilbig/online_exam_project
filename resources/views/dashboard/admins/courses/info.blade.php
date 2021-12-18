@extends('layouts.dashboard.admin')
@section('pageName')
Course Info
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5 bg-dark text-white">
            <div class="bg-dark card-header"><h3 class="text-center font-weight-light my-4">@yield('pageName')</h3>
                </div>
                    <div class="card-body">
                    <form action="{{route('admin.courses.update',$course->id)}}" method="post">
                    @csrf
                    @method('patch')
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputTitle" value="{{$course->title}}" name="title" type="text" placeholder="courseTitle" />
                            <label for="inputTitle">Course Title</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputUniqueId" value="{{$course->unique_id}}" name="unique_id" type="text" placeholder="unique id" />
                            <label for="inputUniqueId">Course Unique ID</label>
                        </div>
                        <div class="form-floating mb-3">
                        <select class="form-select" name="instructor_id"  id="instructor_id" aria-label="Default select example">
                            @foreach($instructors as $instructor)
                            @if($instructor->id == $course->instructor->id)
                                <option value="{{$instructor->id}}" selected>(instructor name: {{$instructor->name}}) (instructor email: {{$instructor->email}})</option>
                            @endif
                            <option value="{{$instructor->id}}">(instructor name: {{$instructor->name}}) (instructor email: {{$instructor->email}})</option>
                            @endforeach
                        </select>
                        <label for="instructor_id" class="form-label">Instructor</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="description" id="inputDescription">{{$course->description}}</textarea>
                            <label for="inputDescription" class="form-label">Course Description</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputStartedAt" value="{{$course->started_at}}" name="started_at" type="date" placeholder="Start date" />
                            <label for="inputStartedAt">Start Time</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputEndedAt" value="{{$course->ended_at}}" name="ended_at" type="date" placeholder="End date" />
                            <label for="inputEndedAt">End Time</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <input type="submit" class="btn btn-success" value="Submit">
                        </div>
                    </form>
                </div>
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
        <th scope="col">delete</th>
    </tr>
</thead>
<tbody>
    @foreach($results as $result)
    <form method="post" action="{{route('admin.courses.delete',$result->id)}}">
    @csrf
    @method('delete')
    <tr>
        <th scope="row">{{$result->id}}</th>
        <td>{{$result->name}}</td>
        <td>{{$result->email}}</td>
        <td>{{$result->phone}}</td>
        <td>{{$result->is_active}}</td>
        <input type="hidden" name="student_id" value="{{$result->id}}">
        <td><input type="submit" value="delete" name="confirmation" class="btn btn-danger"></td>
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
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5 bg-dark text-white">
            <div class="bg-dark card-header"><h3 class="text-center font-weight-light my-4">Add Student</h3>
                </div>
                    <div class="card-body">
                    <form action="{{route('admin.courses.add',$course->id)}}" method="post">
                    @csrf
                    @method('put')
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputStudentId" name="student_id" type="number" placeholder="courseTitle" />
                            <label for="inputStudentId">Student id</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <input type="submit" class="btn btn-success" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
