<x-layouts.master title="Post Transaction" menutitle="add-transaction">

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
                        <h3>Post New Transaction</h3>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3 mb-3">
                            <form id="frmAddTransaction" name="frmAddTransaction" method="post" action="">
                                <div class="form-row mb-4">
                                    <input type="hidden" class="form-control" id="account_id" name="account_id" required>
                                    <div class="form-group col-md-6">
                                        <label for="old_account_no">Old Account Number</label>
                                        <input type="text" class="form-control" id="old_account_no" name="old_account_no">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="account_no">Account Number</label>
                                        <input type="text" class="form-control" id="account_no" name="account_no" required>
                                    </div>
                                </div>
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-6">
                                        <label for="surname">Surname</label>
                                        <input type="text" class="form-control" id="surname" name="surname" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="other_names">Other Names</label>
                                        <input type="text" class="form-control" id="other_names" name="other_names" required>
                                    </div>
                                </div>
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-4">
                                        <label for="gender">Gender</label>
                                        <input type="text" class="form-control" id="gender" name="gender">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="marital_status">Marital Status</label>
                                        <input type="text" class="form-control" id="marital_status" name="marital_status">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="date_of_birth">Date of Birth</label>
                                        <input type="text" class="form-control" id="date_of_birth" name="date_of_birth">
                                    </div>
                                </div>
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-6">
                                        <label for="phone_1">Phone 1</label>
                                        <input type="text" class="form-control" id="phone_1" name="phone_1" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone_2">Phone 2</label>
                                        <input type="text" class="form-control" id="phone_2" name="phone_2">
                                    </div>
                                </div>
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-6">
                                        <label for="lga_of_originID">LGA of Origin</label>
                                        <input type="text" class="form-control" id="lga_of_originID" name="lga_of_originID">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="state_of_originID">State of Origin</label>
                                        <input type="text" class="form-control" id="state_of_originID" name="state_of_originID">
                                    </div>
                                </div>
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-6">
                                        <label for="is_employed">Is Employed</label>
                                        <input type="text" class="form-control" id="is_employed" name="is_employed">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="zoneID">Zone ID</label>
                                        <input type="text" class="form-control" id="zoneID" name="zoneID">
                                    </div>
                                </div>
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-6">
                                        <label for="account_officerID">Account Officer ID</label>
                                        <input type="text" class="form-control" id="account_officerID" name="account_officerID" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="mothers_maiden_name">Mother's Maiden Name</label>
                                        <input type="text" class="form-control" id="mothers_maiden_name" name="mothers_maiden_name" required>
                                    </div>
                                </div>
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-6">
                                        <label for="remark">Remark</label>
                                        <input type="text" class="form-control" id="remark" name="remark">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="avatar">Avatar</label>
                                        <input type="text" class="form-control" id="avatar" name="avatar">
                                    </div>
                                </div>
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-6">
                                        <label for="status">Status</label>
                                        <input type="text" class="form-control" id="status" name="status" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="created_at">Created At</label>
                                        <input type="text" class="form-control" id="created_at" name="created_at" required>
                                    </div>
                                </div>
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-6">
                                        <label for="updated_at">Updated At</label>
                                        <input type="text" class="form-control" id="updated_at" name="updated_at">
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <div class="form-check pl-0">
                                        <div class="custom-control custom-checkbox checkbox-info">
                                            <input type="checkbox" class="custom-control-input" id="gridCheck" name="gridCheck">
                                            <label class="custom-control-label" for="gridCheck">Check me out</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Sign in</button>
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
        </script>
    </x-slot>
    {{-- END PAGE LEVEL SCRIPTS --}}

</x-layouts.master>