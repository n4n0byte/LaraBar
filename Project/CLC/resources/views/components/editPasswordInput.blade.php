<div class="form-group">
    <label for="password-input" class="label">Password</label>
    <input id='password-input' oninput="{{$passwordClick or ''}}" type="password"
           class="form-control" name="password" value="{{$data or ''}}">
</div>
@if(isset($confirm)? $confirm : FALSE)
    <div class="form-group">
        <label for="confirm-input" class="label">Confirm Password</label>
        <input id="confirm-input" oninput="{{$confirmClick or ''}}" type="password"
               class="form-control" name="confirmPassword" value="{{$data or ''}}">
    </div>
@endif
