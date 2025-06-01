<x-layouts.master title="Warehouses" menutitle="Warehouses">
    <div id="content" class="main-content">
      <div class="layout-px-spacing">
            <div class="col-8 offset-2 mt-3 mb-3">
                <div class="card mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Warehouses</h3>
                        <a href="{{ route('warehouses.create') }}" class="btn btn-primary">Add Warehouse</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Warehouse ID</th>
                                    <th>Merchant ID</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($warehouses as $wh)
                                <tr>
                                    <td>{{ $wh->warehouse_id }}</td>
                                    <td>{{ $wh->merchantID }}</td>
                                    <td>{{ $wh->name }}</td>
                                    <td>{{ $wh->location }}</td>
                                    <td>
                                        <a href="{{ route('warehouses.show', $wh->sn) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('warehouses.edit', $wh->sn) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('warehouses.destroy', $wh->sn) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this warehouse?');">Delete</button>
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
    </div>
</x-layouts.master>
