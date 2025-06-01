<div class="row p-4">
    <div class="col-lg-12">
        <form name="frmBatchBcrFfsSummary" id="frmBatchBcrFfsSummary" action="{{ route('bcr-ffs-summary.save') }}" method="post">
            <div class="form-group row m-4">

                <div class="col-6"></div>
                <div class="col-3">
                    <select class="form-control cmbSelect2" name="cmbBatch" id="cmbBatch">
                        {!! $batch_list !!}
                    </select>
                </div>
                <div class="col-3">
                    <div class="loader dual-loader mx-auto" style="display:none" id="frmBatchBcrFfsSummaryLoader"></div>
                    <button class="form-control btn btn-info" id="btnBatchBcrFfsSummary">
                        Forward to MD
                    </button>
                </div>
            </div>
        </form>



        <div class="card component-card_4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr>
                                <th>Names of Facilities</th>
                                <th>HCP Date</th>
                                <th>State Date</th>
                                <th>HQ Date</th>
                                <th>HCP Month</th>
                                <th>Amount Paid</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($records as $record)
                            <tr>
                                <td class="align-top">{{ $record->authorization_code->receiving_hcp->hcp_name }}</td>
                                <td class="align-top">{{ formatDate($record->created_at) }}</td>
                                <td class="align-top">{{ formatDate($record->nurse_officer_vetted_date) }}</td>
                                <td class="align-top">{{ formatDate($record->hq_vetted_date) }}</td>
                                <td class="align-top">{{ $record->month->month_name }}</td>
                                <td class="align-top">{{ formatAmount($record->totalAmount) }}</td>
                                <td class="align-top">{{ formatAmount($record->totalAmount) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    applySelect2([".cmbSelect2"]);
    batchBcrFfsSummary();
</script>