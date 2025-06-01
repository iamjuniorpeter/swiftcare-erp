<x-layouts.master title="My Wallet" menutitle="add-transaction">

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
                    <div class="row layout-top-spacing">

                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-account-invoice-two">
                                <div class="widget-content">
                                    <div class="account-box">
                                        <div class="info">
                                            <div class="inv-title">
                                                <h5 class="">Wallet Balance</h5>
                                            </div>
                                            <div class="inv-balance-info">

                                                <p class="inv-balance">NGN 41,741.42</p>

                                                <span class="inv-stats balance-credited">+ 2453</span>

                                            </div>
                                        </div>
                                        <div class="acc-action">
                                            <a href="javascript:void(0);">Top Up</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-card-four">
                                <div class="widget-content">
                                    <div class="w-header">
                                        <div class="w-info">
                                            <h6 class="value">Deposit</h6>
                                        </div>
                                    </div>

                                    <div class="w-content">
                                        <div class="w-info">
                                            <p class="value">NGN 45,141 </p>
                                        </div>
                                    </div>

                                    <div class="w-progress-stats">
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: 57%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>

                                        <div class="">
                                            <div class="w-icon">
                                                <p>57%</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-card-four">
                                <div class="widget-content">
                                    <div class="w-header">
                                        <div class="w-info">
                                            <h6 class="value">Withdrawal</h6>
                                        </div>
                                    </div>

                                    <div class="w-content">
                                        <div class="w-info">
                                            <p class="value">NGN 45,141 </p>
                                        </div>
                                    </div>

                                    <div class="w-progress-stats">
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: 57%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>

                                        <div class="">
                                            <div class="w-icon">
                                                <p>57%</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row p-3 mt-5">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-table-two p-3">

                                <div class="widget-heading">
                                    <h5 class="">
                                        My Transactions
                                    </h5>

                                </div>

                                <div class="widget-content">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <div class="th-content">Appointment Type</div>
                                                    </th>
                                                    <th>
                                                        <div class="th-content">Clinic</div>
                                                    </th>
                                                    <th>
                                                        <div class="th-content">Scheduled Time</div>
                                                    </th>
                                                    <th>
                                                        <div class="th-content th-heading">Fee</div>
                                                    </th>
                                                    <th>
                                                        <div class="th-content">Status</div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="td-content customer-name"><span>Luke Ivory</span></div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content product-brand text-primary">Headphone</div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content product-invoice">#46894</div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content pricing"><span class="">NGN 56.07</span></div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content"><span class="badge badge-success">Paid</span></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="td-content customer-name"><span>Andy King</span></div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content product-brand text-warning">Nike Sport</div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content product-invoice">#76894</div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content pricing"><span class="">NGN 88.00</span></div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content"><span class="badge badge-primary">Shipped</span></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
            </script>
        </x-slot>
        {{-- END PAGE LEVEL SCRIPTS --}}

</x-layouts.master>