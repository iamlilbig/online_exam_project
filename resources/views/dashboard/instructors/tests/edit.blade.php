@extends('layouts.dashboard.instructor')
@section('pageName')
Test Edit
@endsection
@section('content')
<div class="card shadow-lg border-0 rounded-lg mt-5">
    <div class="card-header"><h3 class="text-center font-weight-light my-4">@yield('pageName')</h3></div>
    <div class="card-body">
        <form action="{{route('instructors.exams.update',['id' => $exams->id])}}" method="post">
        @method('put')
        @csrf
            <div class="form-floating mb-3">
                <input class="form-control" id="inputName" name="title" value="{{$exams->title}}" type="text" placeholder="Enter Your Name" />
                <label for="inputName">Title</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="description" id="inputDescription">{{$exams->description}}</textarea>
                <label for="inputDescription" class="form-label">Course Description</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="inputDate" name="date" value="{{$exams->date}}" type="date" placeholder="Enter date" />
                <label for="inputDate">Date</label>
            </div>
            <div class="form-floating mb-3">
            <select class="form-select" aria-label="Default select example" name="course_id">
            @foreach($courses as $course)
                @if ($course->id == $exams->course_id)
                    <option value="{{$course->id}}" selected>{{$course->unique_id}}</option>
                    @continue
                @endif
              <option value="{{$course->id}}">{{$course->unique_id}}</option>
            @endforeach
            </select>
            </div>
            <div class="form-floating mb-3">
              <input type="time" id="inputMDEx1" class="form-control" name="time" required>
              <label for="inputMDEx1">Choose your time</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="inputTime" name="duration" type="number" value="{{$exams->duration}}" placeholder="Enter time" />
                <label for="inputTime">duration</label>
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

@endsection

