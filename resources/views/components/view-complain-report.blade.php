<div class="row p-4">
    <div class="col-lg-12">
        <div class="card component-card_4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Type</th>
                                <th>Complain</th>
                                <th>Resolution</th>
                                <th>Outcome</th>
                                <th>Status</th>
                                <th>Date Created</th>
                                @if($report_category == 'nrp')
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                @endif
                                @if($report_category == 'enrollee')
                                    <th>Enrollee</th>
                                @endif
                                @if($report_category == 'state')
                                    <th>State</th>
                                @endif
                                @if($report_category == 'hcp')
                                    <th>HCP</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($records as $record)                            
                                <tr>
                                    <td class="align-top">{{ $record->reference }}</td>
                                    <td class="align-top">{{ $record->type_of_complain->name }}</td>
                                    <td class="align-top">{{ $record->complain }}</td>
                                    <td class="align-top">{{ $record->resolution }}</td>
                                    <td class="align-top">{{ $record->outcome }}</td>
                                    <td class="align-top">{{ $record->status }}</td>
                                    <td class="align-top">{{ formatDate($record->created_at) }}</td>
                                    @if($report_category == 'nrp')
                                        <td class="align-top">{{ $record->name }}</td>
                                        <td class="align-top">{{ $record->email }}</td>
                                        <td class="align-top">{{ $record->phone }}</td>
                                    @endif
                                    @if($report_category == 'enrollee')
                                        <td>{{ $record->enrollee_complain->surname }} {{ $record->enrollee_complain->first_name }} {{ $record->enrollee_complain->middle_name }} ({{ $record->enrollee_complain->id_number }})</td>
                                    @endif
                                    @if($report_category == 'state')
                                        <td>{{ $record->state_of_complain->state_name }}</td>
                                    @endif
                                    @if($report_category == 'hcp')
                                        <td>{{ $record->hcp_of_complain->hcp_name }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>