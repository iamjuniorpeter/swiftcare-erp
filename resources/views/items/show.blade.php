<x-layouts.master title="View Item" menutitle="View Item">
    <x-slot name="styles"></x-slot>

    <div id="content" class="main-content">
       <div class="layout-px-spacing">
           <div class="card mt-3">
               <div class="card-header">
                   <h3>Item Details</h3>
               </div>
               <div class="card-body">
                   <p><strong>Item ID:</strong> {{ $item->item_id }}</p>
                   <p><strong>Item Code:</strong> {{ $item->item_code }}</p>
                   <p><strong>Name:</strong> {{ $item->name }}</p>
                   <p><strong>Description:</strong> {{ $item->description }}</p>
                   <!-- Add more fields as needed -->
                   <a href="{{ route('items.edit', $item->sn) }}" class="btn btn-warning">Edit Item</a>
                   <a href="{{ route('items.index') }}" class="btn btn-secondary">Back to List</a>
               </div>
           </div>
       </div>
    </div>

    <x-slot name="scripts"></x-slot>
</x-layouts.master>
