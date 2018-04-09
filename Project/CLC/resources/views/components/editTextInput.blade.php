<div class="form-group">
    <label for="{{$id or ""}}" class="label">{{$label}}</label>
    <input id="{{$id or ""}}" type="text" class="form-control" name="{{$name}}"
           value="{{$data or ''}}" placeholder="{{$placeholder or ""}}" maxlength="{{$max or 100}}" minlength="{{$min or 3}}" required>
</div>
