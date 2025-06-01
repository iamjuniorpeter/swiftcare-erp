@props(['params'])

<x-modal class="modal-xl" title="Enrollee Profile: {{ $params['modal_title'] }}" modalid="viewEnrolleeProfileModal{{ $params['modal_id'] }}">
    <x-slot name="modal_body">
        <div class="row p-4">
            <div class="col-lg-3 text-center">
                <div class="card component-card_4">
                    <div class="card-body">
                        <div class="avatar avatar-xl text-center infobox-1">
                            <img alt="" src="{{ $params['enrollee_record']->photograph ?? '' }}" class="img-responsive" style="width:120px; height:auto;" />
                        </div>
                    </div>
                </div>
                <h6 class="mt-4 font-weight-bold">Service Number: </h6>
                <p>{{ $params['enrollee_record']->service_number ?? '' }}</p>
                <h6 class="mt-2 font-weight-bold">ID Number: </h6>
                <p>{{ $params['enrollee_record']->id_number ?? '' }}</p>
                <h6 class="mt-2 font-weight-bold">Programme: </h6>
                <p>{{ $params['enrollee_record']->programme ?? '' }}</p>
                <h6 class="mt-2 font-weight-bold">Member </h6>
                <p>{{ $params['enrollee_record']->relationship ?? '' }}</p>
            </div>
            <div class="col-lg-9">
                <div class="card component-card_4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4">
                                <tbody>
                                    <tr>
                                        <td class="align-top">
                                            <label>Surname</label>
                                            <p>{{ $params['enrollee_record']->surname ?? '' }}</p>
                                            <label>First Name</label>
                                            <p>{{ $params['enrollee_record']->first_name ?? '' }}</p>
                                            <label>Other Names</label>
                                            <p>{{ $params['enrollee_record']->middle_name ?? '' }}</p>
                                            <label>Gender</label>
                                            <p>{{ $params['enrollee_record']->gender ?? '' }}</p>
                                            <label>Marital Status</label>
                                            <p>{{ $params['enrollee_record']->marital_status ?? '' }}</p>
                                        </td>
                                        <td class="align-top">
                                            <label>Date of Birth</label>
                                            <p>{{ $params['enrollee_record']->date_of_birth ?? '' }}</p>
                                            <label>Blood Group</label>
                                            <p>{{ $params['enrollee_record']->blood_group ?? '' }}</p>
                                            <label>NIN</label>
                                            <p>{{ $params['enrollee_record']->nin ?? '' }}</p>
                                            <label>Rank</label>
                                            <p>{{ $params['enrollee_record']->rank ?? '' }}</p>
                                            <label>Account Status</label>
                                            <p class="text-success font-weight-bold">{{ $params['enrollee_record']->account_status ?? '' }}</p>
                                        </td>
                                        <td class="align-top">
                                            <label>Phone Number</label>
                                            <p>{{ $params['enrollee_record']->phone ?? '' }}</p>
                                            <label>Email Address</label>
                                            <p>{{ $params['enrollee_record']->email ?? '' }}</p>
                                            <label>Residential Address</label>
                                            <p>{{ $params['enrollee_record']->residential_address ?? '' }}</p>
                                            <label>LGA of Residence</label>
                                            <p>{{ $params['enrollee_record']->lga_of_residence ?? '' }}</p>
                                            <label>State of Residence</label>
                                            <p>{{ $params['enrollee_record']->state_of_residence ?? '' }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-top" colspan="3">
                                            <label>Medical History</label>
                                            <p>{{ $params['enrollee_record']->medical_history ?? '' }}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(count($params['enrollee_record']->dependants) > 0)
        <div class="row mt-4">
            <div class="col-lg-12">
                @foreach($params['enrollee_record']->dependants as $dependant_data)
                <div id="toggleAccordion">
                    <div class="card">
                        <div class="card-header" id="headingOne{{ $loop->iteration }}">
                            <section class="mb-0 mt-0">
                                <div role="button" class="collapsed" data-toggle="collapse" data-target="#defaultAccordion{{ $loop->iteration }}" aria-expanded="false" aria-controls="defaultAccordion{{ $loop->iteration }}">
                                    <h6>
                                        {{ $dependant_data->relationship ?? '' }} - {{ strtoupper($dependant_data->surname) ?? '' }}, {{ $dependant_data->first_name ?? '' }} {{ $dependant_data->middle_name ?? '' }}
                                        <span class="icons float-right">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                <polyline points="6 9 12 15 18 9"></polyline>
                                            </svg>
                                        </span>
                                    </h6>
                                </div>
                            </section>
                        </div>

                        <div id="defaultAccordion{{ $loop->iteration }}" class="collapse" aria-labelledby="headingOne{{ $loop->iteration }}" data-parent="#toggleAccordion">
                            <div class="card-body">
                                <div class="row p-4">
                                    <div class="col-lg-3 text-center">
                                        <div class="card component-card_4">
                                            <div class="card-body">
                                                <div class="avatar avatar-xl text-center infobox-1">
                                                    <img alt="" src="{{ $dependant_data->photograph ?? '' }}" class="rounded-circle" style="width:120px; height:auto;" />
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="mt-2 font-weight-bold">ID Number: </h6>
                                        <p>{{ $dependant_data->id_number ?? '' }}</p>
                                        <h6 class="mt-2 font-weight-bold">Programme: </h6>
                                        <p>{{ $dependant_data->programme ?? '' }}</p>
                                        <h6 class="mt-2 font-weight-bold">Member </h6>
                                        <p>Dependant</p>
                                        <h6 class="mt-2 font-weight-bold">Relationship </h6>
                                        <p>{{ $dependant_data->relationship ?? '' }}</p>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="card component-card_4">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered mb-4">
                                                        <tbody>
                                                            <tr>
                                                                <td class="align-top">
                                                                    <label>Surname</label>
                                                                    <p>{{ $dependant_data->surname ?? '' }}</p>
                                                                    <label>First Name</label>
                                                                    <p>{{ $dependant_data->first_name ?? '' }}</p>
                                                                    <label>Other Names</label>
                                                                    <p>{{ $dependant_data->other_names ?? '' }}</p>
                                                                    <label>Gender</label>
                                                                    <p>{{ $dependant_data->gender ?? '' }}</p>
                                                                    <label>Marital Status</label>
                                                                    <p>{{ $dependant_data->marital_status ?? '' }}</p>
                                                                </td>
                                                                <td class="align-top">
                                                                    <label>Date of Birth</label>
                                                                    <p>{{ $dependant_data->date_of_birth ?? '' }}</p>
                                                                    <label>Blood Group</label>
                                                                    <p>{{ $dependant_data->blood_group ?? '' }}</p>
                                                                    <label>NIN</label>
                                                                    <p>{{ $dependant_data->nin ?? '' }}</p>
                                                                    <label>Account Status</label>
                                                                    <p class="text-success font-weight-bold">{{ $dependant_data->account_status ?? '' }}</p>
                                                                </td>
                                                                <td class="align-top">
                                                                    <label>Phone Number</label>
                                                                    <p>{{ $dependant_data->phone ?? '' }}</p>
                                                                    <label>Email Address</label>
                                                                    <p>{{ $dependant_data->email ?? '' }}</p>
                                                                    <label>Residential Address</label>
                                                                    <p>{{ $dependant_data->residential_address ?? '' }}</p>
                                                                    <label>LGA of Residence</label>
                                                                    <p>{{ $dependant_data->lga_of_residence ?? '' }}</p>
                                                                    <label>State of Residence</label>
                                                                    <p>{{ $dependant_data->state_of_residence ?? '' }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-top" colspan="3">
                                                                    <label>Medical History</label>
                                                                    <p>{{ $dependant_data->medical_history ?? '' }}</p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </x-slot>
    <x-slot name="modal_footer">
    </x-slot>
</x-modal>