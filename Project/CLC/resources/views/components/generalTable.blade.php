<table id="{{$id or ""}}" class="table table-bordered table-hover" style="background-color: rgba(255,255,255,.8);">
    <thead>
        <tr>
            @foreach($names as $name)
                <th>{{$name}}</th>
            @endforeach
            @if(isset($links))
                <th>icons</th>
            @endif
        </tr>
    </thead>
    <tbody>
        {{$slot}}
    </tbody>
</table>