@extends('layouts.exam.questions')
@section('timer')
students
@endsection
@section('timer')
{{$exam->results->where('student_id',Auth::user()->id)->first()->ended_at}}
@endsection
@section('pageName')
{{$question['title']}}
@endsection
@section('content')
<div class="card shadow-lg border-0 rounded-lg mt-5">
    <div class="card-header"><h2 class="text-center font-weight-light my-4">{{$question_number .". ".$question['title']}}</h2></div>
    <div class="card-body">
    @if($question_number == count($questions))
        <form action="{{route('student.exam.end',['id'=>$exam->id])}}" method="post">
        @csrf
            <div class="form-floating mb-3 text-center">
            <h5>
                {{$question['content']}}
            <h5>
            </div>
            <hr>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="answer" id="inputDescription"></textarea>
                <label for="inputDescription" class="form-label">Answer</label>
            </div>
                <input type="hidden" name="question_id" value="{{$question['id']}}">
            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                <input type="submit" name="end" class="btn btn-info" value="End Exam">
            </div>
        </form>
            @else
        <form action="{{route('student.exam',['id'=>$exam->id,'question_number'=>$question_number + 1])}}" method="post">
        @csrf
            <div class="form-floating mb-3 text-center">
            <h5>
                {{$question['content']}}
            <h5>
            </div>
            <hr>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="answer" id="inputDescription"></textarea>
                <label for="inputDescription" class="form-label">Answer</label>
            </div>
                <input type="hidden" name="question_id" value="{{$question['id']}}">
            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                <input type="submit" class="btn btn-success" value="Next Question">
            </div>
        </form>
            @endif
        </form>
    </div>
</div>
@endsection
@section('questions')

@foreach ($questions as $key => $value)

<form method="post" action="{{route('student.exam',['id'=>$exam->id,'question_number'=>$key+1])}}">
@csrf
<div  class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth1" aria-expanded="false" aria-controls="pagesCollapseAuth1">
<button style="border: none; background: none; cursor: pointer; margin: 0; padding: 0;">
    {{$value['title']}}
</button>
    <div class="sb-sidenav-collapse-arrow">{{$key+1}}</div>
</div>
</form>

@if($loop->last)
<form method="post" action="{{route('student.exam.end',['id'=>$exam->id])}}">
@csrf
<div  class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth1" aria-expanded="false" aria-controls="pagesCollapseAuth1">
    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
        <input type="submit" name="end" class="btn btn-danger" value="End Exam">
    </div>
</div>
</form>
@endif
@endforeach
@endsection
