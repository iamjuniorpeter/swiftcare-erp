@props(['params'])
<div class="form-group">
    <label for="{{ $params['name'] }}">{{ $params['label'] }}</label>
    <select class="selectpicker form-control" data-live-search="true" id="{{ $params['name'] }}" name="{{ $params['name'] }}" title="{{ $params['placeholder'] ?? 'Select '.$params['label'] }}">
        {{-- <option value="">Select {{ $params['label'] }}</option> --}}
        @foreach ($params['options'] as $value => $optionLabel)
            <option value="{{ $value }}" @if (isset($params['selected']) && $params['selected'] == $value) selected @endif @if (old($params['name']) == $value) selected @endif>{{ $optionLabel }}</option>
        @endforeach

    </select>
    @error($params['name'])
        <p style="color:red; font-size: 14px">{{ $message }}</p>
    @enderror
</div>
