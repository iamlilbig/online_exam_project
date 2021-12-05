@extends('layouts.dashboard.admin')
@section('pageName')
Search students
@endsection
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">@yield('pageName')</h3></div>
                    <div class="card-body">
                        <select class="form-select" aria-label="Default select example">
                          <option selected>Select one search method</option>
                          <option value="id">id</option>
                          <option value="name">name</option>
                          <option value="email">email</option>
                          <option value="phone">phone</option>
                        </select>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
