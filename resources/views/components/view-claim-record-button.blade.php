@props(['params'])
@php
$claim_record = $params['claim_records'];
$services_records = $params['services_records'];
$drugs_records = $params['drugs_records'];
$clmstatus = $params['claim_status'];
$claim_files = $params['claim_files'];
$user_category = strtolower($params['user_category']) ?? NULL;

$canStateVet = false;
$canHqVet = false;
$canHodVet = false;

if($user_category == "nurse" || $user_category == "managers"){
$canStateVet = true;
}

if($user_category == "bcr"){
$canHqVet = true;
}

if($user_category == "hod"){
$canHodVet = true;
}
@endphp


<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#viewClaimRecordModal{{ $params['modal_id'] }}">
    View
</button>

<x-modal class="modal-xl" title="Claim Record for {{ $params['modal_title'] }} " modalid="viewClaimRecordModal{{ $params['modal_id'] }}">
    <x-slot name="modal_body">

        <!--display enrollee profile summary-->
        <div class="col-xl-12 col-lg-12 col-sm-12 mt-2 layout-spacing">
            <div class="widget-content widget-content-area br-6">

                <x-view-authorization-code-summary :records="$claim_record" />

            </div>
        </div>
        <!--end display enrollee profile summary-->

        @if(count($claim_files) > 0)
        <div class="col-xl-12 col-lg-12 col-sm-12 mt-2 layout-spacing">
            <div class="widget-content widget-content-area br-6 p-3">
                <h4 class="mb-3">Supporting Documents</h4>

                @foreach($claim_files as $claim_file)
                <a href="{{ asset('uploads/'.$claim_file->url) }}" target="_blank">Supporting Document {{ $loop->iteration }} </a> &nbsp;&nbsp;&nbsp;
                @endforeach
            </div>
        </div>
        @endif

        <div class="row p-4">
            <div class="col-lg-12 text-left">

                <div class="card component-card_4">
                    <div class="card-body">
                        <h4 class="mb-3">Original Claims</h4>
                        <h5 class="text-left">Services</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4">
                                <thead>
                                    <tr>
                                        <th>Service Category</th>
                                        <th>Service Name</th>
                                        <th>Unit</th>
                                        <th class="text-center">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services_records as $claim_service)
                                    <tr>
                                        <td>{{ $claim_service->service_category->category_name ?? '' }}</td>
                                        <td>{{ $claim_service->service->name ?? '' }}</td>
                                        <td>{{ $claim_service->unit ?? '' }}</td>
                                        <td class="text-center">{{ $claim_service->billed_amount ?? '' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <h5 class="text-left mt-2">Drugs</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4">
                                <thead>
                                    <tr>
                                        <th>Drug Name</th>
                                        <th>Unit</th>
                                        <th class="text-center">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($drugs_records as $claim_drug)
                                    <tr>
                                        <td>{{ $claim_drug->drug->name ?? '' }}</td>
                                        <td>{{ $claim_drug->unit ?? '' }}</td>
                                        <td class="text-center">{{ $claim_drug->billed_amount ?? '' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!--state office vetted claims-->
        @if($canStateVet || $canHqVet)
        <div class="row p-4">
            <div class="col-lg-12 text-left">
                <div class="card component-card_4">
                    <div class="card-body">
                        <h4 class="mb-3">State Office Vetted Claims</h4>
                        <h5 class="text-left">Services</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4">
                                <thead>
                                    <tr>
                                        <th>Service Category</th>
                                        <th>Service Name</th>
                                        <th>Unit</th>
                                        <th class="text-center">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services_records as $claim_service)
                                    <tr>
                                        <td>{{ $claim_service->service_category->category_name ?? '' }}</td>
                                        <td>{{ $claim_service->service->name ?? '' }}</td>
                                        <td>{{ $claim_service->nurse_officer_vetted_unit ?? '' }}</td>
                                        <td class="text-center">{{ $claim_service->nurse_officer_vetted_amount ?? '' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <h5 class="text-left mt-2">Drugs</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4">
                                <thead>
                                    <tr>
                                        <th>Drug Name</th>
                                        <th>Unit</th>
                                        <th class="text-center">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($drugs_records as $claim_drug)
                                    <tr>
                                        <td>{{ $claim_drug->drug->name ?? '' }}</td>
                                        <td>{{ $claim_drug->nurse_officer_vetted_unit ?? '' }}</td>
                                        <td class="text-center">{{ $claim_drug->nurse_officer_vetted_amount ?? '' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endif

        <!--hq vetted claims-->
        @if($canHqVet || $canHodVet)
        <div class="row p-4">
            <div class="col-lg-12 text-left">
                <div class="card component-card_4">
                    <div class="card-body">
                        <h4 class="mb-3">HQ Vetted Claims</h4>
                        <h5 class="text-left">Services</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4">
                                <thead>
                                    <tr>
                                        <th>Service Category</th>
                                        <th>Service Name</th>
                                        <th>Unit</th>
                                        <th class="text-center">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services_records as $claim_service)
                                    <tr>
                                        <td>{{ $claim_service->service_category->category_name ?? '' }}</td>
                                        <td>{{ $claim_service->service->name ?? '' }}</td>
                                        <td>{{ $claim_service->hq_vetted_unit ?? '' }}</td>
                                        <td class="text-center">{{ $claim_service->hq_vetted_amount ?? '' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <h5 class="text-left mt-2">Drugs</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4">
                                <thead>
                                    <tr>
                                        <th>Drug Name</th>
                                        <th>Unit</th>
                                        <th class="text-center">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($drugs_records as $claim_drug)
                                    <tr>
                                        <td>{{ $claim_drug->drug->name ?? '' }}</td>
                                        <td>{{ $claim_drug->hq_vetted_unit ?? '' }}</td>
                                        <td class="text-center">{{ $claim_drug->hq_vetted_amount ?? '' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endif

        <!--hod vetted claims-->
        @if($canHodVet)
        <div class="row p-4">
            <div class="col-lg-12 text-left">
                <div class="card component-card_4">
                    <div class="card-body">
                        <h4 class="mb-3">HOD Approved Claims</h4>
                        <h5 class="text-left">Services</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4">
                                <thead>
                                    <tr>
                                        <th>Service Category</th>
                                        <th>Service Name</th>
                                        <th>Unit</th>
                                        <th class="text-center">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services_records as $claim_service)
                                    <tr>
                                        <td>{{ $claim_service->service_category->category_name ?? '' }}</td>
                                        <td>{{ $claim_service->service->name ?? '' }}</td>
                                        <td>{{ $claim_service->approved_unit ?? '' }}</td>
                                        <td class="text-center">{{ $claim_service->approved_amount ?? '' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <h5 class="text-left mt-2">Drugs</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4">
                                <thead>
                                    <tr>
                                        <th>Drug Name</th>
                                        <th>Unit</th>
                                        <th class="text-center">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($drugs_records as $claim_drug)
                                    <tr>
                                        <td>{{ $claim_drug->drug->name ?? '' }}</td>
                                        <td>{{ $claim_drug->approved_unit ?? '' }}</td>
                                        <td class="text-center">{{ $claim_drug->approved_amount ?? '' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endif


    </x-slot>
    <x-slot name="modal_footer">
    </x-slot>
</x-modal>