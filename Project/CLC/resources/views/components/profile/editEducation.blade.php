@component('components.form',['method' => 'POST', 'action' => '/CLC/profile/editEducation'])
    <input type="hidden" name="post-id" value="{{$id}}">
    @component('components.editTextInput',['id' => 'institution', 'label' => 'University/Institution', 'data' => $institution,
                                                 'name' => 'institution'])
    @endcomponent
    @component('components.editTextInput',['id' => 'level', 'label' => 'Degree', 'data' => $level,
                                                 'name' => 'level'])
    @endcomponent
    @component('components.editTextInput',['id' => 'degree', 'label' => 'Program of Study', 'data' => $degree,
                                                 'name' => 'degree'])
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