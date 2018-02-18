<table class="table table-bordered table-hover" style="background-color: rgba(255,255,255,.8);">
    <tr>
        @foreach($table as $column)
            <th>{{$column}}</th>
        @endforeach
    </tr>
    {{$slot}}
</table>