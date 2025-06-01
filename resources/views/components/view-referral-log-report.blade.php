
<div class="row p-4">
    <div class="col-lg-12">
        <div class="card component-card_4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Authorization Code</th>
                                <th>Referring HCP</th>
                                <th>Receiving HCP</th>
                                <th>Investigation</th>
                                <th>Drug</th>
                                <th>Status</th>
                                <th>Date Created</th>
                                @if($report_category == 'service')
                                    <th>Service</th>
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
                                    <td class="align-top">{{ $record->authorization_code }}</td>
                                    <td class="align-top">{{ $record->referral_hcp->hcp_name }}</td>
                                    <td class="align-top">{{ $record->receiving_hcp->hcp_name }}</td>
                                    <td class="align-top">{{ $record->investigation->name ?? 'N/A' }}</td>
                                    <td class="align-top">{{ $record->drug->name ?? 'N/A' }}</td>
                                    <td class="align-top">{!! getStatusBadge($record->status) !!}</td>
                                    <td class="align-top">{{ formatDate($record->created_at) }}</td>
                                    
                                    @if($report_category == 'service')
                                        @if($record->referral_hcp->hcp_categoryID == $record->selected_hcp)
                                            <td>{{ $record->referral_hcp->category->category_name }}</td>
                                        @else
                                            <td>{{ $record->receiving_hcp->category->category_name }}</td>
                                        @endif
                                    @endif
                                    @if($report_category == 'enrollee')
                                        <td>{{ $record->encounter->enrollee->surname }} {{ $record->encounter->enrollee->first_name }} {{ $record->encounter->enrollee->middle_name }} ({{ $record->encounter->enrollee->id_number }})</td>
                                    @endif
                                    @if($report_category == 'state')
                                        @if($record->referral_hcp->account_id == $record->selected_state)
                                            <td>{{ $record->referral_hcp->state->state_name }}</td>
                                        @else
                                            <td>{{ $record->receiving_hcp->state->state_name }}</td>
                                        @endif
                                    @endif
                                    @if($report_category == 'hcp')
                                        @if($record->referral_hcp->account_id == $record->selected_hcp)
                                            <td>{{ $record->referral_hcp->hcp_code }}</td>
                                        @else
                                            <td>{{ $record->receiving_hcp->hcp_code }}</td>
                                        @endif
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