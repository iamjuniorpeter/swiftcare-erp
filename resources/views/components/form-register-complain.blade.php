@props(['params'])

@if(strtolower($params['action']) == "edit")

<!-- redirect user to view closed records -->
@if($params['complain_records']->status == 'closed')
    @php
        header("Location: " . route('complains.view', 'closed'));
        exit;
    @endphp
@endif

<div class="page-header">
    <div class="page-title">
        <h3>Update Complain</h3>
    </div>
</div>
<div class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-content widget-content-area">
            <div class=" row m-3">
                <div class="col-xl-8 col-lg-8 col-sm-12  layout-spacing">
                    <form action="{{ route('complains.update') }}" id="frmComplainQuery" name="frmComplainQuery" method="post">
                        <div class="form-row">
                            <div class="form-group mb-2 col-md-6">
                                <label for="inputEmail4">Select Complain Category</label>
                                <select class="form-control" name="cmbComplainCategory" readonly>
                                    {{!! $params['complain_category_list'] !!}}
                                </select>
                            </div>
                            <div class="form-group mb-2 col-md-6">
                                <label for="inputEmail4">Select Complain Type</label>
                                <select class="form-control" name="cmbComplainType" readonly>
                                    {{!! $params['complain_type_list'] !!}}
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Complain</label>
                                <div class="input-group mb-4">
                                    <textarea rows="3" @if(strlen($params['complain_records']->complain)> 3) readonly @endif name="complain" class="form-control" placeholder="Complain" aria-label="Complain">{{ $params['complain_records']->complain }}</textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Resolution</label>
                                <div class="input-group mb-4">
                                    <textarea rows="3" @if(strlen($params['complain_records']->resolution)> 3) readonly @endif name="resolution" class="form-control" placeholder="Resolution" aria-label="Resolution">{{ $params['complain_records']->resolution }}</textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Outcome</label>
                                <div class="input-group mb-4">
                                    <textarea rows="3" @if(strlen($params['complain_records']->outcome)> 3) readonly @endif name="outcome" class="form-control" placeholder="Outcome" aria-label="Outcome">{{ $params['complain_records']->outcome }}</textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Remark</label>
                                <div class="input-group mb-4">
                                    <textarea rows="4" name="remark" class="form-control" placeholder="Remark" aria-label="Remark"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="form-group col-md-6 p-2">
                                <button type="button" class="btn btn-success" id="btnMarkComplainAsClosed">Mark as Closed</button>
                            </div>
                            <div class="form-group col-md-6 text-right p-2">
                                <div class="field-wrapper">
                                    <input type="hidden" name="complain_reference" value="{{ $params['complain_records']->reference }}" />
                                    <input type="hidden" name="action" value="update" />
                                    <div class="loader dual-loader mx-auto" style="display:none" id="frmComplainQueryLoader"></div>
                                    <button type="button" class="btn btn-primary" id="btnSaveComplainQuery">Save Query</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xl-4 col-lg-4 col-sm-12">
                    <h5>Remarks History</h5>

                    @foreach($params['complain_records']->remarks as $remark)
                    <blockquote class="blockquote media-object text-left">
                        <div class="media">
                            <div class="media-body align-self-center">
                                <p class="d-inline text-dark">
                                    {{ $remark->remark }}
                                </p>
                            </div>
                        </div>
                    </blockquote>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>

@else

<div class="page-header">
    <div class="page-title">
        <h3>Register Complain</h3>
    </div>
</div>
<div class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-content widget-content-area">
            <div class=" row m-3">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <form action="{{ route('complains.save') }}" id="frmComplainQuery" name="frmComplainQuery" method="post">
                        <div class="form-row">
                            <div class="form-group mb-2 col-md-6">
                                <label for="inputEmail4">Select Complain Category</label>
                                <select class="form-control cmbSelect2" name="cmbComplainCategory" id="cmbCCategory">
                                    {{!! $params['complain_category_list'] !!}}
                                </select>
                            </div>
                            <div class="form-group mb-2 col-md-6">
                                <label for="inputEmail4">Select Complain Type</label>
                                <select class="form-control cmbSelect2" name="cmbComplainType">
                                    {{!! $params['complain_type_list'] !!}}
                                </select>
                            </div>
                        </div>
                        <div class="form-row d-non optional" id="dispHcp">
                            <div class="form-group mb-2 col-md-12">
                                <label for="inputEmail4">Select HCP</label>
                                <select class="form-control cmbSelect2" name="cmbHcp">
                                    {{!! $params['hcp_list'] !!}}
                                </select>
                            </div>
                        </div>
                        <div class="form-row d-non optional" id="dispEnrollee">
                            <div class="form-group mb-2 col-md-12">
                                <label for="inputEmail4">Select Enrollee</label>
                                <select class="form-control cmbSelect2" name="cmbEnrollee">
                                    {{!! $params['enrollee_list'] !!}}
                                </select>
                            </div>
                        </div>
                        <div class="form-row d-non optional" id="dispState">
                            <div class="form-group mb-2 col-md-12">
                                <label for="inputEmail4">Select State</label>
                                <select class="form-control cmbSelect2" name="cmbState">
                                    {{!! $params['state_list'] !!}}
                                </select>
                            </div>
                        </div>
                        <div class="form-row mb-3 optional" id="dispDrp">
                            <div class="form-group mb-2 col-md-4">
                                <label for="inputEmail4">Name</label>
                                <input class="form-control" name="name" />
                            </div>
                            <div class="form-group mb-2 col-md-4">
                                <label for="inputEmail4">Email Address</label>
                                <input class="form-control" name="email" />
                            </div>
                            <div class="form-group mb-2 col-md-4">
                                <label for="inputEmail4">Phone Number</label>
                                <input class="form-control" name="phone" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Complain</label>
                                <div class="input-group mb-4">
                                    <textarea rows="4" name="complain" class="form-control" placeholder="Complain" aria-label="Complain"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Resolution</label>
                                <div class="input-group mb-4">
                                    <textarea rows="4" name="resolution" class="form-control" placeholder="Resolution" aria-label="Resolution"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Outcome</label>
                                <div class="input-group mb-4">
                                    <textarea rows="4" name="outcome" class="form-control" placeholder="Outcome" aria-label="Outcome"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Remark</label>
                                <div class="input-group mb-4">
                                    <textarea rows="2" name="remark" class="form-control" placeholder="Remark" aria-label="Remark"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="form-group col-md-6 p-2">
                                <button type="button" class="btn btn-success" id="btnMarkComplainAsClosed">Mark as Closed</button>
                            </div>
                            <div class="form-group col-md-6 text-right p-2">
                                <div class="field-wrapper">
                                    <div class="loader dual-loader mx-auto" style="display:none" id="frmComplainQueryLoader"></div>
                                    <button type="button" class="btn btn-primary" id="btnSaveComplainQuery">Save Query</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endif