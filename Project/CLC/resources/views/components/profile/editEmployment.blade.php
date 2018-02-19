@component('components.form',['method' => 'POST', 'action' => '/CLC/profile/edit'])
    @component('components.editTextInput',['id' => 'employer', 'label' => 'Employer', 'data' => $employer,
                                                 'name' => 'employer'])
    @endcomponent
    @component('components.editTextInput',['id' => 'position', 'label' => 'Position', 'data' => $position,
                                                 'name' => 'position'])
    @endcomponent
    @component('components.editTextInput',['id' => 'duration', 'label' => 'Employment Duration', 'data' => $duration,
                                                 'name' => 'duration'])
    @endcomponent
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                Don't press this:
                @component('components.submitButton')@endcomponent
            </div>
            <div class="col-md-6">
                <a href="/CLC/profile" class="btn btn-outline-primary btn-block badge-danger">Cancel</a>
            </div>
        </div>
    </div>
@endcomponent