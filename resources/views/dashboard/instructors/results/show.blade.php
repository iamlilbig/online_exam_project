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
                    <th scope="col">Name</th>
                    <th scope="col">Start</th>
                    <th scope="col">End</th>
                    <th scope="col">is checked</th>
                    <th scope="col">Check</th>
                </tr>
                </thead>
                <tbody>
                @foreach($results as $result)
                    <form method="get" action="{{route('instructors.results.unsent.check',['result'=>$result->id])}}">
                        <tr>
                            <th scope="row">{{$result->student->id}}</th>
                            <td>{{$result->student->name}}</td>
                            <td>{{$result->created_at}}</td>
                            <td>{{$result->ended_at}}</td><td>
                            @if($result->is_checked  == 1)
                                <div class="btn btn-success">Checked</div>
                            @else
                                <div class="btn btn-danger">Not Check</div>
                            @endif
                            </td><td><input type="submit" value="Check" class="btn btn-primary"></td>
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
                                    no student exist!
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif


@endsection
