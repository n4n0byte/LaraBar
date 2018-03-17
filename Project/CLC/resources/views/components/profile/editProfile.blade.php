@component('components.form',['method' => 'POST', 'action' => 'profile/updateProfile'])
    @component('components.editTextArea',['id' => 'biography', 'label' => 'Biography', 'data' => $bio,
                                                  'name' => 'bio'])
    @endcomponent
    @component('components.editTextInput',['id' => 'location', 'label' => 'Location', 'data' => $location,
                                                 'name' => 'location'])
    @endcomponent
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