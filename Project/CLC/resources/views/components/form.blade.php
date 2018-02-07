<div class="container">
        <form method="{{$method}}" action="{{$action}}" class="form-control">

        {{$status or ''}}
        <input type="hidden" name="_token" value="@php echo csrf_token() @endphp">
        {{$slot}}

    </form>
</div>