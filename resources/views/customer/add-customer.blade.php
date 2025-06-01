<x-layouts.master title="Post Transaction" menutitle="add-transaction">

    {{-- PAGE LEVEL STYLES --}}
    <x-slot name="styles">
        <link href="{{ asset('@assets/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('@assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
        <link href="{{ asset('@assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/jquery-step/jquery.steps.css') }}" />
    </x-slot>
    {{-- END PAGE LEVEL STYLES --}}

    @php
    $avatar = ($customer_record?->avatar) ? asset($customer_record?->avatar) : asset('@assets/img/avatar2.png');
    @endphp

    <!--  BEGIN CONTENT AREA  -->

    <div id="content" class="main-content">

        <div class="container">
            <div class="row layout-top-spacing">

            </div>
        </div>
        <div class="layout-px-spacing">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row p-3">
                        @if($user_action == "edit")
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="d-flex align-items-center" style="border:0px solid red">
                                <img src="{{ $avatar }}" class="avatar avatar-sm rounded-circle mr-3" style="width:100px; height:100px;" />
                                <div class="ms-2">
                                    <h3 class="mb-0"><a href="#!" class="text-inherit">Update Customer Information</a></h3>
                                </div>
                            </div>
                        </div>
                        @else
                        <h3>Create New Customer</h3>
                        @endif
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3 mb-3">
                            <div id="example-basic">
                                <h3>Personal Data</h3>
                                <form id="frmAddCustomerPersonal" name="frmAddCustomerPersonal" method="post" action="{{ route('customer.post') }}">
                                    @csrf
                                    <section>
                                        <div class="form-row mb-2">
                                            <div class="form-group col-md-6">
                                                <label for="account_no">Account Number <small class="text-bold text-danger">(required)</small></label>
                                                <input type="text" class="form-control" id="account_no" name="account_no" value="{{ $customer_record->account_no ?? '' }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="old_account_no">Old Account Number</label>
                                                <input type="text" class="form-control" id="old_account_no" name="old_account_no" value="{{ $customer_record->old_account_no ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="form-group col-md-6">
                                                <label for="surname">Surname <small class="text-bold text-danger">(required)</small></label>
                                                <input type="text" class="form-control" id="surname" name="surname" value="{{ $customer_record->surname ?? '' }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="other_names">Other Names <small class="text-bold text-danger">(required)</small></label>
                                                <input type="text" class="form-control" id="other_names" name="other_names" value="{{ $customer_record->other_names ?? '' }}" required>
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="form-group col-md-6">
                                                <label for="phone_1">Phone 1 <small class="text-bold text-danger">(required)</small></label>
                                                <input type="text" class="form-control" id="phone_1" name="phone_1" value="{{ $customer_record->phone_1 ?? '' }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="phone_2">Phone 2</label>
                                                <input type="text" class="form-control" id="phone_2" name="phone_2" value="{{ $customer_record->phone_2 ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="form-group col-md-4">
                                                <label for="gender">Gender <small class="text-bold text-danger">(required)</small></label>
                                                <select class="form-control cmbSelect2" id="gender" name="gender" required>
                                                    {{!! $gender_list !!}}
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="marital_status">Marital Status <small class="text-bold text-danger">(required)</small></label>
                                                <select class="form-control cmbSelect2" id="marital_status" name="marital_status" required>
                                                    {{!! $marital_status_list !!}}
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="date_of_birth">Date of Birth <small class="text-bold text-danger">(required)</small></label>
                                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $customer_record->date_of_birth ?? '' }}" required>
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="form-group col-md-4">
                                                <label for="mothers_maiden_name">Mother's Maiden Name </label>
                                                <input type="text" class="form-control" id="mothers_maiden_name" name="mothers_maiden_name" value="{{ $customer_record->mothers_maiden_name ?? '' }}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="state_of_originID">State of Origin</label>
                                                <select class="form-control cmbSelect2" id="state_of_originID" name="state_of_originID">
                                                    {{!! $states_list !!}}
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="lga_of_originID">LGA of Origin</label>
                                                <input type="text" class="form-control" id="lga_of_originID" name="lga_of_originID" value="{{ $customer_record->lga_of_originID ?? '' }}">
                                            </div>

                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="form-group col-md-4">
                                                <label for="account_officerID">Account Officer ID <small class="text-bold text-danger">(required)</small></label>
                                                <select class="form-control cmbSelect2" id="account_officerID" name="account_officerID" required>
                                                    {{!! $staff_list !!}}
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="remark">Remark</label>
                                                <textarea class="form-control" id="remark" name="remark" rows="1">{{ $customer_record->remark ?? '' }}</textarea>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="avatar">Avatar</label>
                                                <input type="file" class="form-control" id="avatar" name="avatar" value="{{ $avatar }}">
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="form-group col-md-6">
                                                <label for="is_employed">Is Employed <small class="text-bold text-danger">(required)</small></label>
                                                <select class="form-control cmbSelect2" id="is_employed" name="is_employed" required>
                                                    <option value="Y">Yes</option>
                                                    <option value="N">No</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="zoneID">Zone <small class="text-bold text-danger">(required)</small></label>
                                                <select class="form-control cmbSelect2" id="zoneID" name="zoneID" required>
                                                    {{!! $zone_list !!}}
                                                </select>
                                            </div>
                                        </div>
                                        <p class="text-right">
                                            <input type="hidden" name="formUpdate" value="personal-data" />
                                            <input type="hidden" name="action" value="{{ $user_action }}" />
                                            <input type="hidden" name="status" value="{{ $customer_record->status ?? '' }}" />
                                            <input type="hidden" name="customer_account_id" id="customer_account_id1" class="customer_account_id" value="{{ $customer_record->account_id ?? '' }}" />
                                            @if($user_action == "edit")
                                            <button type="button" class="btn btn-dark btnProceedNext">Next</button>
                                            <button type="submit" class="btn btn-primary btnProceedToNext" name="btnProceedPersonalData" id="btnProceedPersonalData" rel="frmAddCustomerPersonal">Save Changes</button>
                                            @else
                                            <button type="submit" class="btn btn-primary btnProceedToNext" name="btnProceedPersonalData" id="btnProceedPersonalData" rel="frmAddCustomerPersonal">Proceed</button>
                                            @endif
                                        </p>
                                    </section>
                                </form>

                                <h3>Contact</h3>
                                <form id="frmAddCustomerContact" name="frmAddCustomerContact" method="post" action="{{ route('customer.post') }}">
                                    @csrf
                                    <section>
                                        <div class="form-row mb-2">
                                            <div class="form-group col-md-3">
                                                <label for="house_no">House Number <small class="text-bold text-danger">(required)</small></label>
                                                <input type="text" class="form-control" id="house_no" name="house_no" value="{{ $customer_record?->address?->house_no ?? '' }}" required>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="state_of_residenceID">State of Residence <small class="text-bold text-danger">(required)</small></label>
                                                <select class="form-control cmbSelect2" id="state_of_residenceID" name="state_of_residenceID" required>
                                                    {{!! $states_list !!}}
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="city">City <small class="text-bold text-danger">(required)</small></label>
                                                <input type="text" class="form-control" id="city" name="city" value="{{ $customer_record?->address?->city ?? '' }}" required>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="postal_code">Postal Code </label>
                                                <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $customer_record?->address?->postal_code ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="form-group col-md-12">
                                                <label for="residential_address">Residential Address <small class="text-bold text-danger">(required)</small></label>
                                                <input type="text" class="form-control" id="residential_address" name="residential_address" value="{{ $customer_record?->address?->residential_address ?? '' }}" required>
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="form-group col-md-12">
                                                <label for="major_landmark">Major Landmark</label>
                                                <input type="text" class="form-control" id="major_landmark" name="major_landmark" value="{{ $customer_record?->address?->major_landmark ?? '' }}">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="business_address">Business Address</label>
                                                <input type="text" class="form-control" id="business_address" name="business_address" value="{{ $customer_record?->address?->business_address ?? '' }}">
                                            </div>
                                        </div>
                                        <p class="text-right">
                                            <input type="hidden" name="formUpdate" value="contact-data" />
                                            <input type="hidden" name="action" value="{{ $user_action }}" />
                                            <input type="hidden" name="customer_account_id" id="customer_account_id2" class="customer_account_id" value="{{ $customer_record->account_id ?? '' }}" />

                                            @if($user_action == "edit")
                                            <button type="button" class="btn btn-dark btnProceedNext" name="btnProceedNext">Next</button>
                                            <button type="submit" class="btn btn-primary btnProceedToNext" name="btnProceedContact" id="btnProceedContact" rel="frmAddCustomerContact">Save Changes</button>
                                            @else
                                            <button type="submit" class="btn btn-primary btnProceedToNext" name="btnProceedContact" id="btnProceedContact" rel="frmAddCustomerContact">Proceed</button>
                                            @endif
                                        </p>
                                    </section>
                                </form>
                                <h3>Bank Account</h3>
                                <form id="frmAddCustomerBankAccount" name="frmAddCustomerBankAccount" method="post" action="{{ route('customer.post') }}">
                                    @csrf
                                    <section>
                                        <div class="form-row mb-2">
                                            <div class="form-group col-md-12">
                                                <label for="bankID">Select Bank <small class="text-bold text-danger">(required)</small></label>
                                                <select class="form-control cmbSelect2" id="bankID" name="bankID" required>
                                                    {{!! $banks_list !!}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="form-group col-md-12">
                                                <label for="account_number">Account Number <small class="text-bold text-danger">(required)</small></label>
                                                <input type="text" class="form-control" id="account_number" name="account_number" value="{{ $customer_record?->bank_account?->account_number ?? '' }}" required>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="account_name">Account Name <small class="text-bold text-danger">(required)</small></label>
                                                <input type="text" class="form-control" id="account_name" name="account_name" value="{{ $customer_record?->bank_account?->account_name ?? '' }}" required>
                                            </div>
                                        </div>
                                        <p class="text-right">
                                            <input type="hidden" name="formUpdate" value="bank-account-data" />
                                            <input type="hidden" name="action" value="{{ $user_action }}" />
                                            <input type="hidden" name="customer_account_id" id="customer_account_id3" class="customer_account_id" value="{{ $customer_record->account_id ?? '' }}" />
                                            @if($user_action == "edit")
                                            <button type="button" class="btn btn-dark btnProceedNext" name="btnProceedNext">Next</button>
                                            <button type="submit" class="btn btn-primary btnProceedToNext" name="btnProceedBankAccount" id="btnProceedBankAccount" rel="frmAddCustomerBankAccount">Save Changes</button>
                                            @else
                                            <button type="submit" class="btn btn-primary btnProceedToNext" name="btnProceedBankAccount" id="btnProceedBankAccount" rel="frmAddCustomerBankAccount">Proceed</button>
                                            @endif
                                        </p>
                                    </section>
                                </form>
                                <h3>Savings Plan</h3>
                                <form id="frmAddCustomerSavingsPlan" name="frmAddCustomerSavingsPlan" method="post" action="{{ route('customer.post') }}">
                                    @csrf
                                    <section>
                                        <div class="form-row mb-2">
                                            <div class="form-group col-md-12">
                                                <label for="savings_planID">Select Savings Plan <small class="text-bold text-danger">(required)</small></label>
                                                <select class="form-control cmbSelect2" id="savings_planID" name="savings_planID" required>
                                                    {{!! $savings_plans_list !!}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="form-group col-md-12">
                                                <label for="status">Status <small class="text-bold text-danger">(required)</small></label>
                                                <select class="form-control" id="status" name="status" required>
                                                    <option value="active" {{ strtolower($customer_record?->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                                                    <option value="inactive" {{ strtolower($customer_record?->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <p class="text-right">
                                            <input type="hidden" name="formUpdate" value="savings-plan-data" />
                                            <input type="hidden" name="action" value="{{ $user_action }}" />
                                            <input type="hidden" name="customer_account_id" id="customer_account_id4" class="customer_account_id" value="{{ $customer_record->account_id ?? '' }}" />
                                            @if($user_action == "edit")
                                            <button type="button" class="btn btn-dark btnProceedNext" name="btnProceedNext">Next</button>
                                            <button type="submit" class="btn btn-primary btnProceedToNext" name="btnProceedSavingsPlan" id="btnProceedSavingsPlan" rel="frmAddCustomerSavingsPlan">Save Changes</button>
                                            @else
                                            <button type="submit" class="btn btn-primary btnProceedToNext" name="btnProceedSavingsPlan" id="btnProceedSavingsPlan" rel="frmAddCustomerSavingsPlan">Proceed</button>
                                            @endif
                                        </p>
                                    </section>
                                </form>
                                <h3>Next of Kin</h3>
                                <form id="frmAddCustomerNok" name="frmAddCustomerNok" method="post" action="{{ route('customer.post') }}">
                                    @csrf
                                    <section>
                                        <div class="form-row mb-2">
                                            <div class="form-group col-md-12">
                                                <label for="relationship">Relationship <small class="text-bold text-danger">(required)</small></label>
                                                <input type="text" class="form-control" id="relationship" name="relationship" value="{{ $customer_record?->nok?->relationship ?? '' }}" required>
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="form-group col-md-6">
                                                <label for="surname">Surname <small class="text-bold text-danger">(required)</small></label>
                                                <input type="text" class="form-control" id="surname" name="surname" value="{{ $customer_record?->nok?->surname ?? '' }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="other_names">Other Names <small class="text-bold text-danger">(required)</small></label>
                                                <input type="text" class="form-control" id="other_names" name="other_names" value="{{ $customer_record?->nok?->other_names ?? '' }}" required>
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="form-group col-md-6">
                                                <label for="phone_number">Phone Number <small class="text-bold text-danger">(required)</small></label>
                                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $customer_record?->nok?->phone_number ?? '' }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="contact_address">Contact Address <small class="text-bold text-danger">(required)</small></label>
                                                <input type="text" class="form-control" id="contact_address" name="contact_address" value="{{ $customer_record?->nok?->contact_address ?? '' }}" required>
                                            </div>
                                        </div>
                                        <p class="text-right">
                                            <input type="hidden" name="formUpdate" value="nok-data" />
                                            <input type="hidden" name="action" value="{{ $user_action }}" />
                                            <input type="hidden" name="customer_account_id" id="customer_account_id5" class="customer_account_id" value="{{ $customer_record->account_id ?? '' }}" />
                                            @if($user_action == "edit")
                                            <button type="button" class="btn btn-dark btnProceedNext" name="btnProceedNext">Next</button>
                                            <button type="submit" class="btn btn-primary btnProceedToNext" name="btnProceedNextOfKin" id="btnProceedNextOfKin" rel="frmAddCustomerNok">Save Changes</button>
                                            @else
                                            <button type="submit" class="btn btn-primary btnProceedToNext" name="btnProceedNextOfKin" id="btnProceedNextOfKin" rel="frmAddCustomerNok">Submit</button>
                                            @endif
                                        </p>
                                    </section>
                                </form>
                                <h3>Summary </h3>
                                <form id="frmAddCustomerSummary" name="frmAddCustomerSummary" method="post" action="{{ route('customer.post') }}">
                                    @csrf
                                    <section>
                                        <p class="text-center"><button type="button" class="btn btn-info mt-3 mb-5" id="btnNextToSummary">View Summary</button></p>
                                        <div id="summary-step" class="d-none">
                                            <h3>Summary of Customer Details</h3>

                                            <div class="form-row mb-2">
                                                <div class="form-group col-md-6">
                                                    <label>Account Number:</label>
                                                    <p id="summary_account_no"></p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Old Account Number:</label>
                                                    <p id="summary_old_account_no"></p>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="form-group col-md-6">
                                                    <label>Surname:</label>
                                                    <p id="summary_surname"></p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Other Names:</label>
                                                    <p id="summary_other_names"></p>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="form-group col-md-6">
                                                    <label>Phone 1:</label>
                                                    <p id="summary_phone_1"></p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Phone 2:</label>
                                                    <p id="summary_phone_2"></p>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="form-group col-md-4">
                                                    <label>Gender:</label>
                                                    <p id="summary_gender"></p>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Marital Status:</label>
                                                    <p id="summary_marital_status"></p>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Date of Birth:</label>
                                                    <p id="summary_date_of_birth"></p>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="form-group col-md-4">
                                                    <label>Mother's Maiden Name:</label>
                                                    <p id="summary_mothers_maiden_name"></p>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>State of Origin:</label>
                                                    <p id="summary_state_of_origin"></p>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>LGA of Origin:</label>
                                                    <p id="summary_lga_of_origin"></p>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="form-group col-md-4">
                                                    <label>Account Officer:</label>
                                                    <p id="summary_account_officerID"></p>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Remark:</label>
                                                    <p id="summary_remark"></p>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Avatar:</label>
                                                    <p id="summary_avatar"></p>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="form-group col-md-6">
                                                    <label>Is Employed:</label>
                                                    <p id="summary_is_employed"></p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Zone:</label>
                                                    <p id="summary_zoneID"></p>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="form-group col-md-3">
                                                    <label>House Number:</label>
                                                    <p id="summary_house_no"></p>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>State of Residence:</label>
                                                    <p id="summary_state_of_residence"></p>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>City:</label>
                                                    <p id="summary_city"></p>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Postal Code:</label>
                                                    <p id="summary_postal_code"></p>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="form-group col-md-12">
                                                    <label>Residential Address:</label>
                                                    <p id="summary_residential_address"></p>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="form-group col-md-12">
                                                    <label>Major Landmark:</label>
                                                    <p id="summary_major_landmark"></p>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="form-group col-md-12">
                                                    <label>Business Address:</label>
                                                    <p id="summary_business_address"></p>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="form-group col-md-6">
                                                    <label>Bank:</label>
                                                    <p id="summary_bankID"></p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Account Number:</label>
                                                    <p id="summary_account_number"></p>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="form-group col-md-12">
                                                    <label>Account Name:</label>
                                                    <p id="summary_account_name"></p>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="form-group col-md-6">
                                                    <label>Savings Plan:</label>
                                                    <p id="summary_savings_planID"></p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Balance:</label>
                                                    <p id="summary_balance"></p>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="form-group col-md-12">
                                                    <label>Status:</label>
                                                    <p id="summary_status"></p>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="form-group col-md-6">
                                                    <label>Next of Kin Surname:</label>
                                                    <p id="summary_next_of_kin_surname"></p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Next of Kin Other Names:</label>
                                                    <p id="summary_next_ofkin_other_names"></p>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="form-group col-md-6">
                                                    <label>Relationship:</label>
                                                    <p id="summary_next_of_kin_relationship"></p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Phone Number:</label>
                                                    <p id="summary_next_of_kin_phone_number"></p>
                                                </div>
                                            </div>

                                            <div class="form-row mb-2">
                                                <div class="form-group col-md-12">
                                                    <label>Contact Address:</label>
                                                    <p id="summary_next_of_kin_contact_address"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="formUpdate" value="summary-data" rel="frmAddCustomerSummary" />
                                        <input type="hidden" name="action" value="add" />
                                        <input type="hidden" name="customer_account_id" id="customer_account_id6" class="customer_account_id" value="" />
                                        <input type="hidden" class="form-control" id="created_at" name="created_at" value="{{ now() }}">
                                        <input type="hidden" class="form-control" id="updated_at" name="updated_at" value="{{ now() }}">
                                        <div class="loader dual-loader mx-auto" style="display:none" id="frmAddCustomerLoader"></div>
                                        <!--<p class="text-center"><button type="submit" class="btn btn-primary mt-3" name="btnAddCustomer" id="btnAddCustomer">Submit</button></p>-->
                                    </section>
                                </form>
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
        <script src="{{ asset('@assets/js/scrollspyNav.js') }}"></script>
        <script src="{{ asset('@assets/plugins/jquery-step/jquery.steps.min.js') }}"></script>
        <script src=" {{ asset('@assets/plugins/jquery-step/custom-jquery.steps.js') }}"></script>

        <script>
            applySelect2([".cmbSelect2"]);

            function proceedPersonalData(nextButton) {
                if ($('.btnProceedToNext').length > 0) {
                    var nextButton = $('a[href="#next"][role="menuitem"]');
                    if (nextButton.length > 0) {
                        console.log("Next button found:", nextButton);
                        $(nextButton).hide();
                    } else {
                        //console.log("Next button not found.");
                    }

                    var btnId = $(this).attr("id");
                    //var frmId = $(this).attr("frmId");

                    $(document).on('click', '.btnProceedToNext', function(e) {
                        e.preventDefault();
                        nextButton.click();
                    });
                }
            }

            function proceedNext() {
                if ($('.btnProceedNext').length > 0) {
                    $(document).on('click', '.btnProceedNext', function(e) {
                        e.preventDefault();

                        var nextButton = $('a[href="#next"][role="menuitem"]');
                        if (nextButton.length > 0) {
                            console.log("Next button found:", nextButton);
                            $(nextButton).hide();
                        }

                        nextButton.click();
                    });

                }
            }

            $(document).ready(function() {

                //proceedPersonalData();
                addNewCustomer();

                proceedNext();

                $("#btnNextToSummary").click(function() {
                    // Populate the summary fields
                    $('#summary_account_no').text($('#account_no').val());
                    $('#summary_old_account_no').text($('#old_account_no').val());
                    $('#summary_surname').text($('#surname').val());
                    $('#summary_other_names').text($('#other_names').val());
                    $('#summary_phone_1').text($('#phone_1').val());
                    $('#summary_phone_2').text($('#phone_2').val());
                    $('#summary_gender').text($('#gender').val());
                    $('#summary_marital_status').text($('#marital_status').val());
                    $('#summary_date_of_birth').text($('#date_of_birth').val());
                    $('#summary_mothers_maiden_name').text($('#mothers_maiden_name').val());
                    $('#summary_state_of_origin').text($('#state_of_origin').val());
                    $('#summary_lga_of_origin').text($('#lga_of_origin').val());
                    $('#summary_account_officerID').text($('#account_officerID').val());
                    $('#summary_remark').text($('#remark').val());
                    $('#summary_avatar').text($('#avatar').val());
                    $('#summary_is_employed').text($('#is_employed').val());
                    $('#summary_zoneID').text($('#zoneID').val());
                    $('#summary_house_no').text($('#house_no').val());
                    $('#summary_state_of_residence').text($('#state_of_residence').val());
                    $('#summary_city').text($('#city').val());
                    $('#summary_postal_code').text($('#postal_code').val());
                    $('#summary_residential_address').text($('#residential_address').val());
                    $('#summary_major_landmark').text($('#major_landmark').val());
                    $('#summary_business_address').text($('#business_address').val());
                    $('#summary_bankID').text($('#bankID').val());
                    $('#summary_account_number').text($('#account_number').val());
                    $('#summary_account_name').text($('#account_name').val());
                    $('#summary_savings_planID').text($('#savings_planID').val());
                    $('#summary_balance').text($('#balance').val());
                    $('#summary_status').text($('#status').val());
                    $('#summary_next_of_kin_surname').text($('#next_of_kin_surname').val());
                    $('#summary_next_of_kin_other_names').text($('#next_of_kin_other_names').val());
                    $('#summary_next_of_kin_relationship').text($('#next_of_kin_relationship').val());
                    $('#summary_next_of_kin_phone_number').text($('#next_of_kin_phone_number').val());
                    $('#summary_next_of_kin_contact_address').text($('#next_of_kin_contact_address').val());
                    $('#summary_created_at').text($('#created_at').val());
                    $('#summary_updated_at').text($('#updated_at').val());

                    // Show the summary step and hide other steps
                    $('#summary-step').toggleClass('d-none');
                });
            });
        </script>
    </x-slot>
    {{-- END PAGE LEVEL SCRIPTS --}}
</x-layouts.master>