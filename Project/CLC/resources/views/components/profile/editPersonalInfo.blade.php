@component('components.form',['method' => 'POST', 'action' => 'profile/editPersonalInfo'])
    <input type="hidden" name="post-id" value="{{$id}}">
    @component('components.editTextInput',['id' => 'firstName', 'label' => 'First Name',
                                                 'name' => 'firstName'])
    @endcomponent
    @component('components.editTextInput',['id' => 'lastName', 'label' => 'Last Name',
                                                 'name' => 'lastName'])
    @endcomponent
    @component('components.editTextInput',['id' => 'email', 'label' => 'Email',
                                                 'name' => 'email'])
    @endcomponent
    @component('components.editPasswordInput')@endcomponent


    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @component('components.submitButton')@endcomponent
            </div>
            <div class="col-md-6">
                <a href="/CLC/profile" class="btn btn-outline-primary btn-block badge-danger">Cancel</a>
            </div>
        </div>
    </div>
@endcomponent