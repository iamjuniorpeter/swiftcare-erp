@if($display == 'modal')

<x-modal class="modal-xl" title="{{ $attributes['modal_title'] }} " modalid="viewEnrolleeProfileSummaryModal{{ $attributes['modal_id'] }}">
    <x-slot name="modal_body">
        <div class="row p-4">
            <div class="col-lg-3 text-center">
                <div class="card component-card_4">
                    <div class="card-body">
                        <div class="avatar avatar-xl text-center infobox-1">
                            <img alt="" src="{{ $attributes['enrollee_records']->photograph ?? '' }}" class="img-responsive" style="width:120px; height:auto;" />
                        </div>
                    </div>
                </div>
                <h6 class="mt-2 font-weight-bold">ID Number: </h6>
                <p>{{ $attributes['enrollee_records']->id_number ?? '' }}</p>
            </div>
            <div class="col-lg-9">
                <div class="card component-card_4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4">
                                <tbody>
                                    <tr>
                                        <td class="align-top">
                                            <label class="font-weight-bold">Surname</label>
                                            <p>{{ $attributes['enrollee_records']->surname ?? '' }}</p>
                                            <label class="font-weight-bold">Gender</label>
                                            <p>{{ $attributes['enrollee_records']->gender ?? '' }}</p>
                                            <label class="font-weight-bold">Phone Number</label>
                                            <p>{{ $attributes['enrollee_records']->phone ?? '' }}</p>
                                            <label class="font-weight-bold">Programme</label>
                                            <p>{{ $attributes['enrollee_records']->scheme->scheme_name ?? '' }}</p>
                                        </td>
                                        <td class="align-top">
                                            <label class="font-weight-bold">First Name</label>
                                            <p>{{ $attributes['enrollee_records']->first_name ?? '' }}</p>
                                            <label class="font-weight-bold">Marital Status</label>
                                            <p>{{ $attributes['enrollee_records']->marital_status ?? '' }}</p>
                                            <label class="font-weight-bold">Address</label>
                                            <p>{{ $attributes['enrollee_records']->residential_address ?? '' }}</p>
                                        </td>
                                        <td class="align-top">
                                            <label class="font-weight-bold">Other Names</label>
                                            <p>{{ $attributes['enrollee_records']->middle_name ?? '' }}</p>
                                            <label class="font-weight-bold">Service Number</label>
                                            <p>{{ $attributes['enrollee_records']->service_number ?? '' }}</p>
                                            <label class="font-weight-bold">Relationship</label>
                                            <p>{{ $attributes['enrollee_records']->relationship ?? '' }}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="modal_footer">
    </x-slot>
</x-modal>
@elseif($display == 'profile')
@php $enrollee_records = $attributes['enrollee_records'] ?? $enrollee_records; @endphp

<div class="row p-4">
    <div class="col-lg-3 text-center">
        <div class="card component-card_4">
            <div class="card-body">
                <div class="avatar avatar-xl text-center infobox-1">
                    <img alt="" src="{{ $enrollee_records->photograph ?? '' }}" class="img-responsive" style="width:120px; height:auto;" />
                </div>
            </div>
        </div>
        <h6 class="mt-2 font-weight-bold">ID Number:: </h6>
        <p>{{ $enrollee_records->id_number ?? '' }}</p>
    </div>
    <div class="col-lg-9">
        <div class="card component-card_4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-4">
                        <tbody>
                            <tr>
                                <td class="align-top">
                                    <label class="font-weight-bold">Surname</label>
                                    <p>{{ $enrollee_records->surname ?? '' }}</p>
                                    <label class="font-weight-bold">Gender</label>
                                    <p>{{ $enrollee_records->gender ?? '' }}</p>
                                    <label class="font-weight-bold">Phone Number</label>
                                    <p>{{ $enrollee_records->phone ?? '' }}</p>
                                    <label class="font-weight-bold">Programme</label>
                                    <p>{{ $enrollee_records->scheme->scheme_name ?? '' }}</p>
                                </td>
                                <td class="align-top">
                                    <label class="font-weight-bold">First Name</label>
                                    <p>{{ $enrollee_records->first_name ?? '' }}</p>
                                    <label class="font-weight-bold">Marital Status</label>
                                    <p>{{ $enrollee_records->marital_status ?? '' }}</p>
                                </td>
                                <td class="align-top">
                                    <label class="font-weight-bold">Other Names</label>
                                    <p>{{ $enrollee_records->middle_name ?? '' }}</p>
                                    <label class="font-weight-bold">Service Number</label>
                                    <p>{{ $enrollee_records->service_number ?? '' }}</p>
                                    <label class="font-weight-bold">Relationship</label>
                                    <p>{{ $enrollee_records->relationship ?? '' }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <label class="font-weight-bold">Address</label>
                                    <p>{{ $enrollee_records->residential_address ?? '' }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@else

@endif