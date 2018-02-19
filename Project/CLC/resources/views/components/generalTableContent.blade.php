<tr>
    @foreach($row as $data)
        <td>{{$data}}</td>
    @endforeach
    @if(isset($btns))
        <td>{{$btns}}</td>
    @endif
</tr>
