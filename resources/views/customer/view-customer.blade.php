<x-layouts.master title="View Customer" menutitle="view-transaction">

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
            <div class="page-header">
                <div class="page-title">
                    <h3>List of {{ $status }} Customer</h3>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    @if(strtolower($logged_in_user->accountRole->code) == "bmr" || strtolower($logged_in_user->accountRole->code) == "mgr")

                    <form id="frmFilterCustomer" name="frmFilterCustomer" method="post" action="{{ route('transaction.filter') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="account_officer">Filter by </label>
                                <select class="form-control cmbSelect2" id="filter_type" name="filter_type" required>
                                    <option value="-1">Select</option>
                                    <option value="account-officer">Account Officer</option>
                                    <option value="transaction-date">Transaction Date</option>
                                </select>
                                <div class="form-group col-md-12">
                                    <input type="hidden" name="status" value="{{ $status }}" />
                                    <button type="submit" class="btn btn-primary mt-3" name="btnFilterTransaction" id="btnFilterTransaction">Filter</button>
                                    <a href="{{ route('transaction.view', strtolower($status)) }}" class="btn btn-secondary mt-3">Clear Filter</a>
                                </div>
                            </div>
                            <div class="form-group col-md-3 cmbOptions" id="cmbFilterAccountOfficer">
                                <label for="account_officer">Filter by Account Officer </label>
                                <select class="form-control cmbSelect2" id="filter_account_officer" name="account_officer">
                                    {{!! $staff_list !!}}
                                </select>
                            </div>
                            <div class="form-group col-md-3 cmbOptions date_range">
                                <label for="account_officer">Transaction Date From </label>
                                <input type="date" class="form-control" name="date_from" />
                            </div>
                            <div class="form-group col-md-3 cmbOptions date_range">
                                <label for="account_officer">Transaction Date To </label>
                                <input type="date" class="form-control" name="date_to" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif

            <div class="row pt-2 mt-3" id="cancel-row">
                @if(strtolower($status) == "in-progress" && (strtolower($logged_in_user->accountRole->code) == "bmr" || strtolower($logged_in_user->accountRole->code) == "mgr") )
                <div class="col-xl-6 text-left pr-4">
                    <h4 class="text-primary">Total Customers <span id="">{{ formatAmount($total_customers, 0) }}</span> </h4>
                </div>
                <div class="col-xl-6 text-right pr-4">
                    <button class="btn btn-success btn-sm btnApproveAllCustomer" sta="Approved" rte="{{ route('customer.status.update.bulk', ['status' => 'Approved']) }}">Approve All</button>
                </div>
                @endif

                <div class="col-xl-12 col-lg-12 col-sm-12 p-2  layout-spacing">
                    <div class="widget-content widget-content-area br-6 p-1">
                        <table id="style-2" class="table style-2 dt-table-hover non-hover myDataTable" style="width:100%">
                            <thead>
                                <tr>
                                    @if(strtolower($status) == "in-progress")
                                    <th class="checkbox-column">
                                        <input type="checkbox" id="checkAllCustomers" />
                                    </th>
                                    @endif
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th>Account Number</th>
                                    <th>Phone Number</th>
                                    <th>Zone</th>
                                    <th>Account Officer</th>
                                    <th class=" dt-no-sorting">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($customer_records as $customer_record)

                                @php
                                $i = 1;
                                $customer = $customer_record;
                                $sname = $customer_record?->surname ?? "";
                                $oname = $customer_record?->other_names ?? "";
                                $customer_name = $sname." ".$oname;
                                $customer_balance = getCustomerTotalBalance($customer->account_id);

                                $staff_sname = $customer_record->account_officer?->surname ?? "";
                                $staff_fname = $customer_record->account_officer?->first_name ?? "";
                                $staff_oname = $customer_record->account_officer?->other_names ?? "";
                                $account_officer = $staff_sname." ".$staff_fname." ".$staff_oname." ";
                                $customer_account_status = $customer_record->status ?? "";

                                $avatar = ($customer_record->avatar) ? asset($customer_record->avatar) : asset('@assets/img/avatar2.png');
                                $auto_id = $i;
                                @endphp

                                <tr>
                                    @if(strtolower($status) == "in-progress")
                                    <!--<td class="checkbox-column checkAllTransaction" value="{{ $customer->account_id }}">{{ $loop->iteration }}</td>-->
                                    <td>
                                        <input type="hidden" class="amt" value="{{ $customer?->account_id }}" />
                                        <input type="checkbox" class="checkbox-colu checkAllCustomer" value="{{ $customer?->account_id }}" />
                                    </td>
                                    @endif
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ $avatar }}" class="avatar avatar-sm rounded-circle" style="width:30px; height:30px" />
                                        &nbsp;&nbsp; {{ $customer_name }}
                                    </td>
                                    <td>{!! getStatusBadge($customer_account_status) !!}</td>
                                    <td>{{ $customer_record->account_no }}</td>
                                    <td>{{ $customer_record->phone_1 }}</td>
                                    <td>{{ $customer_record?->zone?->zone_name ?? '' }}</td>
                                    <td>{{ $account_officer }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-dark btn-sm mr-3" data-toggle="modal" data-target="#viewCustomerModal{{ $loop->iteration }}">
                                                View
                                            </button>
                                            <a class="btn btn-info btn-sm mr-3 btnApproveCustomer" ref=" {{ $customer->sn }}" href="{{ route('customer.edit', ['customer_id' => $customer->account_id]) }}">Edit</a>
                                            @if( (strtolower($customer_account_status) == "pending" || strtolower($customer_account_status) == "flagged" || strtolower($customer_account_status) == "approved") && (strtolower($logged_in_user->accountRole->code) == "bmr" || strtolower($logged_in_user->accountRole->code) == "mgr") )
                                            <div class="dropdown custom-dropdown">
                                                <a class="dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink{{ $loop->iteration }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                                                        <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="19" cy="12" r="1"></circle>
                                                        <circle cx="5" cy="12" r="1"></circle>
                                                    </svg>
                                                </a>

                                                @if(strtolower($customer_account_status) == "pending")
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink{{ $loop->iteration }}">
                                                    <a class="dropdown-item text-success text-bold btnApproveCustomer" rte="{{ route('customer.status.update', ['customer_id' => $customer->account_id, 'status' => 'Approved']) }}" ref=" {{ $customer->sn }}" href="javascript:void(0)">Approve</a>
                                                    <a class="dropdown-item text-warning text-bold btnFlagCustomer" rte="{{ route('customer.status.update', ['customer_id' => $customer->account_id, 'status' => 'Flagged']) }}" ref="{{ $customer->sn }}" href="javascript:void(0);">Flag</a>
                                                    <a class="dropdown-item text-danger text-bold btnRejectCustomer" rte="{{ route('customer.status.update', ['customer_id' => $customer->account_id, 'status' => 'Rejected']) }}" ref="{{ $customer->sn }}" href="javascript:void(0);">Reject</a>
                                                </div>
                                                @endif

                                                @if(strtolower($customer_account_status) == "flagged" || strtolower($customer_account_status) == "rejected" || strtolower($customer_account_status) == "active")
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink{{ $loop->iteration }}">
                                                    <a class="dropdown-item text-success text-bold btnEditCustomer" href="{{ route('customer.edit', ['customer_id' => $customer->account_id]) }}">Update</a>
                                                </div>
                                                @endif

                                            </div>
                                            @endif

                                            @if($customer)
                                            <x-customer-profile-modal :customer="$customer" title="Customer Profile" :modalId="'viewCustomerModal' . $loop->iteration" :avatar="$avatar" :loopId="$loop->iteration" :customerAccountBalance="$customer_balance" />
                                            @else
                                            <x-modal class="modal-xl" title="Customer Profile" modalid="viewCustomerModal{{$loop->iteration}}">
                                                <x-slot name="modal_body">
                                                    <div class="row">
                                                        <div class="col-12 text-center">No Record Found</div>
                                                    </div>
                                                </x-slot>
                                                <x-slot name="modal_footer"></x-slot>
                                            </x-modal>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @php $i++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if(strtolower($status) == "in-progress" && (strtolower($logged_in_user->accountRole->code) == "bmr" || strtolower($logged_in_user->accountRole->code) == "mgr") )
                <div class="col-xl-12 text-left pl-5 mt-1 mb-5">
                    <button class="btn btn-success btn-sm btnApproveAllCustomer" sta="Approved" rte="{{ route('customer.status.update.bulk', ['status' => 'Approved']) }}">Approve All</button>
                </div>
                @endif

            </div>
        </div>
    </div>
    </div>

    </div>
    <!--  END CONTENT AREA  -->

    {{-- PAGE LEVEL SCRIPTS --}}
    <x-slot name="scripts">
        <script src="{{ asset('@assets/plugins/table/datatable/datatables.js') }}"></script>
        <script src="{{ asset('@assets/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
        <script>
            applySelect2([".cmbSelect2"]);
            applyDataTable();

            performActionOnOpenCustomerAccount();
            bulkActionOnSelectedOpenCustomerAccount();
            selectAllCustomer();
            transactionFilterOnChange();
        </script>
    </x-slot>
    {{-- END PAGE LEVEL SCRIPTS --}}

</x-layouts.master>