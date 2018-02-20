<a title="{{$title or "action"}}" class="nav-item" style="background: {{$color or "rgba(255,255,255,.0)"}}" href="{{$route}}"
   @if(strpos($class, "remove"))
   onclick="return confirm('Are you sure you want to remove this?');" @endif
>
    <span style="font-size: 24px" class="fa {{$class or ""}}"></span>
</a>