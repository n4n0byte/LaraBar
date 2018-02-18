@foreach($list as $item)
    <tr>
        @foreach($item as $column)
            <td>{{$column}}</td>
        @endforeach
    </tr>
@endforeach
