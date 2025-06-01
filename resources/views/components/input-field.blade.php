@props(['params'])
<div class="form-group">
    <label for="{{ $params['name'] }}">{{ $params['label'] }}</label>
    <input type="{{ $params['type'] }}" class="form-control" placeholder="{{ $params['label'] }}" id="{{ $params['name'] }}" name="{{ $params['name'] }}" value="{{ $params['value'] ?? old($params['name']) }}" {{ $params['readonly'] ?? '' }}>
    @error($params['name'])
        <p style="color:red; font-size: 14px">{{ $message }}</p>
    @enderror
</div>