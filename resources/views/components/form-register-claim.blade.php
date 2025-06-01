@props(['params'])

@if(strtolower($params['action']) == "edit")

@php
$claim_reference = $params['claim_reference'];
$claim_record = $params['claim_records'];
$service_category_list = $params['service_category_list'];
$service_list = $params['service_list'];
$drug_list = $params['drug_list'];
$hcp_claim_month = $params['hcp_claim_month'];
$hcp_claim_year = $params['hcp_claim_year'];
$cmbAuthCode = $claim_record->authorization_codeID;
@endphp



<div class="page-header">
    <div class="page-title">
        <h3>Edit Claim {{ $claim_reference }}</h3>
    </div>
</div>

<div class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-content widget-content-area">
            <form name="frmSubmitClaim" id="frmSubmitClaim" action="{{ route('claim.update') }}" enctype="multipart/form-data" method="post">
                <div class=" row m-3">
                    <!--display auth code summary-->
                    <div class="col-xl-12 col-lg-12 col-sm-12 mt-2 layout-spacing">
                        <div class="widget-content widget-content-area br-6" id="authCodeRecordContainer">
                            <x-view-authorization-code-summary :records="$claim_record->authorization_code" />
                        </div>
                    </div>
                    <!--end display auth code summary-->

                    <!--display encounter form details-->
                    <div class="col-xl-12 col-lg-12 col-sm-12 mt-2 layout-spacing">
                        <div id="displayServiceArena">
                            <h5>Add Service(s)</h5>
                            @foreach($claim_record->clmservices as $clmservice)
                            <div class="duplicateService">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Select Service Category</label>
                                        <select class="form-control cmbSelectServiceCategory" name="cmbSelectServiceCategory[]">
                                            {!! markOptionAsSelected($service_category_list, $clmservice->nhis_service_categoryID); !!}
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Select Service</label>
                                        <select class="form-control cmbSelectService" name="cmbSelectService[]">
                                            {!! markOptionAsSelected($service_list, $clmservice->nhis_serviceID) !!}
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Unit</label>
                                        <div class="input-group mb-4">
                                            <input type="number" value="{{ $clmservice->unit  }}" min="1" max="100000000" name="serviceUnit[]" class="form-control" placeholder="Unit of Service" aria-label="Unit of Service">
                                        </div>
                                    </div>
                                    <button class='btn btn-sm btn-danger form-group mt- col-md-2 removeItem' style='margin-top:-3%'>Remove Item</button>
                                </div>
                            </div>
                            @endforeach

                            <div class="duplicateService" id="duplicateService" style="display: none;">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Select Service Category</label>
                                        <select class="form-control cmbSelectServiceCategory" name="cmbSelectServiceCategory[]">
                                            {!! $service_category_list !!}
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Select Service</label>
                                        <select class="form-control cmbSelectService" name="cmbSelectService[]">
                                            <option value="-1" selected="selected">Select Service</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Unit</label>
                                        <div class="input-group mb-4">
                                            <input type="number" min="1" max="100000000" name="serviceUnit[]" class="form-control" placeholder="Unit of Service" aria-label="Unit of Service">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="icon-container badge badge-pills text-primary">
                                <a href="javascript:void(0)" class="text-primary" id="addServiceItem">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                    Add Service
                                </a>
                            </div>
                        </div>
                        <div id="displayDrugArena" class="mt-5">
                            <h5>Add Drug(s)</h5>
                            @foreach($claim_record->clmdrugs as $clmdrug)
                            <div class="duplicateDrug">
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputEmail4">Select Drug</label>
                                        <select class="form-control cmbSelectDrug" name="cmbDrug[]">
                                            {!! markOptionAsSelected($drug_list, $clmdrug->nhis_drugID); !!}
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Unit</label>
                                        <div class="input-group mb-4">
                                            <input type="number" value="{{ $clmdrug->unit  }}" min="1" max="100000000" name="drugUnit[]" class="form-control" placeholder="Unit of Service" aria-label="Unit of Service">
                                        </div>
                                    </div>
                                    <button class='btn btn-sm btn-danger form-group mt- col-md-2 removeItem' style='margin-top:-3%'>Remove Item</button>
                                </div>
                            </div>
                            @endforeach
                            <div class="duplicateDrug" id="duplicateDrug" style="display:none">
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputEmail4">Select Drug</label>
                                        <select class="form-control cmbSelectDrug" name="cmbDrug[]">
                                            {!! $drug_list !!}
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Unit</label>
                                        <div class="input-group mb-4">
                                            <input type="number" min="1" max="100000000" name="drugUnit[]" class="form-control" placeholder="Unit of Drug" aria-label="Unit of Drug">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="icon-container badge badge-pills text-primary">
                                <a href="javascript:void(0)" class="text-primary" id="addDrugItem">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                    Add Drug
                                </a>
                            </div>
                        </div>

                        <div class="form-group mt-5">
                            <label>Upload supporting document(s).</label>
                            <input id="claimDocument" name="claimDocument" type="file" accept="image/jpeg, image/png, image/jpg, application/pdf" class="file form-control" multiple>
                        </div>

                        <div class="form-group row">
                            @foreach($claim_record->clmuploads as $upload)
                            @php
                            $fileExtension = pathinfo($upload->url, PATHINFO_EXTENSION);
                            @endphp
                            @if (in_array($fileExtension, ['jpg', 'jpeg', 'png',]))
                            <div class="col-md-2">
                                <div class="thumbnail">
                                    <img src="{{ asset('uploads/' . $upload->url) }}" alt="Image" class="img-thumbnail">
                                    <p><input type="checkbox" name="remove_files[]" value="{{ $upload->url }}"> Remove</p>
                                </div>
                            </div>
                            @elseif (in_array($fileExtension, ['pdf',]))
                            <div class="col-md-2">
                                <div class="thumbnail">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                                        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="13 2 13 9 20 9"></polyline>
                                    </svg>
                                    <a href="{{ asset('uploads/' . $upload->url) }}" target="_blank" class="text-info" download>{{ $upload->url }}</a>
                                    <p><input type="checkbox" name="remove_files[]" value="{{ $upload->url }}"> Remove</p>
                                </div>
                            </div>
                            @endif

                            @endforeach
                            <div id="thumbnailContainer"></div>
                        </div>

                        <div class="form-group mt-5">
                            <label>Remark</label>
                            <textarea name="remark" class="form-control">{{ $claim_record->comment }}</textarea>
                        </div>
                        <div class="form-group mt-5">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <select class="form-control cmbSelect2" name="cmbHcpClaimMonth">
                                        {!! $hcp_claim_month !!}
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <select class="form-control cmbSelect2" name="cmbHcpClaimYear">
                                        {!! $hcp_claim_year !!}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="frmstatus" name="frmstatus" value="edit">
                        <input type="hidden" id="cmbAuthCode" name="cmbAuthCode" value="{{ $cmbAuthCode }}">
                        <input type="hidden" name="clmref" value="{{ $claim_reference }}">
                        <div class="loader dual-loader mx-auto" style="display:none" id="frmSubmitClaimLoader"></div>
                        <button type="button" name="submitAction" value="submit" class="btn btn-lg btn-primary mt-5 ml-5 float-right btnSaveClaim" id="btnSubmitClaim">Submit Claim</button>
                        <button type="button" name="submitAction" value="draft" class="btn btn-lg btn-info mt-5 float-right btnSaveClaim" id="btnSaveClaimDraft">Save Changes</button>

                    </div>
                    <!--end display encounter form details-->

                </div>
        </div>
    </div>
</div>
</div>
@elseif(strtolower($params['action']) == "vet")
@php
$claim_reference = $params['claim_reference'];
$claim_record = $params['claim_records'];
$claim_uploads = $params['claim_uploads'];
$service_category_list = $params['service_category_list'];
$service_list = $params['service_list'];
$drug_list = $params['drug_list'];
$hcp_claim_month = $params['hcp_claim_month'];
$hcp_claim_year = $params['hcp_claim_year'];
$user_category = strtolower(Auth::user()->accountCategory->code);
$user_role = strtolower(Auth::user()->accountRole->code);
$claim_status = strtolower($claim_record->status);
$state_claim_status = strtolower($claim_record->nurse_officer_status);
$hq_claim_status = strtolower($claim_record->hq_status);
$hod_claim_status = strtolower($claim_record->hod_status);
$rowspan = 3;

$canStateVet = false;
$canHqVet = false;
$canHodVet = false;

if(
$claim_status == "pending" &&
$user_category == "nurse" || $user_category == "managers"
){
$canStateVet = true;
}

if(
$claim_status == "pending" &&
$state_claim_status == "vetted" &&
$user_role == "stf-bcr"
){
$canHqVet = true;
$canStateVet = false;
$canHodVet = false;
$rowspan = 5;
}

if(
$claim_status == "pending" &&
$hq_claim_status == "vetted" &&
$user_role == "hod-bcr"
){
$canHodVet = true;
$canStateVet = false;
$canHqVet = false;
$rowspan = 5;
}
@endphp

<style>
    .my-textarea-width {
        width: 300px;
    }
</style>
<div class="page-header">
    <div class="page-title">
        <h3>Vet Claim for {{ $params['claim_records']->authorization_code->authorization_code }}</h3>
    </div>
</div>
<div class="col-lg-12 layout-spacing">

    @if(count($claim_uploads) > 0)
        <div class="col-xl-12 col-lg-12 col-sm-12 mt-2 layout-spacing">
            <div class="widget-content widget-content-area br-6 p-3">
                <h4 class="mb-3">Supporting Documents</h4>

                @foreach($claim_uploads as $claim_file)
                <a href="{{ asset('uploads/'.$claim_file->url) }}" target="_blank">Supporting Document {{ $loop->iteration }} </a> &nbsp;&nbsp;&nbsp;
                @endforeach
            </div>
        </div>
        @endif

    <div class="row m-3">
        <div class="col-lg-12 text-left">
            <div class="card component-card_4">
                <form name="frmVetClaim" id="frmVetClaim" action="javascript:void(0)" method="post">
                    <div class="card-body">
                        <h5 class="text-left">Services</h5>
                        <div class="table-responsive">
                            <table class="table table-bordere mb-4">
                                <thead>
                                    <tr>
                                        <th rowspan="{{ $rowspan }}" colspan="5">Service</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($claim_record->clmservices AS $service)
                                    @php
                                    //service price
                                    $service_amount = $service->service->amount;
                                    $service_sn = $service->sn;

                                    //hcp total
                                    $hcp_unit = $service->unit;
                                    $hcp_sub_total = $service_amount * $hcp_unit;

                                    //state total
                                    $state_unit = $service->nurse_officer_vetted_unit;
                                    $state_sub_total = $service_amount * $state_unit;

                                    //hq total
                                    $hq_unit = $service->hq_vetted_unit;
                                    $hq_sub_total = $service_amount * $hq_unit;

                                    //hod total
                                    $hod_unit = $service->approved_unit;
                                    $hod_sub_total = $service_amount * $hod_unit;
                                    @endphp

                                    <tr>
                                        <td class="col-4" rowspan="{{ $rowspan }}" amount="{{ $service_amount }}" id="service_name{{ $loop->iteration }}">{{ $service->service->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-2 text-center">Unit</th>
                                        <th class="col-2 text-center">Amount</th>
                                        @if($canStateVet || $canHqVet || $canHodVet)
                                        <th class="col-2 text-center">State Unit</th>
                                        <th class="col-2 text-center">State Amount</th>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ $service->unit }}</td>
                                        <td class="text-center">{{ formatAmount($hcp_sub_total) }}</td>
                                        @if($canStateVet)
                                        <td class="text-center">
                                            <input type="number" class="form-control vetted_unit" cat="service" rel="{{ $loop->iteration }}" name="state_service_vetted_unit[]" />
                                        </td>
                                        <td class="text-center"></td>
                                        <input type="hidden" name="state_service_vetted_sn[]" value="{{ $service_sn }}" />
                                        <input type="hidden" name="state_service_vetted_amount[]" id="service_vetted_amount{{ $loop->iteration }}" value="0" />
                                        @endif
                                        @if($canHqVet || $canHodVet)
                                        <td class="text-center">{{ $state_unit }}</td>
                                        <td class="text-center">{{ formatAmount($state_sub_total) }}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if($canHqVet || $canHodVet)
                                        <th class="col-2 text-center">HQ Unit</th>
                                        <th class="col-2 text-center">HQ Amount</th>
                                        @endif
                                        @if($canHodVet)
                                        <th class="col-2 text-center">HOD Approved Unit</th>
                                        <th class="col-2 text-center">HOD Approved Amount</th>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if($canHqVet)
                                        <td>
                                            <input type="number" class="form-control vetted_unit" cat="service" rel="{{ $loop->iteration }}" name="hq_service_vetted_unit[]" />
                                        </td>
                                        <td class="text-center"></td>
                                        <input type="hidden" name="hq_service_vetted_sn[]" value="{{ $service_sn }}" />
                                        <input type="hidden" name="hq_service_vetted_amount[]" id="service_vetted_amount{{ $loop->iteration }}" value="0" />
                                        @endif
                                        @if($canHodVet)
                                        <td class="text-center">{{ $hq_unit }}</td>
                                        <td class="text-center">{{ formatAmount($hq_sub_total) }}</td>
                                        <td>
                                            <input type="number" class="form-control vetted_unit" cat="service" rel="{{ $loop->iteration }}" name="hod_service_vetted_unit[]" />
                                        </td>
                                        <td class="text-center"></td>
                                        <input type="hidden" name="hod_service_vetted_sn[]" value="{{ $service_sn }}" />
                                        <input type="hidden" name="hod_service_vetted_amount[]" id="service_vetted_amount{{ $loop->iteration }}" value="0" />
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <h5 class="text-left mt-5">Drugs</h5>
                        <div class="table-responsive">
                            <table class="table table-bordere mb-4">
                                <thead>
                                    <tr>
                                        <th rowspan="{{ $rowspan }}" colspan="7">Drug</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($claim_record->clmdrugs AS $drug)
                                    @php
                                    //drug price
                                    $drug_amount = $drug->drug->amount;
                                    $drug_sn = $drug->sn;

                                    //hcp total
                                    $hcp_unit = $drug->unit;
                                    $hcp_sub_total = $drug_amount * $hcp_unit;

                                    //state total
                                    $state_unit = $drug->nurse_officer_vetted_unit;
                                    $state_sub_total = $drug_amount * $state_unit;

                                    //hq total
                                    $hq_unit = $drug->hq_vetted_unit;
                                    $hq_sub_total = $drug_amount * $hq_unit;

                                    //hod total
                                    $hod_unit = $drug->approved_unit;
                                    $hod_sub_total = $drug_amount * $hod_unit;
                                    @endphp

                                    <tr>
                                        <td class="col-4" rowspan="{{ $rowspan }}" amount="{{ $drug_amount }}" id="drug_name{{ $loop->iteration }}">{{ $drug->drug->name }}</td>
                                    </tr>

                                    <tr>
                                        <th class="col-2 text-center">Unit</th>
                                        <th class="col-2 text-center">Amount</th>
                                        @if($canStateVet || $canHqVet || $canHodVet)
                                        <th class="col-2 text-center">State Unit</th>
                                        <th class="col-2 text-center">State Amount</th>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ $drug->unit }}</td>
                                        <td class="text-center">{{ formatAmount($hcp_sub_total) }}</td>
                                        <!-- <td class="text-center">{{ $state_unit }}</td>
                                        <td class="text-center">{{ formatAmount($state_sub_total) }}</td> -->
                                        <!-- allow state office vet claim -->
                                        @if($canStateVet)
                                        <td>
                                            <input type="number" class="form-control vetted_unit" cat="drug" rel="{{ $loop->iteration }}" name="state_drug_vetted_unit[]" />
                                        </td>
                                        <td class="text-center"></td>
                                        <input type="hidden" name="state_drug_vetted_sn[]" value="{{ $drug_sn }}" />
                                        <input type="hidden" name="state_drug_vetted_amount[]" id="drug_vetted_amount{{ $loop->iteration }}" value="0" />
                                        @endif
                                        @if($canHqVet || $canHodVet)
                                        <td class="text-center">{{ $state_unit }}</td>
                                        <td class="text-center">{{ formatAmount($state_sub_total) }}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if($canHqVet || $canHodVet)
                                        <th class="col-2 text-center">HQ Unit</th>
                                        <th class="col-2 text-center">HQ Amount</th>
                                        @endif
                                        @if($canHodVet)
                                        <th class="col-2 text-center">HOD Approved Unit</th>
                                        <th class="col-2 text-center">HOD Approved Amount</th>
                                        @endif
                                    </tr>
                                    <tr>
                                        <!-- allow hq vet claim -->
                                        @if($canHqVet)
                                        <td>
                                            <input type="number" class="form-control vetted_unit" cat="drug" rel="{{ $loop->iteration }}" name="hq_drug_vetted_unit[]" />
                                        </td>
                                        <td class="text-center"></td>
                                        <input type="hidden" name="hq_drug_vetted_sn[]" value="{{ $drug_sn }}" />
                                        <input type="hidden" name="hq_drug_vetted_amount[]" id="drug_vetted_amount{{ $loop->iteration }}" value="0" />
                                        @endif
                                        <!-- allow hod vet claim -->
                                        @if($canHodVet)
                                        <td class="text-center">{{ $hq_unit }}</td>
                                        <td class="text-center">{{ formatAmount($hq_sub_total) }}</td>
                                        <td>
                                            <input type="number" class="form-control vetted_unit" cat="drug" rel="{{ $loop->iteration }}" name="hod_drug_vetted_unit[]" />
                                        </td>
                                        <td class="text-center"></td>
                                        <input type="hidden" name="hod_drug_vetted_sn[]" value="{{ $drug_sn }}" />
                                        <input type="hidden" name="hod_drug_vetted_amount[]" id="drug_vetted_amount{{ $loop->iteration }}" value="0" />
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <h6 class="text-left mt-5">HCP Remark</h6>
                        <blockquote class="blockquote media-object text-left">
                            <div class="media">
                                <div class="media-body align-self-center">
                                    <p class="d-inline text-dark">{{ $claim_record->comment }}</p>
                                </div>
                            </div>
                        </blockquote>

                        @if($canStateVet)
                        <input type="hidden" name="state_vet_route" id="state_vet_route" value="{{ route('so-claim.update') }}" />
                        <h6 class="text-left mt-5">State Remark</h6>
                        <textarea class="form-control" name="state_remark"></textarea>
                        <div class="mt-1 p-1 text-right">
                            <button type="submit" class="btn btn-lg btn-success mr-5 btnStateVetAction" id="btnStateApprove" value="approve">Submit</button>
                            <button type="submit" class="btn btn-lg btn-danger mr-5 btnStateVetAction" id="btnStateDecline" value="decline">Decline</button>
                        </div>
                        @endif

                        @if($canHqVet)
                        <input type="hidden" name="hq_vet_route" id="hq_vet_route" value="{{ route('bcr-claim.update') }}" />
                        <h6 class="text-left mt-5">State Office Remark</h6>
                        <blockquote class="blockquote media-object text-left">
                            <div class="media">
                                <div class="media-body align-self-center">
                                    <p class="d-inline text-dark">{{ $claim_record->nurse_officer_remark }}</p>
                                </div>
                            </div>
                        </blockquote>

                        <h6 class="text-left mt-4">HQ Remark</h6>
                        <textarea class="form-control" name="hq_remark"></textarea>
                        <div class="mt-1 p-1 text-right">
                            <button type="submit" class="btn btn-lg btn-success mr-5 btnHqVetAction" id="btnHqApprove" value="approve">Submit</button>
                            <button type="submit" class="btn btn-lg btn-danger mr-5 btnHqVetAction" id="btnHqDecline" value="decline">Decline</button>
                        </div>
                        @endif

                        @if($canHodVet)
                        <input type="hidden" name="hod_vet_route" id="hod_vet_route" value="{{ route('bcr-hod-claim.update') }}" />
                        <h6 class="text-left mt-5">State Office Remark</h6>
                        <blockquote class="blockquote media-object text-left">
                            <div class="media">
                                <div class="media-body align-self-center">
                                    <p class="d-inline text-dark">{{ $claim_record->nurse_officer_remark }}</p>
                                </div>
                            </div>
                        </blockquote>

                        <h6 class="text-left mt-5">HQ Remark</h6>
                        <blockquote class="blockquote media-object text-left">
                            <div class="media">
                                <div class="media-body align-self-center">
                                    <p class="d-inline text-dark">{{ $claim_record->hq_remark }}</p>
                                </div>
                            </div>
                        </blockquote>

                        <h6 class="text-left mt-4">HOD Remark</h6>
                        <textarea class="form-control" name="hod_remark"></textarea>
                        <div class="mt-1 p-1 text-right">
                            <button type="submit" class="btn btn-lg btn-success mr-5 btnHodVetAction" id="btnHodApprove" value="approve">Approve</button>
                            <button type="submit" class="btn btn-lg btn-danger mr-5 btnHodVetAction" id="btnHodDecline" value="decline">Decline</button>
                        </div>

                        @endif

                        <input type="hidden" name="claim_ref" value="{{ $claim_reference }}" />
                        <input type="hidden" name="vet_status" id="vet_status" value="decline" />

                        @if($canStateVet || $canHqVet || $canHodVet)
                        <!--<button type="submit" class="btn btn-lg btn-primary mt-5 ml-5 float-right">Submit Claim</button>
                                    <button type="submit" class="btn btn-lg btn-info mt-5 float-right">Save Changes</button> -->
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@else

@php
$service_category_list = $params['service_category_list'];
$service_list = $params['service_list'];
$drug_list = $params['drug_list'];
$hcp_claim_month = $params['hcp_claim_month'];
$hcp_claim_year = $params['hcp_claim_year'];
$user_category = strtolower(Auth::user()->accountCategory->code);
@endphp

<div class="page-header">
    <div class="page-title">
        <h3>Make Claim</h3>
    </div>
</div>
<div class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-content widget-content-area">
            <form name="frmSubmitClaim" id="frmSubmitClaim" action="{{ route('claim.save') }}" enctype="multipart/form-data" method="post">
                <div class=" row m-3">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="form-row mb-2">
                            <label for="inputEmail4">Select Authorization Code</label>
                            <select class="form-control cmbSelect2 cmbAuthCode" name="cmbAuthCode" id="cmbAuthCode">
                                {{!! $params['auth_code_list'] !!}}
                            </select>
                        </div>
                    </div>

                    <!--display enrollee profile summary-->
                    <div class="col-xl-12 col-lg-12 col-sm-12 mt-2 layout-spacing">
                        <div class="widget-content widget-content-area br-6" id="authCodeRecordContainer">
                        </div>
                    </div>
                    <!--end display enrollee profile summary-->

                    <!--display encounter form details-->
                    <div class="col-xl-12 col-lg-12 col-sm-12 mt-2 layout-spacing">
                        <div id="displayServiceArena">
                            <h5>Add Service(s)</h5>
                            <div class="duplicateService" id="duplicateService">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Select Service Category</label>
                                        <select class="form-control cmbSelectServiceCategory" name="cmbSelectServiceCategory[]">
                                            {{!! $params['service_category_list'] !!}}
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Select Service</label>
                                        <select class="form-control cmbSelectService" name="cmbSelectService[]">
                                            <option value="-1" selected="selected">Select Service</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Unit</label>
                                        <div class="input-group mb-4">
                                            <input type="number" min="1" max="100000000" name="serviceUnit[]" class="form-control" placeholder="Unit of Service" aria-label="Unit of Service">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="icon-container badge badge-pills text-primary">
                                <a href="javascript:void(0)" class="text-primary" id="addServiceItem">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                    Add Service
                                </a>
                            </div>
                        </div>
                        <div id="displayDrugArena" class="mt-5">
                            <h5>Add Drug(s)</h5>
                            <div class="duplicateDrug" id="duplicateDrug">
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputEmail4">Select Drug</label>
                                        <select class="form-control cmbSelectDrug" name="cmbDrug[]">
                                            {{!! $params['drug_list'] !!}}
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Unit</label>
                                        <div class="input-group mb-4">
                                            <input type="number" min="1" max="100000000" name="drugUnit[]" class="form-control drugUnit" placeholder="Unit of Drug" aria-label="Unit of Drug">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="icon-container badge badge-pills text-primary">
                                <a href="javascript:void(0)" class="text-primary" id="addDrugItem">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                    Add Drug
                                </a>
                            </div>
                        </div>

                        <div class="form-group mt-5">
                            <label>Upload supporting document(s).</label>
                            <input type="file" id="claimDocument" name="claimDocument" accept="image/jpeg, image/png, image/jpg, application/pdf" class="form-control" multiple>
                        </div>

                        <div class="form-group mt-5">
                            <label>Remark</label>
                            <textarea name="remark" class="form-control"></textarea>
                        </div>
                        <div class="form-group mt-5">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <select class="form-control cmbSelect2" name="cmbHcpClaimMonth">
                                        {!! $hcp_claim_month !!}
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <select class="form-control cmbSelect2" name="cmbHcpClaimYear">
                                        {!! $hcp_claim_year !!}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="frmstatus" name="frmstatus" value="draft">
                        <div class="loader dual-loader mx-auto" style="display:none" id="frmSubmitClaimLoader"></div>
                        <button type="button" name="submitAction" value="submit" class="btn btn-lg btn-primary mt-5 ml-5 float-right btnSaveClaim" id="btnSubmitClaim">Submit Claim</button>
                        <button type="button" name="submitAction" value="draft" class="btn btn-lg btn-info mt-5 float-right btnSaveClaim" id="btnSaveClaimDraft">Save as Draft</button>

                    </div>
                    <!--end display encounter form details-->
                </div>
            </form>
        </div>
    </div>
</div>

<div class="page-header">
    <div class="page-title">
        <h3>List of Approved Authorization Code</h3>
    </div>
</div>

<div class="row" id="cancel-row">

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">

            <table class="table table-hover non-hover myDataTable" style="width:100%">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Authorization Code </th>
                        @if($user_category == "cc")
                        <th>Date Requested</th>
                        <th>Status</th>
                        @endif
                        <th>Service</th>
                        <th>Recieving HCP</th>
                        <th class=" dt-no-sorting">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($params['authorization_codes_records'] as $authorization_code_data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $authorization_code_data->authorization_code }} </td>
                        <td>{{ $authorization_code_data->investigation->name ?? '' }} / {{ $authorization_code_data->drug->name ?? '' }}</td>
                        <td>{{ $authorization_code_data->receiving_hcp->hcp_name }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#enrolleeViewModal{{ $loop->iteration }}">
                                    View
                                </button>
                                @php $enrollee = $authorization_code_data->encounter->enrollee; @endphp

                                <x-modal class="modal-xl" title="Enrollee Profile" modalid="enrolleeViewModal{{$loop->iteration}}">
                                    <x-slot name="modal_body">
                                        <div class="row">
                                            <div class="col-lg-2 col-12 text-center">
                                                <img src="{{ $enrollee->photograph ? $enrollee->photograph : asset('@assets/img/avatar2.png') }}" alt="{{$enrollee->surname}}" style="width:100%">
                                                <br /><br />
                                                <label class="custom-label">ID Number</label>
                                                <h6 class="custom-h6">{{ $enrollee->id_number }}</h6>
                                            </div>
                                            <div class="col-lg-10 col-12">
                                                <h5>Personal Data</h5>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">Scheme</label>
                                                        <h6 class="custom-h6">{{ $enrollee->scheme?->scheme_name }}</h6>
                                                    </div>
                                                    @if (isset($enrollee->service_number) && $enrollee->service_number !== null)
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">Service Number</label>
                                                        <h6 class="custom-h6" id="snDisplayed{{$loop->iteration}}">{{ $enrollee->service_number ?? 'N/A' }}</h6>
                                                    </div>
                                                    @endif

                                                    @if (isset($enrollee->staff?->staff_id) && $enrollee->staff?->staff_id !== null)
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">Staff Number</label>
                                                        <h6 class="custom-h6" id="snDisplayed{{$loop->iteration}}">{{ $enrollee->staff?->staff_id ?? 'N/A' }}</h6>
                                                    </div>
                                                    @endif

                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">Surname</label>
                                                        <h6 class="custom-h6">{{ $enrollee->surname }}</h6>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">First Name</label>
                                                        <h6 class="custom-h6">{{ $enrollee->first_name }}</h6>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">Middle Name</label>
                                                        <h6 class="custom-h6">{{ $enrollee->middle_name }}</h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">Relationship</label>
                                                        <h6 class="custom-h6">{{ ucfirst($enrollee->relationship) }}</h6>
                                                    </div>
                                                    @if (isset($enrollee->service_number) && $enrollee->service_number !== null)
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">Arms of Service</label>
                                                        <h6 class="custom-h6">{{ $enrollee->arm_of_service?->service_name?? 'N/A' }}</h6>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">Rank</label>
                                                        <h6 class="custom-h6">{{ $enrollee->rank?->rank?? 'N/A' }}</h6>
                                                    </div>
                                                    @endif

                                                    @if (isset($enrollee->staff?->staff_id) && $enrollee->staff?->staff_id !== null)
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">Designation</label>
                                                        <h6 class="custom-h6">{{ $enrollee->designation?->designation?? 'N/A' }}</h6>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">Department</label>
                                                        <h6 class="custom-h6">{{ $enrollee->staff_department?->department_name?? 'N/A' }}</h6>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">Employer</label>
                                                        <h6 class="custom-h6">{{ $enrollee->employer?? 'N/A' }}</h6>
                                                    </div>
                                                    @endif
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">Date of Birth</label>
                                                        <h6 class="custom-h6">{{ $enrollee->date_of_birth }}</h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">Gender</label>
                                                        <h6 class="custom-h6">{{ getValueByKey(genderOptions(), $enrollee->gender) }}</h6>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">Marital Status</label>
                                                        <h6 class="custom-h6">{{ getValueByKey(maritalStatusOptions(), $enrollee->marital_status) }}</h6>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">ID Card Type</label>
                                                        <h6 class="custom-h6">{{ getValueByKey(idTypeOptions(), $enrollee->identity_type) }}</h6>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">ID Card Number</label>
                                                        <h6 class="custom-h6">{{ $enrollee->identity_number }}</h6>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">Deceased</label>
                                                        <h6 class="custom-h6">{{ $enrollee->is_deceased == 'Y' ? 'Yes' : 'No' }}</h6>
                                                    </div>
                                                </div>
                                                <hr />
                                                <h5>Contact Data</h5>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">Phone Number</label>
                                                        <h6 class="custom-h6">{{ $enrollee->phone }}</h6>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-12">
                                                        <label class="custom-label">Email</label>
                                                        <h6 class="custom-h6" style="word-wrap: break-word;">{{ $enrollee->email }}</h6>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">State</label>
                                                        <h6 class="custom-h6">{{ $enrollee->state_of_residence?->state_name }}</h6>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-12">
                                                        <label class="custom-label">LGA</label>
                                                        <h6 class="custom-h6">{{ $enrollee->lga_of_residence?->lga_name }}</h6>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="custom-label">Address</label>
                                                        <h6 class="custom-h6">{{ $enrollee->residential_address }}</h6>
                                                    </div>
                                                </div>
                                                <hr />
                                                <h5>Healthcare Data</h5>
                                                <div class="row">
                                                    <div class="col-8">
                                                        <label class="custom-label">Primary HCP</label>
                                                        <h6 class="custom-h6">{{ $enrollee->hcp?->hcp_name }}</h6>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">Code No</label>
                                                        <h6 class="custom-h6">{{ $enrollee->hcp?->hcp_code }}</h6>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <label class="custom-label">Blood Group</label>
                                                        <h6 class="custom-h6">{{ $enrollee->blood_group?->blood_group }}</h6>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="custom-label">Medical History</label>
                                                        <h6 class="custom-h6">
                                                            {{ $enrollee->medical_history ?? 'N/A' }}
                                                        </h6>
                                                    </div>
                                                </div>
                                                <hr />
                                                <h5>Request Details</h5>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="custom-label">Referral HCP</label>
                                                        <h6 class="custom-h6">{{ $authorization_code_data->referral_hcp->hcp_name }}</h6>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="custom-label">Receiving HCP</label>
                                                        <h6 class="custom-h6">{{ $authorization_code_data->receiving_hcp->hcp_name }}</h6>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="custom-label">Service</label>
                                                        <h6 class="custom-h6">{{ $authorization_code_data->investigation->name ?? '' }}</h6>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="custom-label">HMO Remark</label>
                                                        <h6 class="custom-h6">
                                                            {{ $authorization_code_data->hmo_remark ?? '' }}
                                                        </h6>
                                                    </div>
                                                </div>
                                                <hr />
                                            </div>
                                        </div>
                                    </x-slot>
                                    <x-slot name="modal_footer">
                                    </x-slot>
                                </x-modal>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>

@endif