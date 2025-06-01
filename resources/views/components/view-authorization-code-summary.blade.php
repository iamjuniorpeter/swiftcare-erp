<div class="row p-4">
    <div class="col-lg-12">
        <div class="card component-card_4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-4">
                        <tbody>
                            <tr>
                                <td class="align-top">
                                    <h5 class="mb-4">Authorization Code Info.</h5>
                                    <label class="font-weight-bold">Reference</label>
                                    <p>{{ $records->reference ?? '' }}</p>
                                    <label class="font-weight-bold">Referring HCP</label>
                                    <p>{{ $records->referral_hcp->hcp_name ?? $records->referralHcp->hcp_name ?? "" }}</p>
                                    <label class="font-weight-bold">Receiving HCP</label>
                                    <p>{{ $records->receiving_hcp->hcp_name ?? $records->receivingHcp->hcp_name ?? '' }}</p>
                                    <label class="font-weight-bold">Authorization Code</label>
                                    <p>{{ $records->authorization_code ?? '' }}</p>
                                    <label class="font-weight-bold">Status</label>
                                    <p>{{ $records->status ?? '' }}</p>
                                </td>
                                <td class="align-top">
                                    <h5 class="mb-4">Authorization Code Details</h5>
                                    <label class="font-weight-bold">Investigation</label>
                                    <p>{{ $records->investigation->name ?? '' }}</p>
                                    <label class="font-weight-bold">Drug</label>
                                    <p>{{ $records->drug->name ?? '' }}</p>
                                    <label class="font-weight-bold">Auth. Code Remark</label>
                                    <p>{{ $records->remark ?? '' }}</p>
                                    <label class="font-weight-bold">Encounter Remark</label>
                                    <p>{{ $records->encounter->remark ?? '' }}</p>
                                    <label class="font-weight-bold">HMO Remark</label>
                                    <p>{{ $records->hmo_remark ?? '' }}</p>
                                </td>
                                <td class="align-top">
                                    <h5 class="mb-4">Encounter Info.</h5>
                                    <label class="font-weight-bold">Enrollee Names</label>
                                    <p>{{ $records->encounter->enrollee->surname ?? '' }} {{ $records->encounter->enrollee->first_name ?? '' }} {{ $records->encounter->enrollee->middle_name ?? '' }}</p>
                                    <label class="font-weight-bold">Enrollee ID Number</label>
                                    <p>{{ $records->encounter->enrollee->id_number ?? '' }}</p>
                                    <label class="font-weight-bold">Doctor Note</label>
                                    <p>{{ $records->encounter->doctor_note ?? '' }}</p>
                                    <label class="font-weight-bold">Encounter Remark</label>
                                    <p>{{ $records->encounter->remark ?? '' }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>