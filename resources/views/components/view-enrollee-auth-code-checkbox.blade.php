@if(count($auth_code_records) > 0)

    <h6>Select Authorization Code that apply</h6>
    <div class="row p-2">
        @foreach($auth_code_records as $record)
            <div class="col-lg-4">
                <div class="n-chk">
                    <label class="new-control new-checkbox new-checkbox-rounded new-checkbox-text checkbox-success">
                        <input type="checkbox" class="new-control-input" name="auth_code[]" value="{{ $record->encounter_reference }}">
                        <span class="new-control-indicator"></span>
                        <span class="new-chk-content">{{ $record->authorization_code }} - {{ formatDate($record->created_at) }}</span>
                    </label>
                </div>
            </div>
        @endforeach
    </div>
@else

@endif