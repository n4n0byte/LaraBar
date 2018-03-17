@component('components.form',['method' => 'POST', 'action' => '/CLC/profile/editSkills'])
    <input type="hidden" name="post-id" value="{{$id}}">
    @component('components.editTextInput',['id' => 'title', 'label' => 'Title', 'data' => $title,
                                                 'name' => 'title'])
    @endcomponent
    @component('components.editTextInput',['id' => 'description', 'label' => 'Description', 'data' => $description,
                                                 'name' => 'description'])
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