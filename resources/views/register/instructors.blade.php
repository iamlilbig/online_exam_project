@extends('layouts.app')
@section('pageName')
Instructors signin page
@endsection
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
    <form action="{{route('register.instructors.store')}}" class="was_validate" method="post">
    @csrf
        <div class="form-floating mb-3">
            <input class="form-control" id="inputName" name="name" type="text" placeholder="Enter Your Name" />
            <label for="inputName">Your Name</label>
        </div>

        <div class="form-floating mb-3">
            <input class="form-control" id="inputEmail" name="email" type="email" placeholder="name@example.com" />
            <label for="inputEmail">Email address</label>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" id="inputPhone" name="phone" type="text" placeholder="phone number" />
            <label for="inputPhone">phone number</label>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password" />
            <label for="inputPassword">Password</label>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" id="inputConfirmPassword" name="password_confirmation" type="password" placeholder="Confirm password" />
            <label for="inputConfirmPassword">Confirm password</label>
        </div>
        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
            <input type="submit" class="btn btn-success" value="Submit">
    </form>
    <a href="{{route('login.instructors') }}" class="btn btn-link-secondary">you have an account?</a>
    <div class="btn-group">
        <a href="{{ route('register.students') }}" class="btn btn-outline-primary">students</a>
        <a href="{{ route('register.instructors') }}" class="btn btn-primary active" aria-current="page">instructors</a>
    </div>
</div>
@endsection
@section('pageName')
instructors register page
@endsection
