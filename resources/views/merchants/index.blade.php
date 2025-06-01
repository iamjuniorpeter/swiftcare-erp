<x-layouts.master title="Merchants" menutitle="Merchants">
    <x-slot name="styles">
        <!-- Include any page-specific styles -->
    </x-slot>
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Merchants</h3>
                    <a href="{{ route('merchants.create') }}" class="btn btn-primary">Add New Merchant</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Merchant ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($merchants as $merchant)
                            <tr>
                                <td>{{ $merchant->merchantID }}</td>
                                <td>{{ $merchant->name }}</td>
                                <td>{{ $merchant->email }}</td>
                                <td>
                                    <a href="{{ route('merchants.show', $merchant->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('merchants.edit', $merchant->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('merchants.destroy', $merchant->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Are you sure you want to delete this merchant?');">
                                            Delete
                                        </button>
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
    <x-slot name="scripts">
        <!-- Include page-specific scripts -->
    </x-slot>
</x-layouts.master>
