@component('components.form',['method' => 'POST', 'action' => '/CLC/profile/edit'])
    <input type="hidden" name="post-id" value="{{$id}}">
    @component('components.editTextInput',['id' => 'title', 'label' => 'Title', 'data' => $title,
                                                 'name' => 'institution'])
    @endcomponent
    @component('components.editTextInput',['id' => 'description', 'label' => 'Description', 'data' => $description,
                                                 'name' => 'level'])
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