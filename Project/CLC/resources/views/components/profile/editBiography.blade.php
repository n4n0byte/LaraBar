@component('components.form',['method' => 'POST', 'action' => 'profile/editBiography'])
    <input type="hidden" name="post-id" value="{{$id}}">
    @component('components.editTextInput',['id' => 'biography', 'label' => 'Biography',
                                                 'name' => 'biography', 'data' => $biography])
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