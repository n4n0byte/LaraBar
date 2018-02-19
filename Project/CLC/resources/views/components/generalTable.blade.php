<table id="{{$id or ""}}" class="table table-bordered table-hover" style="background-color: rgba(255,255,255,.8);">
    <thead>
        <tr>
            @foreach($names as $name)
                <td>{{$name}}</td>
            @endforeach
            @if(isset($links))
                <td>icons</td>
            @endif
        </tr>
    </thead>
    <tbody>
        {{$slot}}
    </tbody>
</table>