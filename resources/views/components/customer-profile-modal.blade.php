<x-modal class="modal-xl" title="Customer Profile" modalid="{{ $modalId }}">
    <x-slot name="modal_body">
        <div class="row">
            <div class="col-lg-2 col-12 text-center">
                <img src="{{ $customer->avatar ? $customer->avatar : $avatar }}" alt="{{$customer->surname}}" style="width:100%">
                <br /><br />
                <label class="custom-label">Account Status</label>
                <h6 class="custom-h6">{!! getStatusBadge($customer->status) !!}</h6>
                <br />
                <label class="custom-label">Total Balance (NGN)</label>
                <h6 class="custom-h6">{{ formatAmount($customerAccountBalance) ?? 'N/A' }}</h6>
                <br />
                <label class="custom-label">Zone</label>
                <h6 class="custom-h6">{{ $customer?->zone?->zone_name ?? 'N/A' }}</h6>
            </div>
            <div class="col-lg-10 col-12">
                <h5 class="text-primary">Account Information</h5>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <label class="custom-label">Account Number</label>
                        <h6 class="custom-h6">{{ $customer->account_no }}</h6>
                    </div>
                    @if (isset($customer->old_account_no) && $customer->old_account_no !== null)
                    <div class="col-lg-4 col-md-6 col-12">
                        <label class="custom-label">Old Account Number</label>
                        <h6 class="custom-h6" id="snDisplayed{{$loopId}}">{{ $customer->old_account_no ?? 'N/A' }}</h6>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <label class="custom-label">Bank Name</label>
                        <h6 class="custom-h6">{{ $customer?->bank_account?->bank?->bank_name ?? 'N/A' }}</h6>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <label class="custom-label">Bank Account Name</label>
                        <h6 class="custom-h6">{{ $customer?->bank_account->account_name ?? 'N/A' }}</h6>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <label class="custom-label">Bank Account Number</label>
                        <h6 class="custom-h6">{{ $customer?->bank_account?->account_number ?? 'N/A' }}</h6>
                    </div>
                </div>
                <h6 class="mt-3 text-primary">Savings Plan</h6>
                @if($customer->savings_plan)
                @foreach($customer->savings_plan as $customer_plan)
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <label class="custom-label">Plan Name</label>
                        <h6 class="custom-h6">{{ $customer_plan?->plans?->plan_name ?? 'N/A' }} - {{ formatAmount($customer_plan?->plans?->amount) ?? 'N/A' }}</h6>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <label class="custom-label">Balance (NGN)</label>
                        <h6 class="custom-h6">{{ formatAmount(getCustomerPlanBalance($customer->account_id, $customer_plan?->savings_planID)) ?? 'N/A' }}</h6>
                    </div>
                </div>
                @endforeach
                @endif
                <hr />

                <h5 class="mt-4 text-primary">Personal Information</h5>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <label class="custom-label">Surname</label>
                        <h6 class="custom-h6">{{ $customer->surname }}</h6>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <label class="custom-label">Other Names</label>
                        <h6 class="custom-h6">{{ $customer->other_names }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <label class="custom-label">Gender</label>
                        <h6 class="custom-h6">{{ ucfirst($customer->gender ?? 'N/A') }}</h6>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <label class="custom-label">Marital Status</label>
                        <h6 class="custom-h6">{{ $customer->marital_status ?? 'N/A' }}</h6>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <label class="custom-label">Date of Birth</label>
                        <h6 class="custom-h6">{{ $customer->date_of_birth ?? 'N/A' }}</h6>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <label class="custom-label">Mother's Maiden Name</label>
                        <h6 class="custom-h6">{{ $customer->mothers_maiden_name ?? 'N/A' }}</h6>
                    </div>
                </div>
                <hr />
                <h5 class="text-primary">Contact Data</h5>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <label class="custom-label">Phone Number</label>
                        <h6 class="custom-h6">{{ $customer->phone_1 ?? 'N/A' }}</h6>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <label class="custom-label">Phone Number (alt)</label>
                        <h6 class="custom-h6">{{ $customer->phone_2 ?? 'N/A' }}</h6>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <label class="custom-label">Email</label>
                        <h6 class="custom-h6" style="word-wrap: break-word;">{{ $customer?->email ?? 'N/A' }}</h6>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <label class="custom-label">State of Origin</label>
                        <h6 class="custom-h6">{{ $customer?->state_of_residence?->state_name ?? 'N/A'  }}</h6>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <label class="custom-label">LGA of Origin</label>
                        <h6 class="custom-h6">{{ $customer?->lga_of_residence?->lga_name ?? 'N/A'  }}</h6>
                    </div>
                    <div class="col-12">
                        <label class="custom-label">Residential Address</label>
                        <h6 class="custom-h6">
                            {{ $customer?->address?->house_no ?? ''  }}
                            {{ $customer?->address?->residential_address ?? ''  }}
                            {{ $customer?->address?->city ?? ''  }} ,
                            {{ $customer?->address?->state?->state_name ?? ''  }}
                        </h6>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="custom-label">Residential Major Landmark</label>
                        <h6 class="custom-h6"> {{ $customer?->address?->major_landmark ?? ''  }} </h6>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="custom-label">Business Address</label>
                        <h6 class="custom-h6"> {{ $customer?->address?->business_address ?? ''  }} </h6>
                    </div>
                </div>
                <h6 class="mt-3 text-primary">Next of Kin</h6>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <label class="custom-label">Next of Kin Name</label>
                        <h6 class="custom-h6">{{ $customer?->next_of_kin?->surname ?? '' }} {{ $customer?->next_of_kin?->other_names ?? '' }}</h6>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <label class="custom-label">Next of Kin Phone</label>
                        <h6 class="custom-h6">{{ $customer?->next_of_kin?->phone_number ?? 'N/A' }}</h6>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <label class="custom-label">Next of Email Address</label>
                        <h6 class="custom-h6">{{ $customer?->next_of_kin?->email_address ?? 'N/A' }}</h6>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <label class="custom-label">Next of Relationship</label>
                        <h6 class="custom-h6">{{ $customer?->next_of_kin?->relationship ?? 'N/A' }} </h6>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <label class="custom-label">Next of Kin Contact Address</label>
                        <h6 class="custom-h6">{{ $customer?->next_of_kin?->contact_address ?? 'N/A' }}</h6>
                    </div>
                </div>
                <hr />
            </div>
        </div>
    </x-slot>
    <x-slot name="modal_footer">
    </x-slot>
</x-modal>