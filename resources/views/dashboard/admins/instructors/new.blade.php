@extends('layouts.dashboard.admin')
@section('pageName')
New instructors
@endsection
@section('content')
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">email</th>
        <th scope="col">phone</th>
        <th scope="col">accept</th>
        <th scope="col">reject</th>
    </tr>
</thead>
<tbody>
@if(isset($instructors))
    @foreach($instructors as $instructor)
    <form method="post" action="{{route('admin.new.instructors.confirm',$instructor->id)}}">
    @method('patch')
    @csrf
    <tr>
        <th scope="row">{{$instructor->id}}</th>
        <td>{{$instructor->name}}</td>
        <td>{{$instructor->email}}</td>
        <td>{{$instructor->phone}}</td>
        <td><input type="submit" value="accept" name="confirmation" class="btn btn-success"></td>
        <td><input type="submit" value="reject" name="confirmation" class="btn btn-danger"></td>
    </tr>
    </form>
    @endforeach
@endif
</tbody>
</table>
@endsection
