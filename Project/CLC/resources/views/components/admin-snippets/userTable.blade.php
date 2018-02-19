@component('components.adminTable')
    @if(isset($message))
        @component('components.errorMessage',['message' => $message])@endcomponent
    @endif
    <h3 class="label">Users List</h3>
    @if(isset($userList))
        @foreach ($userList as $user)
            {{--Injects instance of a suspended user service--}}
            @inject('susService','\App\Services\Business\SuspendUserBusinessService')
            @component('components.adminTableRow',['id' => $user->getId(),
                                                    'email' => $user->getEmail(),
                                                    'isAdmin' => $user->getAdmin(),
                                                     'isSuspended' => $susService->suspensionStatus($user)])
            @endcomponent
        @endforeach
    @endif

@endcomponent