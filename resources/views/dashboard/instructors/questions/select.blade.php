@extends('layouts.dashboard.instructor')
@section('pageName')
Select question
@endsection
@section('content')

@if(isset($results))
    @if(count($results) > 0)
<form method="post" action="{{route('instructors.exams.questions.add',$exam->id)}}">
@csrf
@method('put')
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">title</th>
        <th scope="col">content</th>
        <th scope="col">question type</th>
        <th scope="col">default_score</th>
        <th scope="col">answers</th>
        <th scope="col">correct answer</th>
        <th scope="col">author</th>
        <th scope="col"><input type="submit" value="Submit Query" class="btn btn-success"/></th>
    </tr>
</thead>
<tbody>
    @foreach($results as $result)
    <tr>
        <th scope="row">{{$result->id}}</th>
        <td>{{$result->title}}</td>
        <td>{{$result->content}}</td>
        <td>{{$result->questionType->question_type}}</td>
        <td>{{$result->default_score}}</td>
        <td>{{$result->answers}}</td>
        <td>{{$result->correct_answer}}</td>
        <td>{{$result->instructor->name}}</td>
        <td>
          <input type="checkbox" class="btn-check" name="select[]" value="{{$result->id}}" id="btn-check-outlined" autocomplete="off">
          <label class="btn btn-outline-primary" for="btn-check-outlined">Add Question</label>
        </td>
    </tr>
    @endforeach
</tbody>
</table>
</form>
    @else
<div class="container mb-3">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5 bg-dark text-white">
                <div class="bg-dark card-header">
                    <h3 class="text-center font-weight-light my-4">
                       No Questions fonded!
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endif
@endsection
