<div class="container">

    <form method="{{$method or 'POST'}}" action="{{$action}}" class="form-control" style="
                                                                                background-color:
                                                                                    rgba(255,255,255,.8);">
            <h5 class="text-danger">{{$status or ''}}</h5>
            <input type="hidden" name="_token" value="@php echo csrf_token() @endphp">
            {{$slot}}
    </form>

</div>