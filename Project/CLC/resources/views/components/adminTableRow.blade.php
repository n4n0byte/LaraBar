<tr>
    <td>{{$id}}</td>
    <td>{{$email}}</td>
    <td>
        @if($isAdmin)
        <p>[ADMIN]</p>
        @elseif($isSuspended)
        <a href="/admin/reactivate/{{$id}}">Reactivate User</a>
        @else
            <a href="/admin/suspend/{{$id}}">Suspend User</a>
        @endif
    </td>

</tr>