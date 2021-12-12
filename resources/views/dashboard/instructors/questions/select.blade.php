@extends('layouts.dashboard.instructor')
@section('pageName')
Select question
@endsection
@section('content')
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
        <th scope="col">answers</th>
        <th scope="col">correct answer</th>
        <th scope="col">author</th>
        <th scope="col">default_score</th>
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
        @if($result->question_type_id == 2)
        <td>@foreach($result->answers as $answer)
        ({{$loop->index + 1}}){{$answer}}--
        @endforeach</td>
        <td>{{$result->correct_answer}}</td>
        @else
        <td></td>
        <td></td>
        @endif
        <td>{{$result->instructor->name}}</td>
        <td>{{$result->default_score}}</td>
        <td>
            <div class="input-group mb-3">
                <input type="number" id="inputScore" name="score{{$result->id}}"class="form-control" aria-label="Text input with checkbox">
                <label for="inputScore"></label>
                <div class="input-group-text">
                   <input class="form-check-input mt-0" type="checkbox" name="select[]" value="{{$result->id}}" aria-label="Checkbox for following text input">
                </div>
          </div>
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
