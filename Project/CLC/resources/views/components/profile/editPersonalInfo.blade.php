@component('components.form',['method' => 'POST', 'action' => 'profile/editPersonalInfo'])
    <input type="hidden" name="post-id" value="{{$model->getId()}}">
    @component('components.editTextInput',['id' => 'firstName', 'label' => 'First Name',
                                                 'name' => 'firstName', 'data' => $model->getFirstName()])
    @endcomponent
    @component('components.editTextInput',['id' => 'lastName', 'label' => 'Last Name',
                                                 'name' => 'lastName', 'data' => $model->getLastName()])
    @endcomponent
    @component('components.editTextInput',['id' => 'email', 'label' => 'Email',
                                                 'name' => 'email', 'data' => $model->getEmail()])
    @endcomponent
    @component('components.editPasswordInput', ['confirm' => true])@endcomponent


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