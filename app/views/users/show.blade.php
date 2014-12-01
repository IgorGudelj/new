@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
{{trans('pages.profile')}}
@stop

{{-- Content --}}
@section('content')
	<h4>{{trans('pages.profile')}}</h4>
	
  	<div class="well clearfix">
	    <div class="col-md-8">
		    @if ($user->first_name)
		    	<p><strong>{{trans('users.fname')}}:</strong> {{ $user->first_name }} </p>
			@endif
			@if ($user->last_name)
		    	<p><strong>{{trans('users.lname')}}:</strong> {{ $user->last_name }} </p>
			@endif
		    <p><strong>{{trans('users.email')}}:</strong> {{ $user->email }}</p>
		    @if ($user->address)
                <p><strong>{{trans('users.address')}}:</strong> {{ $user->address }} </p>
            @endif
		    @if ($user->phone)
                <p><strong>{{trans('users.phone')}}:</strong> {{ $user->phone }} </p>
            @endif
            {{--@if ($user->getPlaceName())--}}
                {{--<p><strong>{{trans('users.city')}}:</strong> {{ $user->getPlaceName() }} </p>--}}
            {{--@endif--}}
            @if ($user->oib)
                <p><strong>{{trans('users.oib')}}:</strong> {{ $user->oib }} </p>
            @endif
		    
		</div>
		<div class="col-md-4">
			<p><em>{{trans('pages.profile')}} {{trans('pages.created')}}: {{ $user->created_at }}</em></p>
			<p><em>{{trans('pages.modified')}}: {{ $user->updated_at }}</em></p>
			<button class="btn btn-primary" onClick="location.href='{{ action('UserController@edit', array($user->id)) }}'">{{trans('pages.actionedit')}}</button>
		</div>
	</div>

@stop
