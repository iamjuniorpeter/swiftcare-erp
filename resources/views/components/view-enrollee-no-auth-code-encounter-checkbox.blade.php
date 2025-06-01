@if(count($encounter_record) > 0)

    <h6 class="m-3">Select Encounter Record that apply</h6>
    <div class="row p-2 m-3">
        @foreach($encounter_record as $record)
            <div class="col-lg-12">
                <div class="n-chk">
                    <label class="new-control new-checkbox new-checkbox-rounded new-checkbox-text checkbox-success">
                        <input type="checkbox" class="new-control-input encounter_code" name="encounter_code[]" value="{{ $record->reference }}">
                        <span class="new-control-indicator"></span>
                        <span class="new-chk-content">{{ formatDateTime($record->created_at) }}</span>
                    </label>
                </div>
            </div>
        @endforeach
    </div>
@else

@endif