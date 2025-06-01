<x-layouts.master title="Book Appointment" menutitle="add-transaction">

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
                        <h3>Book Appointment</h3>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3 mb-3">
                            <form id="frmBookAppointment" name="frmBookAppointment" method="post" action="">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Select Appointment Type</label>
                                        <select class="form-control cmbSelectServiceCategory" name="cmbSelectServiceCategory[]">
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Select Clinic</label>
                                        <select class="form-control cmbSelectService" name="cmbSelectService[]">
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Select Appointment Time</label>
                                        <select class="form-control cmbSelectService" name="cmbSelectService[]">
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Book Appointment</button>
                            </form>
                        </div>
                    </div>
                    <div class="row p-3 mt-5">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-table-two p-3">

                                <div class="widget-heading">
                                    <h5 class="">
                                        Appointment History
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
                                                        <div class="td-content pricing"><span class="">$56.07</span></div>
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
                                                        <div class="td-content pricing"><span class="">$88.00</span></div>
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