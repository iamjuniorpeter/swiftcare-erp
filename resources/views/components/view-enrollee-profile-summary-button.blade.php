@props(['params'])
<a class="dropdown-item" data-toggle="modal" data-target="#viewEnrolleeProfileModal{{ $params['modal_id'] }}" href="javascript:void(0)">View Enrollee Details</a>

<x-view-enrollee-profile-summary 
    :display="''" 
    :modal_id="$params['modal_id']"
    :modal_title="$params['modal_title'] "
    :enrollee_records="$params['enrollee_record']" />

