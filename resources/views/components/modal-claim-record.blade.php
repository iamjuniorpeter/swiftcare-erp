@props(['params'])

<!-- Modal -->
<div class="modal fade" id="viewClaimRecordModal{{ $params['modal_id'] }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Claim Record for {{ $params['modal_title'] }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <!--display enrollee profile summary-->
                <div class="col-xl-12 col-lg-12 col-sm-12 mt-2 layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <x-view-enrollee-profile-summary 
                            :display="'profile'" 
                            :modal_id="$params['modal_title']"
                            :modal_title="$params['modal_title']"
                            :enrollee_records="$params['enrollee_records']" />
                    </div>
                </div>
                <!--end display enrollee profile summary-->

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
                                            <tr>
                                                <td>Shaun</td>
                                                <td>10/08/2020</td>
                                                <td>320</td>
                                                <td class="text-center">150,000</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <h5 class="text-left mt-2">Drugs</h5>
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
                                            <tr>
                                                <td>Shaun</td>
                                                <td>10/08/2020</td>
                                                <td>320</td>
                                                <td class="text-center">150,000</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row p-4">
                    <div class="col-lg-12 text-left">
                        <div class="card component-card_4">
                            <div class="card-body">
                                <h4 class="mb-3">Vetted Claims</h4>
                                <h5 class="text-left">Services</h5>
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
                                            <tr>
                                                <td>Shaun</td>
                                                <td>320</td>
                                                <td class="text-center">150,000</td>
                                            </tr>
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
                                            <tr>
                                                <td>Shaun</td>
                                                <td>320</td>
                                                <td class="text-center">150,000</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mb-2 mr-2" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>