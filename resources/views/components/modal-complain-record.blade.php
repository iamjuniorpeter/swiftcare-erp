@props(['params'])

<!-- Modal -->
<div class="modal fade" id="viewComplainRecordModal{{ $params['modal_id'] }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Complain Record for {{ $params['modal_title'] }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body">

                <div class="col-xl-12 col-lg-12 col-sm-12 mt-2 layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <div class="row p-4">
                            <div class="col-lg-12 text-center">
                                <div class="form-row">
                                    <div class="form-group mb-2 col-md-6">
                                        <h6 class="mt-2 font-weight-bold">Complain Type: </h6>
                                        <p class="text-dark">{{ $params['complain_records']['type'] ?? '' }}</p>
                                    </div>
                                    <div class="form-group mb-2 col-md-6">
                                        <h6 class="mt-2 font-weight-bold">Complain Category: </h6>
                                        <p class="text-dark">{{ $params['complain_records']['category'] ?? '' }}</p>
                                    </div>
                                </div>
                                <div class="form-row mt-5">
                                    <div class="form-group mb-2 col-md-4">
                                        <h6 class="mt-2 font-weight-bold">Complain </h6>
                                        <p class="text-dark">{{ $params['complain_records']['complain'] ?? '' }}</p>
                                    </div>
                                    <div class="form-group mb-2 col-md-4">
                                        <h6 class="mt-2 font-weight-bold">Resolution </h6>
                                        <p class="text-dark">{{ $params['complain_records']['resolution'] ?? '' }}</p>
                                    </div>
                                    <div class="form-group mb-2 col-md-4">
                                        <h6 class="mt-2 font-weight-bold">Outcome </h6>
                                        <p class="text-dark">{{ $params['complain_records']['outcome'] ?? '' }}</p>
                                    </div>
                                </div>
                                <div class="form-row mt-5">
                                    <div class="form-group mb-2 col-md-12">
                                        <h6 class="font-weight-bold">Remarks </h6>
                                        @foreach($params['complain_records']['remarks'] as $remark)
                                        <blockquote class="blockquote media-object text-left">
                                            <div class="media">
                                                <div class="media-body align-self-center">
                                                    <p class="d-inline text-dark">
                                                        {{ $remark }}
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
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mb-2 mr-2" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>