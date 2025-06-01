@props(['params'])

<button type="button" class="btn btn-dark btn-sm btnViewEnrolleeProfileModal" data-toggle="modal" data-target="#viewEnrolleeProfileModal{{ $params['modal_id'] }}">
    View
</button>

<x-modal class="modal-xl" title="Enrollee Profile: {{ $params['modal_title'] }}" modalid="viewEnrolleeProfileModal{{ $params['modal_id'] }}">
    <x-slot name="modal_body">
        <div class="row p-4">
            <div class="col-lg-3 text-center">
                <div class="card component-card_4">
                    <div class="card-body">
                        <div class="avatar avatar-xl text-center infobox-1">
                            <img alt="" src="{{ $params['principal_records']['photograph'] ?? '' }}" class="img-responsive" style="width:120px; height:auto;" />
                        </div>
                    </div>
                </div>
                <h6 class="mt-4 font-weight-bold">Service Number: </h6>
                <p>{{ $params['principal_records']['service_number'] ?? '' }}</p>
                <h6 class="mt-2 font-weight-bold">ID Number: </h6>
                <p>{{ $params['principal_records']['id_number'] ?? '' }}</p>
                <h6 class="mt-2 font-weight-bold">Programme: </h6>
                <p>{{ $params['principal_records']['programme'] ?? '' }}</p>
                <h6 class="mt-2 font-weight-bold">Member </h6>
                <p>Principal</p>
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
                                            <p>{{ $params['principal_records']['surname'] ?? '' }}</p>
                                            <label>First Name</label>
                                            <p>{{ $params['principal_records']['first_name'] ?? '' }}</p>
                                            <label>Other Names</label>
                                            <p>{{ $params['principal_records']['other_names'] ?? '' }}</p>
                                            <label>Gender</label>
                                            <p>{{ $params['principal_records']['gender'] ?? '' }}</p>
                                            <label>Marital Status</label>
                                            <p>{{ $params['principal_records']['marital_status'] ?? '' }}</p>
                                        </td>
                                        <td class="align-top">
                                            <label>Date of Birth</label>
                                            <p>{{ $params['principal_records']['date_of_birth'] ?? '' }}</p>
                                            <label>Blood Group</label>
                                            <p>{{ $params['principal_records']['blood_group'] ?? '' }}</p>
                                            <label>NIN</label>
                                            <p>{{ $params['principal_records']['nin'] ?? '' }}</p>
                                            <label>Rank</label>
                                            <p>{{ $params['principal_records']['rank'] ?? '' }}</p>
                                            <label>Account Status</label>
                                            <p class="text-success font-weight-bold">{{ $params['principal_records']['account_status'] ?? '' }}</p>
                                        </td>
                                        <td class="align-top">
                                            <label>Phone Number</label>
                                            <p>{{ $params['principal_records']['phone'] ?? '' }}</p>
                                            <label>Email Address</label>
                                            <p>{{ $params['principal_records']['email'] ?? '' }}</p>
                                            <label>Residential Address</label>
                                            <p>{{ $params['principal_records']['residential_address'] ?? '' }}</p>
                                            <label>LGA of Residence</label>
                                            <p>{{ $params['principal_records']['lga_of_residence'] ?? '' }}</p>
                                            <label>State of Residence</label>
                                            <p>{{ $params['principal_records']['state_of_residence'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-top" colspan="3">
                                            <label>Medical History</label>
                                            <p>{{ $params['principal_records']['medical_history'] ?? '' }}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12">

                @foreach($params['dependant_records'] as $dependant_data)
                <div id="toggleAccordion">
                    <div class="card">
                        <div class="card-header" id="headingOne{{ $loop->iteration }}">
                            <section class="mb-0 mt-0">
                                <div role="button" class="collapsed" data-toggle="collapse" data-target="#defaultAccordion{{ $loop->iteration }}" aria-expanded="false" aria-controls="defaultAccordion{{ $loop->iteration }}">
                                    <h6>
                                        {{ $dependant_data['relationship'] ?? '' }} - {{ strtoupper($dependant_data['surname']) ?? '' }}, {{ $dependant_data['first_name'] ?? '' }} {{ $dependant_data['other_names'] ?? '' }}
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
                                                    <img alt="" src="{{ $dependant_data['photograph'] ?? '' }}" class="img-responsive" style="width:120px; height:auto;" />
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="mt-2 font-weight-bold">ID Number: </h6>
                                        <p>{{ $dependant_data['id_number'] ?? '' }}</p>
                                        <h6 class="mt-2 font-weight-bold">Programme: </h6>
                                        <p>{{ $dependant_data['programme'] ?? '' }}</p>
                                        <h6 class="mt-2 font-weight-bold">Member </h6>
                                        <p>Dependant</p>
                                        <h6 class="mt-2 font-weight-bold">Relationship </h6>
                                        <p>{{ $dependant_data['relationship'] ?? '' }}</p>
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
                                                                    <p>{{ $dependant_data['surname'] ?? '' }}</p>
                                                                    <label>First Name</label>
                                                                    <p>{{ $dependant_data['first_name'] ?? '' }}</p>
                                                                    <label>Other Names</label>
                                                                    <p>{{ $dependant_data['other_names'] ?? '' }}</p>
                                                                    <label>Gender</label>
                                                                    <p>{{ $dependant_data['gender'] ?? '' }}</p>
                                                                    <label>Marital Status</label>
                                                                    <p>{{ $dependant_data['marital_status'] ?? '' }}</p>
                                                                </td>
                                                                <td class="align-top">
                                                                    <label>Date of Birth</label>
                                                                    <p>{{ $dependant_data['date_of_birth'] ?? '' }}</p>
                                                                    <label>Blood Group</label>
                                                                    <p>{{ $dependant_data['blood_group'] ?? '' }}</p>
                                                                    <label>NIN</label>
                                                                    <p>{{ $dependant_data['nin'] ?? '' }}</p>
                                                                    <label>Account Status</label>
                                                                    <p class="text-success font-weight-bold">{{ $dependant_data['account_status'] ?? '' }}</p>
                                                                </td>
                                                                <td class="align-top">
                                                                    <label>Phone Number</label>
                                                                    <p>{{ $dependant_data['phone'] ?? '' }}</p>
                                                                    <label>Email Address</label>
                                                                    <p>{{ $dependant_data['email'] ?? '' }}</p>
                                                                    <label>Residential Address</label>
                                                                    <p>{{ $dependant_data['residential_address'] ?? '' }}</p>
                                                                    <label>LGA of Residence</label>
                                                                    <p>{{ $dependant_data['lga_of_residence'] ?? '' }}</p>
                                                                    <label>State of Residence</label>
                                                                    <p>{{ $dependant_data['state_of_residence'] ?? '' }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-top" colspan="3">
                                                                    <label>Medical History</label>
                                                                    <p>{{ $dependant_data['medical_history'] ?? '' }}</p>
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
    </x-slot>
    <x-slot name="modal_footer">
    </x-slot>
</x-modal>