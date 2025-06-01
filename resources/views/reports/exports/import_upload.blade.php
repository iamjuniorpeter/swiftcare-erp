<table class="table style-2 dt-table-hover non-hover myDataTable" style="width:100%">
    <thead>
        <tr>
            <th>Upload Date</th>
            <th>Number of Items Added/Updated</th>
            <th>Performed By</th>
            <th>File Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
            <tr>
                <td>{{ $record->upload_date }}</td>
                <td>{{ $record->items_count }}</td>
                <td>{{ $record->performed_by }}</td>
                <td>{{ $record->file_name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>