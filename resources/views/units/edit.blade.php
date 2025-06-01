<x-layouts.master title="Edit Unit" menutitle="Edit Unit">
    <x-slot name="styles">
    </x-slot>

    <div id="content" class="main-content">
      <div class="layout-px-spacing">
        <div class="col-12 mt-3 mb-3 mt-3 pull-right" style="text-align:right">
                <a href="{{ route('units.create') }}" class="btn-lg btn btn-primary">View Units</a>
        </div>

        <div class="col-8 offset-2 mt-3 mb-3">
            <div class="card mt-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Edit Unit</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('units.update', $unit->sn) }}" method="POST" name="frmSaveUnit" id="frmSaveUnit">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="unit_name">Unit Name</label>
                            <input type="text" class="form-control" id="unit_name" name="unit_name" value="{{ $unit->unit_name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="abbreviation">Abbreviation</label>
                            <input type="text" class="form-control" id="abbreviation" name="abbreviation" value="{{ $unit->abbreviation }}">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 btnSaveUnit" name="btnSaveUnit" id="btnSaveUnit">Update Unit</button>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>

    <x-slot name="scripts">
        <script>
            saveUnit();
        </script>
    </x-slot>
</x-layouts.master>
