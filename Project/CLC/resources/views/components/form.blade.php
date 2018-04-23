<form method="{{$method or 'POST'}}" action="/CLC/{{$action}}" class="form-control"
      style="background-color:rgba(255,255,255,.8);">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h5 class="text-danger">{{$status or ''}}</h5>
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    {{$slot}}
</form>

