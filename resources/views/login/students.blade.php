@extends('layouts.app')
@section('content')
<div class="form-floating mb-3">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    <form action="{{route('login.students.login')}}" method="post">
    @csrf
        <div class="form-floating mb-3">
            <input class="form-control" id="inputEmail" name="email" type="email" placeholder="name@example.com" />
            <label for="inputEmail">Email address</label>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password" />
            <label for="inputPassword">Password</label>
        </div>

        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
            <input type="submit" class="btn btn-success" value="Login">

    </form>
        <a href="{{ route('register.students') }}" class="link-secondary">not have an account yet?</a>
    <div class="btn-group">
        <a href="{{ route('login.students') }}" class="btn btn-primary active" aria-current="page">students</a>
        <a href="{{ route('login.instructors') }}" class="btn btn-outline-primary">instructors</a>

    </div>
</div>
@endsection

@section('pageName')
students Login page
@endsection
