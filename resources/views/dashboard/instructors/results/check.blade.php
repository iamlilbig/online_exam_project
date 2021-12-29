@extends('layouts.dashboard.instructor')
@section('pageName')
    Checking Result
@endsection
@section('content')

    @if(isset($student))
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">phone</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">{{$student->id}}</th>
                        <td>{{$student->name}}</td>
                        <td>{{$student->email}}</td>
                        <td>{{$student->phone}}</td>
                    </tr>
                </tbody>
            </table>
    @endif

<hr>


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
            <form method="post" action="{{route('instructors.results.unsent.checking',['result'=>$results->first()->result])}}">
                @csrf
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">number</th>
                    <th scope="col">title</th>
                    <th scope="col">content</th>
                    <th scope="col">answer</th>
                    <th scope="col">score</th>
                </tr>
                </thead>
                <tbody>
                @foreach($results as $result)
                    <tr>@if($result->question == null)
                            @continue
                        @endif
                        <th scope="row">{{$loop->iteration}}</th>
                        <th>{{$result->question->title}}</th>
                        <td>{{$result->question->content}}</td>
                        <td class="col-sm-4">{{$result->answer}}</td>
                        <td class="w-25">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Of {{$result->question->tests()->first()->pivot->default_score}}</span>
                                <input type="number" name="score[]" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                <input type="hidden" name="default_score[]" value="{{$result->question->tests()->first()->pivot->default_score}}">
                                <input type="hidden" name="answer_id[]" value="{{$result->id}}">
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-grid gap-2">
                <input type="submit" value="Check!" class="btn btn-success btn-lg">
            </div>
            </form>
        @else
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5 bg-dark text-white">
                            <div class="bg-dark card-header">
                                <h3 class="text-center font-weight-light my-4">
                                    no questions exist!
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
@endsection
