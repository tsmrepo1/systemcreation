<div class="form-group">
    <label for="{{$id}}"> {{ $label }} {{ $mandate }}</label>
    <input type="{{$type}}" id="{{$id}}" class="form-control {{$class}}" name="{{$name}}" value="{{$value}}" {{ $attributes }} />
    @error($name)
        <span class="error invalid-feedback">{{$message}}</span>
    @enderror
</div>
