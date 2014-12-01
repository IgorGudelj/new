@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Edit Profile
@stop

{{-- Content --}}
@section('content')

<h4>{{trans('pages.actionedit')}} 
@if ($user->email == Sentry::getUser()->email)
	{{trans('users.yours')}}
@else 
	{{ $user->email }} 
@endif 
{{trans('pages.profile')}}</h4>
<div class="well">
	{{ Form::model($user, array(
        'action' => array('UserController@update', $user->id), 
        'method' => 'put',
        'class' => 'form-horizontal', 
        'role' => 'form'
        )) }}
        
        <div class="form-group {{ ($errors->has('firstName')) ? 'has-error' : '' }}" for="firstName">
            {{ Form::label('edit_firstName', trans('users.fname'), array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('firstName', $user->first_name, array('class' => 'form-control', 'placeholder' => trans('users.fname'), 'id' => 'edit_firstName'))}}
            </div>
            {{ ($errors->has('firstName') ? $errors->first('firstName') : '') }}    			
    	</div>

        <div class="form-group {{ ($errors->has('lastName')) ? 'has-error' : '' }}" for="lastName">
            {{ Form::label('edit_lastName', trans('users.lname'), array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('lastName', $user->last_name, array('class' => 'form-control', 'placeholder' => trans('users.lname'), 'id' => 'edit_lastName'))}}
            </div>
            {{ ($errors->has('lastName') ? $errors->first('lastName') : '') }}                
        </div>
        
        <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}" for="email">
            {{ Form::label('edit_email', trans('users.email'), array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::email('email', $user->email, array('class' => 'form-control', 'placeholder' => trans('users.email'), 'id' => 'edit_email'))}}
            </div>
            {{ ($errors->has('email') ? $errors->first('email') : '') }}                
        </div>
        
        <div class="form-group {{ ($errors->has('address')) ? 'has-error' : '' }}" for="address">
            {{ Form::label('edit_address', trans('users.address'), array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('address', $user->address, array('class' => 'form-control', 'placeholder' => trans('users.address'), 'id' => 'edit_address'))}}
            </div>
            {{ ($errors->has('address') ? $errors->first('address') : '') }}                
        </div>
        
        <div class="form-group {{ ($errors->has('phone')) ? 'has-error' : '' }}" for="phone">
            {{ Form::label('edit_phone', trans('users.phone'), array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('phone', $user->phone, array('class' => 'form-control', 'placeholder' => trans('users.phone'), 'id' => 'edit_phone'))}}
            </div>
            {{ ($errors->has('phone') ? $errors->first('phone') : '') }}                
        </div>
        
        <div class="form-group {{ ($errors->has('place_id')) ? 'has-error' : '' }}" for="place_id">
            {{ Form::label('edit_place_id', trans('users.place'), array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::select('place_id', [null => trans('users.placeSelect')] + $places) }}
            </div>
            {{ ($errors->has('place_id') ? $errors->first('place_id') : '') }}
        </div>
        
        <div class="form-group {{ ($errors->has('oib')) ? 'has-error' : '' }}" for="oib">
            {{ Form::label('edit_oib', trans('users.oib'), array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('oib', $user->oib, array('class' => 'form-control', 'oibholder' => trans('users.oib'), 'id' => 'edit_oib'))}}
            </div>
            {{ ($errors->has('oib') ? $errors->first('oib') : '') }}                
        </div>

        @if (Sentry::getUser()->hasAccess('admin'))
        <div class="form-group">
            {{ Form::label('edit_memberships', trans('users.group_membership'), array('class' => 'col-sm-2 control-label'))}}
            <div class="col-sm-10">
                @foreach ($allGroups as $group)
                    <label class="checkbox-inline">
                        <input type="checkbox" name="groups[{{ $group->id }}]" value='1' 
                        {{ (in_array($group->name, $userGroups) ? 'checked="checked"' : '') }} > {{ $group->name }}
                    </label>
                @endforeach
            </div>
        </div>
        @endif

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{ Form::hidden('id', $user->id) }}
                {{ Form::submit(trans('pages.actionedit'), array('class' => 'btn btn-primary'))}}
            </div>
      </div>
    {{ Form::close()}}
</div>

<h4>{{trans('users.change_password')}}</h4>
<div class="well">
    {{ Form::open(array(
        'action' => array('UserController@change', $user->id), 
        'class' => 'form-inline', 
        'role' => 'form'
        )) }}
        
        <div class="form-group {{ $errors->has('oldPassword') ? 'has-error' : '' }}">
        	{{ Form::label('oldPassword', trans('users.oldpassword_lbl'), array('class' => 'sr-only')) }}
			{{ Form::password('oldPassword', array('class' => 'form-control', 'placeholder' => trans('users.oldpassword_lbl'))) }}
    	</div>

        <div class="form-group {{ $errors->has('newPassword') ? 'has-error' : '' }}">
        	{{ Form::label('newPassword', trans('users.newpassword'), array('class' => 'sr-only')) }}
            {{ Form::password('newPassword', array('class' => 'form-control', 'placeholder' => trans('users.newpassword'))) }}
    	</div>

    	<div class="form-group {{ $errors->has('newPassword_confirmation') ? 'has-error' : '' }}">
        	{{ Form::label('newPassword_confirmation', trans('users.newcompassword_lbl'), array('class' => 'sr-only')) }}
            {{ Form::password('newPassword_confirmation', array('class' => 'form-control', 'placeholder' => trans('users.newcompassword_lbl'))) }}
    	</div>

        {{ Form::submit(trans('users.change_password'), array('class' => 'btn btn-primary'))}}
	        	
      {{ ($errors->has('oldPassword') ? '<br />' . $errors->first('oldPassword') : '') }}
      {{ ($errors->has('newPassword') ?  '<br />' . $errors->first('newPassword') : '') }}
      {{ ($errors->has('newPassword_confirmation') ? '<br />' . $errors->first('newPassword_confirmation') : '') }}

      {{ Form::close() }}
  </div>

@stop