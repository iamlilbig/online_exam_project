@extends('layouts.dashboard.instructor')
@section('pageName')
    Sent Result
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
                    <th scope="col">name</th>
                    <th scope="col">start</th>
                    <th scope="col">end</th>
                    <th scope="col">show</th>
                </tr>
                </thead>
                <tbody>
                @foreach($results as $result)
                    <form method="get" action="{{route('instructors.results.sent.checked',['result'=>$result->id])}}">
                        <tr>
                            <th scope="row">{{$result->student->id}}</th>
                            <td>{{$result->student->name}}</td>
                            <td>{{$result->created_at}}</td>
                            <td>{{$result->ended_at}}</td>
                            <td><input type="submit" value="show result" class="btn btn-primary"></td>
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
