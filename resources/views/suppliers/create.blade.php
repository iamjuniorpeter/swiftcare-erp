<x-layouts.master title="Add Supplier" menutitle="Add Supplier">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>
    <div id="content" class="main-content">
       <div class="layout-px-spacing">
        <div class="col-12 mt-3 mb-3 mt-3 pull-right" style="text-align:right">
                <a href="{{ route('suppliers.index') }}" class="btn-lg btn btn-info">View Suppliers</a>
        </div>
        <div class="col-8 offset-2 mt-5 mb-3">
          <div class="card mt-3">
              <div class="card-header bg-primary">
                  <h3 class="text-white">Add New Supplier</h3>
              </div>
              <div class="card-body">
                    <form action="{{ route('suppliers.store') }}" method="POST" id="frmSaveSupplier" name="frmSaveSupplier">
                        @csrf

                        <!-- Supplier Name -->
                        <div class="form-group">
                            <label for="name">Supplier Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        

                        <div class="row">
                            <div class="col-4">
                                <!-- Contact Person -->
                                <div class="form-group">
                                    <label for="contact_person">Contact Person</label>
                                    <input type="text" class="form-control" id="contact_person" name="contact_person" >
                                </div>
                            </div>
                            <div class="col-4">
                                <!-- Phone Number -->
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" >
                                </div>
                            </div>
                            <div class="col-4">
                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" >
                                </div>
                            </div>
                        </div>

                        <div class="row">                         
                            <div class="col-6">
                                <!-- Supplier Type -->
                                <div class="form-group">
                                    <label for="type">Supplier Type</label>
                                    <select class="form-control" id="type" name="type" required>
                                        <option value="">-- Select Type --</option>
                                        <option value="inventory">Inventory</option>
                                        <option value="service">Service</option>
                                        <option value="both">Both</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                 <!-- Status -->
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="active" selected>Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>  

                        <div class="row">
                            <div class="col-6">
                                <!-- Address -->
                                <div class="form-group">
                                    <label for="address">Supplier Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="2" ></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                 <!-- Notes -->
                                <div class="form-group">
                                    <label for="notes">Notes / Description</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-right">
                            <input type="hidden" class="form-control" id="merchantID" name="merchantID" value="{{  Auth::user()->accountID }}">
                            <button type="submit" class="btn btn-lg btn-primary mt-3" id="btnSaveSupplier">Save Supplier</button>
                        </div>
                    </form>

              </div>
          </div>
        </div>
       </div>
    </div>
    <x-slot name="scripts">
        <script src="{{ asset('@assets/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
        <script>
            applyDataTable();
            saveSupplier();
        </script>
    </x-slot>
</x-layouts.master>
