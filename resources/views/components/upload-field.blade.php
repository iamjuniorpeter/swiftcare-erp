@props(['params'])
{{-- <div>
    <label style="{{ $params['style'] ?? '' }}">{{ $params['label'] }}</label>
    <label class="upload-button btn btn-success" for="image-input-{{ $params['name'] }}">Choose file</label>
    <input type="file" id="image-input-{{ $params['name'] }}" accept="image/*" style="display: none;" name="{{ $params['name'] }}">
    <div class="image-preview" id="image-preview-{{ $params['name'] }}">
        <img src="{{ asset('@assets/img/image-placeholder.png') }}" alt="{{ $params['label'] }}">
    </div>
    <span class="clear-button btn btn-danger">Delete</span>
    @error($params['name'])
        <p style="color:red; font-size: 14px">{{ $message }}</p>
    @enderror
</div> --}}
<!--<div>-->
<!--    <label style="{{ $params['style'] ?? '' }}">{{ $params['label'] }}</label>-->
<!--    <label class="upload-button btn btn-success" for="{{ $params['name'] }}">Choose file</label>-->
<!--    <input type="file" id="{{ $params['name'] }}" accept="image/*" style="display: none;" name="{{ $params['name'] }}">-->
<!--    <div class="image-preview" id="image-preview-{{ $params['name'] }}">-->
<!--        <img src="{{ asset('@assets/img/image-placeholder.png') }}" alt="{{ $params['label'] }}">-->
<!--    </div>-->
<!--    <span class="clear-button btn btn-danger">Delete</span>-->
<!--    @error($params['name'])-->
<!--        <p style="color:red; font-size: 14px">{{ $message }}</p>-->
<!--    @enderror-->
<!--</div>-->

<div>
    <label style="{{ $params['style'] ?? '' }}">{{ $params['label'] }}</label>
    <label class="upload-button btn btn-success" for="{{ $params['name'] }}">Choose file</label>
    <input type="file" id="{{ $params['name'] }}" accept="image/*" style="display: none;" name="{{ $params['name'] }}">
    <input type="hidden" class="image-placeholder" value="{{asset('@assets/img/image-placeholder.png')}}" />
    <div class="image-preview" id="image-preview-{{ $params['name'] }}">
        <img src="{{ $params['url'] ?? asset('@assets/img/image-placeholder.png') }}" alt="{{ $params['label'] }}">
    </div>
    <span class="clear-button btn btn-danger">Delete</span>
    @error($params['name'])
        <p style="color:red; font-size: 14px">{{ $message }}</p>
    @enderror
</div>
