<div class="container">
        <form method="{{$method}}" action="{{$action}}" class="form-control" style="
                                                                                background-color:
                                                                                    rgba(255,255,255,.8);">

        {{$status or ''}}
        <input type="hidden" name="_token" value="@php echo csrf_token() @endphp">
        {{$slot}}

    </form>
</div>