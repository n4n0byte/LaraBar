<tr>
    <td>{{$id}}</td>
    <td>{{$email}}</td>
    <td>
        @if($isAdmin)
            <p>[ADMIN]</p>
        @elseif($isSuspended)
            <a href="/CLC/admin/reactivate/{{$id}}">Reactivate User</a>
        @else
            <a href="/CLC/admin/suspend/{{$id}}">Suspend User</a>
        @endif
    </td>
    <td>
        @if($isAdmin)
            <p> --- </p>
        @else
            <a href="/CLC/admin/delete/{{$id}}">DELETE</a>
        @endif
    </td>
</tr>