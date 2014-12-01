<!-- start LANGUAGE -->
<ul class="language" style="float: right; display: inline-block; list-style-type: none">

    @foreach($languages['current'] as $language => $imgUrl)
    <li class="active" style="display: inline-block"><a href="{{ URL::route('setLanguage', $language) }}"><img src="{{ URL::to("$imgUrl") }}" width="22" height="14" alt="{{ $language }}"></a></li>
    @endforeach
    <?php unset($languages['current']); ?>

    @foreach($languages as $language => $imgUrl)
    <li style="display: inline-block"><a href="{{ URL::route('setLanguage', $language) }}"><img src="{{ URL::to("$imgUrl") }}" width="22" height="14" alt="{{ $language }}"></a></li>
    @endforeach

</ul>
<!-- end LANGUAGE -->