@extends('layouts.dashboard.instructor')
@section('pageName')
Create Multiple
@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input class="form-control" type="text" name="answers[]" value=""/><a href="javascript:void(0);" class="remove_button btn btn-danger">REMOVE FIELD</a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>

@endsection
@section('content')

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-2 bg-dark text-white">
                <div class="btn-group m-3" role="group" aria-label="Basic example">
                    <a href="{{route('instructors.questions.create.multipleChoice')}}" class="btn btn-info">create Multiple Choice</a>
                    <a href="{{route('instructors.questions.create.descriptive')}}" class="btn btn-outline-info">create Descriptive</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-lg border-0 rounded-lg mt-5">
    <div class="card-header"><h3 class="text-center font-weight-light my-4">@yield('pageName')</h3></div>
    <div class="card-body">
        <form action="{{route('instructors.questions.store.multipleChoice')}}" method="post">
        @csrf
            <div class="form-floating mb-3">
                <input class="form-control" id="inputName" name="title"type="text" placeholder="Enter Your Name" />
                <label for="inputName">Title</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="content" id="inputDescription"></textarea>
                <label for="inputDescription" class="form-label">Content</label>
            </div>
            <div class="field_wrapper form-floating mb-3">
                <input type="text" class="form-control" name="answers[]" id="inputTests" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                <label for="inputTests">New Choose</label>
                <a href="javascript:void(0);" class="add_button" title="Add field"><button class="btn btn-outline-primary" type="button" id="button-addon1">ADD FIELD</button></a>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="inputTime" name="correct_answer" type="number" placeholder="Enter time" />
                <label for="inputTime">correct answer</label>
            </div>
            <div class="form-floating mb-3">
            <select class="form-select" aria-label="Default select example" name="test_id">
            @foreach($exams as $exam)
                @if ($loop->first)
                    <option value="" selected>Select an exam</option>
                @endif
              <option value="{{$exam->id}}">{{$exam->title."------------".$exam->course->title}}</option>
            @endforeach
            </select>
            <label for="test_id">select test</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="inputTime" name="default_score" type="number" placeholder="Enter time" />
                <label for="inputTime">default score</label>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                <input type="submit" class="btn btn-success" value="Submit">
            </div>
        </form>
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

@endsection
