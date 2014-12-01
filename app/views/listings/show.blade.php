@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
{{trans('pages.register')}}
@stop

{{-- Content --}}
@section('content')

<div class="container">

    <h3 style="margin-bottom: 30px">{{ $listing->title }}</h3>

    <div class="col-md-7">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <div class="item active">
              <img src="{{ $images[2]->filename }}">
            </div>
            @foreach($images as $image)
            <div class="item">
              <img src="{{ $image->filename }}">
            </div>
            @endforeach
          </div>

          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
    </div>

    <div class="col-md-5" style="float: right">
        <ul class="list-group">
          @if($listing->isCurrent())
          <li class="list-group-item">
              <button class="btn btn-default" type="button" onClick="location.href='{{ action('ListingsController@edit', array($user->id)) }}'">{{trans('pages.actionedit')}}</button>
              <button class="btn btn-default action_confirm" href="{{ action('ListingsController@destroy', array($user->id)) }}" data-token="{{ Session::getToken() }}" data-method="delete">{{trans('pages.actiondelete')}}</button>
          </li>
          @endif
          <li class="list-group-item">Address: {{ $listing->address }}, {{ $listing->place->getName() }}</li>
          <li class="list-group-item">Website: <a href="{{ $listing->website }}">{{ $listing->website }}</a></li>
          <li class="list-group-item">Phone: {{ $listing->user->phone }}</li>
          <li class="list-group-item">Email: <a href="mailto:{{ $listing->user->email }}">{{ $listing->user->email }}</a></li>
        </ul>
        <div id="map" style="height: 250px"></div>
    </div>

    <div class="clearfix"></div>

    <div class="panel panel-info col-md-7" style="margin-top: 30px">
      <div class="panel-heading">
        <h3 class="panel-title">{{ trans('listings.description') }}</h3>
      </div>
      <div class="panel-body">
        {{ $listing->description }}
      </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script>
function initialize() {
  var myLatlng = new google.maps.LatLng({{ $listing->geo_x }},{{ $listing->geo_y }});
  var mapOptions = {
    zoom: 10,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('map'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Hello World!'
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>

@stop