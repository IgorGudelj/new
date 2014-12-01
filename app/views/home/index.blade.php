@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
{{trans('pages.helloworld')}}
@stop

{{-- Content --}}
@section('content')

<div id="map_wrapper">
    <div id="map_canvas" class="mapping"></div>
</div>

<div class="container">
  <!-- Example row of columns -->
  <div class="row homepage">
    @foreach ($listings as $listing)
    <div class="col-md-4">
      <h2><a href="{{ action('ListingsController@show', $listing->id) }}">{{ $listing->title }}</a></h2>
      <p>{{ str_limit($listing->description, 300) }}</p>
      <p><a class="btn btn-default" href="{{ action('ListingsController@show', $listing->id) }}" role="button">{{ trans('pages.details') }} &raquo;</a></p>
    </div>
    @endforeach
  </div>
</div> <!-- /container -->

{{ $listings->links() }}

@stop

@section('map.js')
<script>
    jQuery(function ($) {
        // Asynchronously Load the map API
        var script = document.createElement('script');
        script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
        document.body.appendChild(script);
    });
    function initialize() {
        var map;
        var bounds = new google.maps.LatLngBounds();
        var mapOptions = {
            mapTypeId: 'roadmap'
        };
        // Display a map on the page
        map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
        map.setTilt(45);
        // Multiple Markers
        var markers = [
            @foreach ($listings as $listing)
        ["{{ $listing->address }}", {{ $listing->geo_x }}, {{ $listing->geo_y }}],
    @endforeach
    ];
    // Info Window Content
    var infoWindowContent = [
    @foreach ($listings as $listing)
    ['<div class="info_content">' +
        '<h3>{{ link_to("listings/$listing->id", $listing->title) }}</h3>' +
        "<p>{{ $listing->address }}, " + '{{ $listing->place->name }}<br>{{$listing->user->phone}}</p>' +
    '</div>'],
    @endforeach
    ];
    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    // Loop through our array of markers & place each one on the map
    for (i = 0; i < markers.length; i++) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0]
        });
        // Allow each marker to have an info window
        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));
        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
    }
    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function (event) {
        this.setZoom(10);
        google.maps.event.removeListener(boundsListener);
    });
    }
</script>
@stop