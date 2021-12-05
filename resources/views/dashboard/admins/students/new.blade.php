@extends('layouts.dashboard.admin')
@section('pageName')
New students
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
@if(isset($students))
    @foreach($students as $student)
    <form method="post" action="{{route('admin.new.students.confirm',$student->id)}}">
    @method('patch')
    @csrf
    <tr>
        <th scope="row">{{$student->id}}</th>
        <td>{{$student->name}}</td>
        <td>{{$student->email}}</td>
        <td>{{$student->phone}}</td>
        <td><input type="submit" value="accept" name="confirmation" class="btn btn-success"></td>
        <td><input type="submit" value="reject" name="confirmation" class="btn btn-danger"></td>
    </tr>
    </form>
    @endforeach
@endif
</tbody>
</table>
@endsection
