<x-layouts.master title="Units" menutitle="Units">
    <div id="content" class="main-content">
      <div class="layout-px-spacing">
         <div class="card mt-3">
             <div class="card-header d-flex justify-content-between align-items-center">
                 <h3>Units</h3>
                 <a href="{{ route('units.create') }}" class="btn btn-primary">Add Unit</a>
             </div>
             <div class="card-body">
                 <table class="table table-bordered">
                     <thead>
                         <tr>
                             <th>ID</th>
                             <th>Merchant ID</th>
                             <th>Unit Name</th>
                             <th>Abbreviation</th>
                             <th>Actions</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach($units as $unit)
                         <tr>
                             <td>{{ $unit->sn }}</td>
                             <td>{{ $unit->merchantID }}</td>
                             <td>{{ $unit->unit_name }}</td>
                             <td>{{ $unit->abbreviation }}</td>
                             <td>
                                 <a href="{{ route('units.show', $unit->sn) }}" class="btn btn-info btn-sm">View</a>
                                 <a href="{{ route('units.edit', $unit->sn) }}" class="btn btn-warning btn-sm">Edit</a>
                                 <form action="{{ route('units.destroy', $unit->sn) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this unit?');">Delete</button>
                                 </form>
                             </td>
                         </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>
         </div>
      </div>
    </div>
</x-layouts.master>
