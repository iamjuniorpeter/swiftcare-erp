<x-layouts.master title="Add Customer" menutitle="Add Customer">

    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="col-12 mt-3 mb-3 mt-3 pull-right" style="text-align:right">
                    <a href="{{ route('customers.index') }}" class="btn-lg btn btn-info">View Customers</a>
            </div>
            <div class="col-10 offset-1 mt-3 mb-3">
                <div class="card mt-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white">Add New Customer</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('customers.store') }}" method="POST" name="frmSaveCustomer" id="frmSaveCustomer">
                            @csrf
                            <div class="form-group">
                                <label for="name">Customer Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="phone">Phone (optional)</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                </div>
                                <div class="form-group col-6">
                                    <label for="email">Email (optional)</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Address (optional)</label>
                                <textarea class="form-control" id="address" name="address"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">Status (default: active)</label>
                                <select id="status"
                                        name="status"
                                        class="form-select form-control cmbSelect2">
                                    {!! $status_list !!}
                                </select>
                            </div>

                            <input type="hidden" id="merchantID" name="merchantID" class="form-control" value="{{ Auth::user()->accountID }}">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary btn-lg pull-right mt-3 btnSaveCustomer" id="btnSaveCustomer">Save Customer</button>
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
            applySelect2([".cmbSelect2"]);
            saveCustomer();
            //applySelect2OnModal(".cmbSelect2", "#addNewSubCategoryModal");
        </script>
    </x-slot>

</x-layouts.master>
