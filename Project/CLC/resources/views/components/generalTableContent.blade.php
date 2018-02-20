<tr>
    @foreach($row as $data)
        <td>{{$data}}</td>
    @endforeach
    @if(isset($btns))
        <td>
            <nav>
                <div class="nav nav-justified">
                    {{$btns}}
                </div>
            </nav>
        </td>
    @endif
</tr>
