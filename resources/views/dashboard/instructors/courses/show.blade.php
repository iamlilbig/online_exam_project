@extends('layouts.dashboard.instructor')
@section('pageName')
Course Information
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5 bg-dark text-white">
            <div class="bg-dark card-header"><h3 class="text-center font-weight-light my-4">@yield('pageName')</h3></div>
                <div class="card-body">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputTitle" value="{{$course->title}}" name="title" type="text" placeholder="courseTitle" disabled readonly/>
                        <label for="inputTitle">Course Title</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputUniqueId" value="{{$course->unique_id}}" name="unique_id" type="text" placeholder="unique id" disabled readonly />
                        <label for="inputUniqueId">Course Unique ID</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="description" id="inputDescription"  disabled readonly>{{$course->description}}</textarea>
                        <label for="inputDescription" class="form-label">Course Description</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputStartedAt" value="{{$course->started_at}}" name="started_at" type="date" placeholder="Start date" disabled readonly/>
                        <label for="inputStartedAt">Start Time</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputEndedAt" value="{{$course->ended_at}}" name="ended_at" type="date" placeholder="End date" disabled readonly/>
                        <label for="inputEndedAt">End Time</label>
                    </div>
                    <a href="{{route('instructors.exams.create')}}">
                    <button class="btn btn-primary">Create new exam</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@if(isset($students))
    @if(count($students) > 0)
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">email</th>
        <th scope="col">phone</th>
        <th scope="col">is active</th>
    </tr>
</thead>
<tbody>
    @foreach($students as $student)
    <tr>
        <th scope="row">{{$student->id}}</th>
        <td>{{$student->name}}</td>
        <td>{{$student->email}}</td>
        <td>{{$student->phone}}</td>
        <td>{{$student->is_active}}</td>
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
                       No Student fonded!
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endif
@if(isset($exams))
    @if(count($exams) > 0)
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">title</th>
        <th scope="col">description</th>
        <th scope="col">duration</th>
        <th scope="col">total score</th>
        <th scope="col">start date</th>
        <th scope="col">end date</th>
        <th scope="col">edit exam</th>
        <th scope="col">delete exam</th>
    </tr>
</thead>
<tbody>
    @foreach($exams as $exam)
    <tr>
        <th scope="row">
        <input class="form-control" id="inputTitle" value="{{$exam->id}}" name="title" type="text" placeholder="courseTitle" disabled readonly/>
        </th>
        <td>
        <input class="form-control" id="inputTitle" value="{{$exam->title}}" name="title" type="text" placeholder="courseTitle" disabled readonly/>
        </td>
        <td>
        <input class="form-control" id="inputTitle" value="{{$exam->description}}" name="title" type="text" placeholder="courseTitle" disabled readonly/>
        </td>
        <td>
        <input class="form-control" id="inputTitle" value="{{$exam->duration}}" name="title" type="text" placeholder="courseTitle" disabled readonly/>
        </td>
        <td>
        <input class="form-control" id="inputTitle" value="{{$scores[$exam->title]}}" name="title" type="text" placeholder="courseTitle" disabled readonly/>
        </td>
        <td>
        <input class="form-control" id="inputTitle" value="{{$exam->datetime}}" name="title" type="text" placeholder="courseTitle" disabled readonly/>
        </td>
        <td>
        <input class="form-control" id="inputTitle" value="{{$exam->endtime}}" name="title" type="text" placeholder="courseTitle" disabled readonly/>
        </td>
        <td>
        <a href="{{route('instructors.exams.edit',['id' => $exam->id])}}">
        <button class="btn btn-primary">edit</button>
        </a>
        </td>
        <td>
        <form method="get" action="{{route('instructors.exams.delete',['id' => $exam->id])}}">
        <input type="submit" class="btn btn-danger" name="submit" value="delete">
        </form>
        </td>
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
                       No Exam fonded!
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endif
@endsection
