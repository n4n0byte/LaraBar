<a href="{{$route}}" @if(strpos($class, "remove")) onclick="return confirm('Are you sure?');" @endif>
    <span style="font-size: 24px" class="fa {{$class or ""}}"></span>
</a>
