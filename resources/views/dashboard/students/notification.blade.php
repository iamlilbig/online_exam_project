@extends('layouts.dashboard.student')
@section('pageName')
Students Notifications
@endsection
@section('content')
@if(isset($unreadNotifications))
    @if(count($unreadNotifications) > 0)
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5 bg-dark text-white">
                    <div class="bg-dark card-header">
                        @foreach($unreadNotifications as $notification)
                            <div class="alert alert-info">
                                <ul>
                                    <li>{{$notification->data['massage']}}</li>
                                </ul>

                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a href="{{route('students.notifications.read',['id'=>$notification->id])}}" class="btn btn-success">Mark as read</a>
                                    <a href="{{route('students.notifications.delete',['id'=>$notification->id])}}" class="btn btn-outline-danger">Delete</a>
                                </div>
                            </div>
                        @endforeach
                        <a href="{{route('students.notifications.read',['all'])}}" class="btn btn-success">Mark all as read</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5 bg-dark text-white">
                    <div class="bg-dark card-header">
                        <h3 class="text-center font-weight-light my-4">
                           You dont have any new notifications!
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endif


@if(isset($readNotifications))
    @if(count($readNotifications) > 0)
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5 bg-dark text-white">
                    <div class="bg-dark card-header">
                        @foreach($readNotifications as $notification)
                            <div class="alert alert-secondary">
                                <ul>
                                    <li>{{$notification->data['massage']}}</li>
                                </ul>

                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a href="{{route('students.notifications.delete',['id'=>$notification->id])}}" class="btn btn-outline-danger">Delete</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5 bg-dark text-white">
                    <div class="bg-dark card-header">
                        <h3 class="text-center font-weight-light my-4">
                           You dont have any new notifications!
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endif
@endsection
