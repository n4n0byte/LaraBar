@foreach($list as $row)
    <tr>
        @foreach($row as $data)
            <td>{{$data}}</td>
        @endforeach
    </tr>
@endforeach
