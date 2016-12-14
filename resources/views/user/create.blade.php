@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="col-md-8 col-md-offset-2">
                    <h1> Create User </h1>
                    {!! Form::open(array('url' => '/profile/add', 'files'=>true, 'method' => 'POST')) !!}
                        {{Form::label('id', 'ID')}}
                        {{Form::text('id', null , array('class' => 'form-control'))}}
                        <br>
                        {{Form::label('name', 'Name')}}
                        {{Form::text('name', null , array('class' => 'form-control'))}}
                        <br>
                        {{Form::label('email', 'Email')}}
                        {{Form::text('email', null , array('class' => 'form-control'))}}
                        <br>
                        {{Form::label('age', 'Age')}}
                        {{Form::text('age', null , array('class' => 'form-control'))}}
                        <br>
                        {{Form::label('profileImage', 'Profile Image')}}
                        {{Form::file('profileImage')}}
                        {{Form::submit('Sign Up!', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top:10px'))}}
                    {!! Form::close() !!}
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
