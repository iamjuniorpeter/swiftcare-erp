<x-layouts.master title="Update Transaction" menutitle="add-transaction">

    {{-- PAGE LEVEL STYLES --}}
    <x-slot name="styles">
        <link href="{{ asset('@assets/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('@assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>
    {{-- END PAGE LEVEL STYLES --}}

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row p-3">
                        <h3>Update Transaction</h3>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3 mb-3">
                            <form id="frmPostTransaction" name="frmPostTransaction" method="post" action="{{ route('transaction.post') }}">
                                @csrf
                                <div class="form-row mb-2">
                                    <div class="form-group col-md-3">
                                        <label for="customer_account">Select Customer <small class="text-bold text-danger">(required)</small></label>
                                        <select class="form-control cmbSelect2" id="customer_account" name="customer_account" required>
                                            {{!! $customers_list !!}}
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="trans_type">Transaction Type <small class="text-bold text-danger">(required)</small></label>
                                        <select class="form-control cmbSelect2" id="trans_type" name="trans_type" required>
                                            {{!! $transaction_type_list !!}}
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="trans_type">Transaction Mode <small class="text-bold text-danger">(required)</small></label>
                                        <select class="form-control cmbSelect2" id="trans_mode" name="trans_mode" required>
                                            {{!! $transaction_mode_list !!}}
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="trans_type">Select Plan <small class="text-bold text-danger">(required)</small></label>
                                        <select class="form-control cmbSelect2" id="savings_plan" name="savings_plan" required>
                                            {{!! $savings_plan_list !!}}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <div class="form-group col-md-6">
                                        <label for="amount">Amount <small class="text-bold text-danger">(required)</small></label>
                                        <input type="number" min="1" class="form-control" id="amount" name="amount" value="{{ $record->amount }}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="description">Narration <small class="text-bold text-warning">(optional)</small></label>
                                        <textarea class="form-control" id="description" name="description" rows="1">{{ $record->description }}</textarea>
                                    </div>
                                </div>
                                @if(Auth::user()->accountRole->code == "bmr" || Auth::user()->accountRole->code == "mgr")
                                <div class="form-row mb-2">
                                    <div class="form-group col-md-12">
                                        <label for="account_officer">Account Officer <small class="text-bold text-danger">(required)</small></label>
                                        <select class="form-control cmbSelect2" id="account_officer" name="account_officer" required>
                                            {{!! $staff_list !!}}
                                        </select>
                                    </div>
                                </div>
                                @else
                                <input type="hidden" class="form-control" id="account_officer" name="account_officer" value="{{ Auth::user()->accountID }}" />
                                @endif
                                <input type="hidden" class="form-control" id="action" name="action" value="edit" required>
                                <input type="hidden" class="form-control" name="trans_reference" value="{{ $record->trans_reference }}" required>
                                <div class="loader dual-loader mx-auto" style="display:none" id="frmPostTransactionLoader"></div>
                                <button type="submit" class="btn btn-primary mt-3" name="btnPostTransaction" id="btnPostTransaction">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--  END CONTENT AREA  -->

    {{-- PAGE LEVEL SCRIPTS --}}
    <x-slot name="scripts">
        <script src="{{ asset('@assets/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
        <script>
            applySelect2([".cmbSelect2"]);
            postTransactionRequest();
            loadCustomerSavingsPlan("#customer_account");
        </script>
    </x-slot>
    {{-- END PAGE LEVEL SCRIPTS --}}

</x-layouts.master>