@props(['params'])

<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#viewComplainRecordModal{{ $params['modal_id'] }}">
    View
</button>

<x-modal class="modal-xl" title="Complain Record for {{ $params['modal_title'] }} " modalid="viewComplainRecordModal{{ $params['modal_id'] }}">
    <x-slot name="modal_body">
        <div class="col-xl-12 col-lg-12 col-sm-12 mt-2 layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="row p-4">
                    <div class="col-lg-12 text-center">
                        <div class="form-row">
                            <div class="form-group mb-2 col-md-6">
                                <h6 class="mt-2 font-weight-bold">Complain Type: </h6>
                                <p class="text-dark">{{ $params['complain_records']->type_of_complain->name ?? '' }}</p>
                            </div>
                            <div class="form-group mb-2 col-md-6">
                                <h6 class="mt-2 font-weight-bold">Complain Category: </h6>
                                <p class="text-dark">{{ $params['complain_records']->category_of_complain->name ?? '' }}</p>
                            </div>
                        </div>
                        <div class="form-row mt-4">
                            @if($params['complain_records']->complain_categoryID == '1')
                                <div class="form-group mb-2 col-md-12">
                                    <h6 class="mt-2 font-weight-bold">HCP Name: </h6>
                                    <p class="text-dark">{{ $params['complain_records']->hcp_of_complain->hcp_name ?? '' }}</p>
                                </div>
                            @endif

                            @if($params['complain_records']->complain_categoryID == '2')
                                <div class="form-group mb-2 col-md-12">
                                    <h6 class="mt-2 font-weight-bold">State Name: </h6>
                                    <p class="text-dark">{{ $params['complain_records']->state_of_complain->state_name ?? '' }}</p>
                                </div>
                            @endif

                            @if($params['complain_records']->complain_categoryID == '3')
                                <div class="form-group mb-2 col-md-4">
                                    <h6 class="mt-2 font-weight-bold">Enrollee ID Number: </h6>
                                    <p class="text-dark">{{ $params['complain_records']->enrollee_complain->id_number ?? '' }}</p>
                                </div>
                                <div class="form-group mb-2 col-md-4">
                                    <h6 class="mt-2 font-weight-bold">Enrollee Name: </h6>
                                    <p class="text-dark">{{ $params['complain_records']->enrollee_complain->surname.' '. $params['complain_records']->enrollee_complain->first_name.' '. $params['complain_records']->enrollee_complain->middle_name ?? '' }}</p>
                                </div>
                                <div class="form-group mb-2 col-md-4">
                                    <h6 class="mt-2 font-weight-bold">Enrollee Programme: </h6>
                                    <p class="text-dark">{{ $params['complain_records']->enrollee_complain->programme ?? '' }}</p>
                                </div>
                            @endif

                            @if($params['complain_records']->complain_categoryID == '4')
                                <div class="form-group mb-2 col-md-4">
                                    <h6 class="mt-2 font-weight-bold"> Full Name: </h6>
                                    <p class="text-dark">{{ $params['complain_records']->name ?? '' }}</p>
                                </div>
                                <div class="form-group mb-2 col-md-4">
                                    <h6 class="mt-2 font-weight-bold"> Email Address: </h6>
                                    <p class="text-dark">{{ $params['complain_records']->email ?? '' }}</p>
                                </div>
                                <div class="form-group mb-2 col-md-4">
                                    <h6 class="mt-2 font-weight-bold"> Phone Number: </h6>
                                    <p class="text-dark">{{ $params['complain_records']->phone ?? '' }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="form-row mt-4">
                            <div class="form-group mb-2 col-md-4">
                                <h6 class="mt-2 font-weight-bold">Complain </h6>
                                <p class="text-dark">{{ $params['complain_records']->complain ?? '' }}</p>
                            </div>
                            <div class="form-group mb-2 col-md-4">
                                <h6 class="mt-2 font-weight-bold">Resolution </h6>
                                <p class="text-dark">{{ $params['complain_records']->resolution ?? '' }}</p>
                            </div>
                            <div class="form-group mb-2 col-md-4">
                                <h6 class="mt-2 font-weight-bold">Outcome </h6>
                                <p class="text-dark">{{ $params['complain_records']->outcome ?? '' }}</p>
                            </div>
                        </div>
                        <div class="form-row mt-5">
                            <div class="form-group mb-2 col-md-12">
                                <h6 class="font-weight-bold">Remarks </h6>
                                @foreach($params['complain_records']->remarks as $remark)
                                <blockquote class="blockquote media-object text-left">
                                    <div class="media">
                                        <div class="media-body align-self-center">
                                            <p class="d-inline text-dark">
                                                {{ $remark->remark }}
                                                <br />
                                                <small>{{ formatDateTime($remark->created_at) }}</small>
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
    </x-slot>
    <x-slot name="modal_footer">
    </x-slot>
</x-modal>