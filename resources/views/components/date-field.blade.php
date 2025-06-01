@props(['params'])
{{-- <div>
    <label for="{{ $params['name'] }}">{{ $params['label'] }}</label>
    <input id="{{ $params['name'] }}" name="{{ $params['name'] }}"
        value="{{ old($params['name']) }}"
        class="form-control flatpickr flatpickr-input active"
        type="{{ $params['type'] }}" placeholder="Select {{ $params['label'] }}">
    @error($params['name'])
        <p style="color:red; font-size: 14px">{{ $message }}</p>
    @enderror
</div> --}}

<div>
    <label for="{{ $params['name'] }}">{{ $params['label'] }}</label>
    <input id="{{ $params['name'] }}" name="{{ $params['name'] }}" value="{{ $params['value'] ?? old($params['name']) }}" class="form-control flatpickr flatpickr-input active" type="date" placeholder="Select {{ $params['label'] }}" {{ $params['readonly'] ?? '' }}>
    @error($params['name'])
        <p style="color:red; font-size: 14px">{{ $message }}</p>
    @enderror
</div>