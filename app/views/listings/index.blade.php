@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
{{trans('pages.users')}}
@stop

{{-- Content --}}
@section('content')
<h4>{{trans('listings.current')}}:</h4>
<div class="row">
  <div class="col-md-10 col-md-offset-1">
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<th>{{trans('listings.listing')}}</th>
				<th>{{trans('pages.user')}}</th>
				<th>{{trans('pages.options')}}</th>
			</thead>
			<tbody>
				@foreach ($listings as $listing)
					<tr>
						<td><a href="{{ action('ListingsController@show', array($listing->id)) }}">{{ $listing->title }}</a></td>
						<td><a href="{{ action('UserController@show', array($listing->user->id)) }}">{{ $listing->user->fullname }}</a></td>

						<td>
							<button class="btn btn-default" type="button" onClick="location.href='{{ action('ListingsController@edit', array($listing->id)) }}'">{{trans('pages.actionedit')}}</button>
							<button class="btn btn-default action_confirm" href="{{ action('ListingsController@destroy', array($listing->id)) }}" data-token="{{ Session::getToken() }}" data-method="delete">{{trans('pages.actiondelete')}}</button></td>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
  </div>
</div>
@stop
