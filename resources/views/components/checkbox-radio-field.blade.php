@props(['params'])
<div class="n-chk mb-{{ $params['mb'] }}">
    <label class="new-control new-{{ $params['type'] }} {{ $params['type'] }}-{{ $params['color'] ?? 'primary' }}">
        <input type="{{ $params['type'] }}" class="new-control-input" name="{{ $params['name'] }}" id="{{ $params['id'] ?? $params['name'] }}" value="{{ $params['value'] ?? '' }}" {{ $params['checked'] ?? '' }} @if (isset($params['value']) && (old($params['name']) == $params['value'])) checked @endif>
        <span class="new-control-indicator"></span>{{ $params['label'] }}
    </label>
    @error($params['name'])
        <p style="color:red; font-size: 14px">{{ $message }}</p>
    @enderror
</div>