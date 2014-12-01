@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
{{trans('pages.register')}}
@stop

{{-- Content --}}
@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        {{ Form::open(array('action' => 'UserController@store')) }}

            <h2>{{trans('pages.register')}}</h2>

            <div class="form-group {{ ($errors->has('firstName')) ? 'has-error' : '' }}">
                {{ Form::text('firstName', null, array('class' => 'form-control', 'placeholder' => trans('users.fname'))) }}
                {{ ($errors->has('firstName') ? $errors->first('firstName') : '') }}
            </div>

            <div class="form-group {{ ($errors->has('lastName')) ? 'has-error' : '' }}">
                {{ Form::text('lastName', null, array('class' => 'form-control', 'placeholder' => trans('users.lname'))) }}
                {{ ($errors->has('lastName') ? $errors->first('lastName') : '') }}
            </div>

            <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                {{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => trans('users.email'))) }}
                {{ ($errors->has('email') ? $errors->first('email') : '') }}
            </div>

            <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
                {{ Form::password('password', array('class' => 'form-control', 'placeholder' => trans('users.pword'))) }}
                {{ ($errors->has('password') ?  $errors->first('password') : '') }}
            </div>

            <div class="form-group {{ ($errors->has('password_confirmation')) ? 'has-error' : '' }}">
                {{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => trans('users.pwordConfirm'))) }}
                {{ ($errors->has('password_confirmation') ?  $errors->first('password_confirmation') : '') }}
            </div>
            
            {{ Form::submit(trans('users.register'), array('class' => 'btn btn-primary')) }}
            
        {{ Form::close() }}
    </div>
</div>


@stop