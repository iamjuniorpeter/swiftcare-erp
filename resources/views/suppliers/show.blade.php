<x-layouts.master title="View Supplier" menutitle="View Supplier">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>
    <div id="content" class="main-content">
       <div class="layout-px-spacing">
          <div class="card mt-3">
              <div class="card-header">
                  <h3>Supplier Details</h3>
              </div>
              <div class="card-body">
                  <p><strong>Supplier ID:</strong> {{ $supplier->supplier_id }}</p>
                  <p><strong>Name:</strong> {{ $supplier->name }}</p>
                  <p><strong>Contact Person:</strong> {{ $supplier->contact_person }}</p>
                  <p><strong>Phone:</strong> {{ $supplier->phone }}</p>
                  <p><strong>Email:</strong> {{ $supplier->email }}</p>
                  <!-- Add more fields as needed -->
                  <a href="{{ route('suppliers.edit', $supplier->sn) }}" class="btn btn-warning">Edit Supplier</a>
                  <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Back to List</a>
              </div>
          </div>
       </div>
    </div>
    <x-slot name="scripts">
        <script src="{{ asset('@assets/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
        <script>
            applyDataTable();
            saveUnit();
        </script>
    </x-slot>
</x-layouts.master>
