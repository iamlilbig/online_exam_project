@extends('layouts.dashboard.instructor')
@section('pageName')
Descriptive
@endsection
@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-2 bg-dark text-white">
                <div class="btn-group m-3" role="group" aria-label="Basic example">
                    <a href="{{route('instructors.questions.index.multipleChoice')}}" class="btn btn-outline-info">Multiple Choice Questions</a>
                    <a href="{{route('instructors.questions.index.descriptive')}}" class="btn btn-info">Descriptive Questions</a>
                </div>
            </div>
        </div>
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

@if(isset($results))
    @if(count($results) > 0)
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">title</th>
        <th scope="col">content</th>
        <th scope="col">author</th>
        <th scope="col">delete</th>
    </tr>
</thead>
<tbody>
    @foreach($results as $result)
    <form method="post" action="{{route('instructors.questions.destroy',$result->id)}}">
    @csrf
    @method('delete')
    <tr>
        <th scope="row">{{$result->id}}</th>
        <td>{{$result->title}}</td>
        <td>{{$result->content}}</td>
        <td>{{$result->instructor->name}}</td>
        <input type="hidden" name="question_id" value="{{$result->id}}">
        <td><input type="submit" value="delete" name="confirmation" class="btn btn-danger"></td>
    </tr>
    </form>
    @endforeach
</tbody>
</table>
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
