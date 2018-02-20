@component('components.form',['method' => 'POST', 'action' => '/CLC/profile/add'])
    @component('components.editTextInput',['id' => 'employer', 'label' => 'Employer',
                                                 'name' => 'employer'])
    @endcomponent
    @component('components.editTextInput',['id' => 'position', 'label' => 'Position',
                                                 'name' => 'position'])
    @endcomponent
    @component('components.editTextInput',['id' => 'duration', 'label' => 'Employment Duration',
                                                 'name' => 'duration'])
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