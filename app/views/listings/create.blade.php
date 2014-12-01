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
        {{ Form::open(array('action' => 'ListingsController@store', 'files' => true)) }}

            <h2>{{trans('listings.register')}}</h2>

            <div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}">
                {{ Form::label('title', trans('listings.title'), array('class' => 'col-sm-4 control-label')) }}
                {{ Form::text('title', null, array('class' => 'form-control')) }}
                {{ ($errors->has('title') ? $errors->first('title') : '') }}
            </div>
            
            <div class="form-group {{ ($errors->has('description')) ? 'has-error' : '' }}">
                {{ Form::label('description', trans('listings.description'), array('class' => 'col-sm-4 control-label')) }}
                {{ Form::textarea('description', null, array('class' => 'form-control')) }}
                {{ ($errors->has('description') ? $errors->first('description') : '') }}
            </div>

            <div class="form-group {{ ($errors->has('website')) ? 'has-error' : '' }}">
                {{ Form::label('website', trans('listings.website'), array('class' => 'col-sm-4 control-label')) }}
                {{ Form::text('website', null, array('class' => 'form-control')) }}
                {{ ($errors->has('website') ? $errors->first('website') : '') }}
            </div>

            <div class="form-group {{ ($errors->has('address')) ? 'has-error' : '' }}">
                {{ Form::label('address', trans('listings.address'), array('class' => 'col-sm-4 control-label')) }}
                {{ Form::text('address', null, array('class' => 'form-control', 'onchange'=>'codeAddress()')) }}
                {{ ($errors->has('address') ? $errors->first('address') : '') }}
            </div>

            <div class="form-group {{ ($errors->has('place_id')) ? 'has-error' : '' }}" for="place_id">
                {{ Form::label('edit_place_id', trans('users.place'), array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-10">
                  {{ Form::select('place_id', [null => trans('users.placeSelect')] + $places, null, array('id' => 'place_id', 'onchange'=>'codeAddress()'))}}
                </div>
                {{ ($errors->has('place_id') ? $errors->first('place_id') : '') }}
            </div>

            <div class="form-group hidden {{ ($errors->has('geo_x')) ? 'has-error' : '' }}">
                {{ Form::label('geo_x', trans('listings.geo_x'), array('class' => 'col-sm-4 control-label')) }}
                {{ Form::text('geo_x', null, array('class' => 'form-control')) }}
                {{ ($errors->has('geo_x') ? $errors->first('geo_x') : '') }}
            </div>

            <div class="form-group hidden {{ ($errors->has('geo_y')) ? 'has-error' : '' }}">
                {{ Form::label('geo_y', trans('listings.geo_y'), array('class' => 'col-sm-4 control-label')) }}
                {{ Form::text('geo_y', null, array('class' => 'form-control')) }}
                {{ ($errors->has('geo_y') ? $errors->first('geo_y') : '') }}
            </div>

            <div class="form-group images {{ ($errors->has('images')) ? 'has-error' : '' }}">
                {{ Form::label('images', trans('listings.images'), array('class' => 'col-sm-4 control-label')) }}
                {{ Form::file('images[]', array('multiple'=>true)) }}
                {{ ($errors->has('images') ? $errors->first('images') : '') }}
            </div>
            
            {{ Form::submit(trans('listings.register'), array('class' => 'btn btn-primary')) }}
            
        {{ Form::close() }}
    </div>
</div>

<script>
    function codeAddress() {
        var placeSelect = document.getElementById("place_id");
        var placeText = placeSelect.options[placeSelect.selectedIndex].text;
        var address = document.getElementById("address").value + ", " + placeText;
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode( { 'address': address}, function(results, status) {
            var location = results[0].geometry.location;
            document.getElementById("geo_x").value = location.lat();
            document.getElementById("geo_y").value = location.lng();
        });
    }
    google.maps.event.addDomListener(window, 'load', codeAddress);
</script>

@stop