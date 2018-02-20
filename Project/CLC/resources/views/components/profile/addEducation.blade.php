@component('components.form',['method' => 'POST', 'action' => '/CLC/profile/add'])
    @component('components.editTextInput',['id' => 'institution', 'label' => 'University/Institution',  'name' => 'institution'])
    @endcomponent
    @component('components.editTextInput',['id' => 'level', 'label' => 'Degree',  'name' => 'level'])
    @endcomponent
    @component('components.editTextInput',['id' => 'degree', 'label' => 'Program of Study', 'name' => 'degree'])
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