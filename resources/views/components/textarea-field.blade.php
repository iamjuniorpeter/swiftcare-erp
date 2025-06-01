@props(['params'])
<div class="form-group">
    <label for="{{ $params['name'] }}">{{ $params['label'] }}</label>
    <textarea class="form-control" placeholder="{{ $params['label'] }}"
              id="{{ $params['name'] }}" name="{{ $params['name'] }}"
              style="width: {{ $params['width'] ?? '100%' }};
                     height: {{ $params['height'] ?? 'auto' }};
                     resize: none;"
              {{ $params['readonly'] ?? '' }}>{{ $params['value'] ?? old($params['name']) }}</textarea>
    @error($params['name'])
        <p style="color:red; font-size: 14px">{{ $message }}</p>
    @enderror
</div>
