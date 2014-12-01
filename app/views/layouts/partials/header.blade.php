<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ URL::route('home') }}">Zavrsni-app</a>
    </div>


    <div id="navbar" class="navbar-collapse collapse">

    @if(!$user)
      {{ Form::open(['route' => 'login', 'class' => 'navbar-form navbar-right' , 'role' => 'form']) }}
        <div class="form-group">
          {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'Email'))}}
        </div>
        <div class="form-group">
          {{ Form::password('password', array('class' => 'form-control', 'placeholder' => trans('pages.password')))}}
        </div>
        <button type="submit" class="btn btn-success">{{trans('users.login')}}</button>
        <a href="{{ URL::route('register') }}"><button type="button" class="btn btn-primary">{{trans('users.register')}}</button></a>
      {{ Form::close() }}
    @endif
    @if($user)
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ $user->first_name . ' ' . $user->last_name }} <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                @if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
                    <li><a href="{{ URL::to('/users') }}">{{trans('pages.users')}}</a></li>
                    <li><a href="{{ URL::to('/groups') }}">{{trans('pages.groups')}}</a></li>
                @endif
                <li><a href="{{ URL::to('/listings') }}">{{trans('listings.listings')}}</a></li>
                <li class="divider"></li>
                <li>{{ link_to_action('ListingsController@showByUserId', trans('listings.myListings'), $parameters = array($user->id), $attributes = array()) }}</li>
                <li><a href="{{ URL::to('/listings/create') }}">{{trans('users.newListing')}}</a></li>
                <li>{{ link_to_action('UserController@edit', trans('users.editProfile'), $parameters = array($user->id), $attributes = array()) }}</li>
                <li class="divider"></li>
                <li><a href="{{ URL::route('logout') }}">{{trans('users.logout')}}</a></li>
              </ul>
            </li>
        </ul>
    @endif
    </div><!--/.navbar-collapse -->

  </div>
</nav>