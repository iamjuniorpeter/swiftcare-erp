@props(['params'])
<a class="dropdown-item" data-toggle="modal" data-target="#viewEncounterInfoModal{{ $params['modal_id'] }}" href="javascript:void(0)">View Encounter Info</a>

<x-modal class="modal-xl" title="Encounter Information for  {{ $params['modal_title'] }} " modalid="viewEncounterInfoModal{{ $params['modal_id'] }}">
    <x-slot name="modal_body">
        <div class="row p-4">
            <div class="col-lg-3 text-center">
                <div class="card component-card_4">
                    <div class="card-body">
                        <div class="avatar avatar-xl text-center infobox-1">
                            <img alt="avatar" src="{{ asset('@assets/img/enrollees/' . ($params['encounter_data']->avatar ?? '')) }}" class="rounded-circle img-responsive" />
                        </div>
                    </div>
                </div>
                <h6 class="mt-4 font-weight-bold">Service Number: </h6>
                <p>{{ $params['encounter_data']->service_number ?? '' }}</p>
                <h6 class="mt-2 font-weight-bold">ID Number: </h6>
                <p>{{ $params['encounter_data']->id_number ?? '' }}</p>
                <h6 class="mt-2 font-weight-bold">Programme: </h6>
                <p>{{ $params['encounter_data']->programme ?? '' }}</p>
                <h6 class="mt-2 font-weight-bold">Member </h6>
                <p>{{ $params['encounter_data']->relationship ?? '' }}</p>
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
                                            <p>{{ $params['encounter_data']->surname ?? '' }}</p>
                                            <label>First Name</label>
                                            <p>{{ $params['encounter_data']->first_name ?? '' }}</p>
                                            <label>Other Names</label>
                                            <p>{{ $params['encounter_data']->middle_name ?? '' }}</p>
                                            <label>Gender</label>
                                            <p>{{ $params['encounter_data']->gender ?? '' }}</p>
                                            <label>Marital Status</label>
                                            <p>{{ $params['encounter_data']->marital_status ?? '' }}</p>
                                        </td>
                                        <td class="align-top">
                                            <label>Date of Birth</label>
                                            <p>{{ $params['encounter_data']->date_of_birth ?? '' }}</p>
                                            <label>Blood Group</label>
                                            <p>{{ $params['encounter_data']->blood_group ?? '' }}</p>
                                            <label>NIN</label>
                                            <p>{{ $params['encounter_data']->nin ?? '' }}</p>
                                            <label>Rank</label>
                                            <p>{{ $params['encounter_data']->rank ?? '' }}</p>
                                            <label>Account Status</label>
                                            <p class="text-success font-weight-bold">{{ $params['encounter_data']->account_status ?? '' }}</p>
                                        </td>
                                        <td class="align-top">
                                            <label>Phone Number</label>
                                            <p>{{ $params['encounter_data']->phone ?? '' }}</p>
                                            <label>Email Address</label>
                                            <p>{{ $params['encounter_data']->email ?? '' }}</p>
                                            <label>Residential Address</label>
                                            <p>{{ $params['encounter_data']->residential_address ?? '' }}</p>
                                            <label>LGA of Residence</label>
                                            <p>{{ $params['encounter_data']->lga_of_residence ?? '' }}</p>
                                            <label>State of Residence</label>
                                            <p>{{ $params['encounter_data']->state_of_residence ?? '' }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-top" colspan="3">
                                            <label>Medical History</label>
                                            <p>{{ $params['encounter_data']->medical_history ?? '' }}</p>
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