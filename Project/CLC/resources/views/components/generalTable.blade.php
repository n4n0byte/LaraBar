<table class="table table-bordered table-hover" style="background-color: rgba(255,255,255,.8);">
    <thead>
        <tr>
            @foreach($names as $name)
                <td>{{$name}}</td>
            @endforeach
        </tr>
    </thead>
    <tbody>
        {{$slot}}
    </tbody>
</table>