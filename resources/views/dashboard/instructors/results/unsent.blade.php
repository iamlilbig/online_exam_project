@extends('layouts.dashboard.instructor')
@section('pageName')
    unSent Result
@endsection
@section('content')

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


    @if(isset($results))
        @if(count($results) > 0)
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">title</th>
                    <th scope="col">description</th>
                    <th scope="col">course id</th>
                    <th scope="col">count of students</th>
                    <th scope="col">duration</th>
                    <th scope="col">start time</th>
                    <th scope="col">end time</th>
                    <th scope="col">show</th>
                    <th scope="col">send</th>
                </tr>
                </thead>
                <tbody>
                @foreach($results as $result)
                    <form method="post" action="{{route('instructors.results.unsent.send',['test'=>$result->id])}}">
                        @csrf
                        @method('put')
                        <tr>
                            <th scope="row">{{$result->id}}</th>
                            <td>{{$result->title}}</td>
                            <td>{{$result->description}}</td>
                            <td>{{$result->course_id}}</td>
                            <td>{{$result->results_count}}</td>
                            <td>{{$result->duration}}</td>
                            <td>{{$result->datetime}}</td>
                            <td>{{$result->endtime}}</td>
                            <td><a href="{{route('instructors.results.unsent.show',['test'=>$result->id])}}" class="btn btn-primary">Show</a></td>
                            <td><input type="submit" value="Send" class="btn btn-success"></td>
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
                                    no not checked exams!
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif


@endsection

