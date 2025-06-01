<x-layouts.master title="View Unit" menutitle="View Unit">
    <div id="content" class="main-content">
      <div class="layout-px-spacing">
         <div class="card mt-3">
             <div class="card-header">
                 <h3>Unit Details</h3>
             </div>
             <div class="card-body">
                 <p><strong>ID:</strong> {{ $unit->sn }}</p>
                 <p><strong>Merchant ID:</strong> {{ $unit->merchantID }}</p>
                 <p><strong>Unit Name:</strong> {{ $unit->unit_name }}</p>
                 <p><strong>Abbreviation:</strong> {{ $unit->abbreviation }}</p>
                 <a href="{{ route('units.edit', $unit->sn) }}" class="btn btn-warning">Edit Unit</a>
                 <a href="{{ route('units.index') }}" class="btn btn-secondary">Back to List</a>
             </div>
         </div>
      </div>
    </div>
</x-layouts.master>
