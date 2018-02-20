@component('components.form',['method' => 'POST', 'action' => '/CLC/profile/add/profile'])
    @component('components.editTextArea',['id' => 'biography', 'label' => 'Biography',
                                                  'name' => 'bio'])
    @endcomponent
    @component('components.editTextInput',['id' => 'location', 'label' => 'Location',
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