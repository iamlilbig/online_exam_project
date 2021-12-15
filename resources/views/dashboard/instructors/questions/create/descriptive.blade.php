@extends('layouts.dashboard.instructor')
@section('pageName')
Create Descriptive
@endsection
@section('content')


<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-2 bg-dark text-white">
                <div class="btn-group m-3" role="group" aria-label="Basic example">
                    <a href="{{route('instructors.questions.create.multipleChoice')}}" class="btn btn-outline-info">Create Multiple Choice </a>
                    <a href="{{route('instructors.questions.create.descriptive')}}" class="btn btn-info">Create Descriptive </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-lg border-0 rounded-lg mt-5">
    <div class="card-header"><h3 class="text-center font-weight-light my-4">@yield('pageName')</h3></div>
    <div class="card-body">
        <form action="{{route('instructors.questions.store.descriptive')}}" method="post">
        @csrf
            <div class="form-floating mb-3">
                <input class="form-control" id="inputName" name="title"type="text" placeholder="Enter Your Name" />
                <label for="inputName">Title</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="content" id="inputDescription"></textarea>
                <label for="inputDescription" class="form-label">content</label>
            </div>
            <div class="form-floating mb-3">
            <select class="form-select" aria-label="Default select example" name="test_id">
            @foreach($exams as $exam)
                @if ($loop->first)
                    <option value="" selected>Select an exam</option>
                @endif
              <option value="{{$exam->id}}">{{$exam->title."------------".$exam->course->title}}</option>
            @endforeach
            </select>
            <label for="test_id">select test</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="inputTime" name="default_score" type="number" placeholder="Enter time" />
                <label for="inputTime">default score</label>
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
