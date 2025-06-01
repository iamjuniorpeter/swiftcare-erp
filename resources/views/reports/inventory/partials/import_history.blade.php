<div class="card">
    <div class="card-header">
        <h5>Import / Upload History Report</h5>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
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
                        <td>{{ $record->item_count }}</td>
                        <td>{{ $record->performed_by }}</td>
                        <td>{{ $record->file_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
