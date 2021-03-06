@extends('layouts.dashboard.admin')
@section('pageName')
update students
@endsection
@section('content')

<div class="card shadow-lg border-0 rounded-lg mt-5">
    <div class="card-header"><h3 class="text-center font-weight-light my-4">@yield('pageName')</h3></div>
    <div class="card-body">
        <form action="{{route('admin.edit.students.update')}}" method="post">
        @method('put')
        @csrf
        <input name="id" value="{{$user->id}}" type="hidden"/>
            <div class="form-floating mb-3">
                <input class="form-control" id="inputName" name="name" value="{{$user->name}}" type="text" placeholder="Enter Your Name" />
                <label for="inputName">Your Name</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="inputEmail" name="email" value="{{$user->email}}" type="email" placeholder="name@example.com" />
                <label for="inputEmail">Email address</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="inputPhone" name="phone" value="{{$user->phone}}" type="text" placeholder="phone number" />
                <label for="inputPhone">phone number</label>
            </div>
            @if($user->is_active == '1')
                <div class="form-floating mb-3">
                    <div class="form-check">
                      <input class="form-check-input" value="1" type="radio" name="is_active" id="flexRadioDefault1" checked>
                      <label class="form-check-label" for="flexRadioDefault1">
                        active
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" value="0" type="radio" name="is_active" id="flexRadioDefault2">
                      <label class="form-check-label" for="flexRadioDefault2">
                        inactive
                      </label>
                    </div>
                </div>
            @else
                <div class="form-floating mb-3">
                    <div class="form-check">
                      <input class="form-check-input" value="1" type="radio" name="is_active" id="flexRadioDefault1">
                      <label class="form-check-label" for="flexRadioDefault1">
                        active
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" value="0" type="radio" name="is_active" id="flexRadioDefault2" checked>
                      <label class="form-check-label" for="flexRadioDefault2">
                        inactive
                      </label>
                    </div>
                </div>
            @endif
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
            </div>
        </form>
    </div>
</div>
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
@endsection
