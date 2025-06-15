
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Item</th>
            <th>Available Quantity</th>
            <th>Reorder Level</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->batches_sum_quantity ?? 0 }}</td>
                <td>{{ $item->reorder_level }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
