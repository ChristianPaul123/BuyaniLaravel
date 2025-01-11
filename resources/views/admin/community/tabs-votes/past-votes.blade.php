<section class="min-height">
    <div>
        <div class="table-responsive">
            <table id="pastvotesTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Verified By</th>
                        <th>Suggestion Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Total Votes</th>
                        <th>Transfer Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productSuggestionRecord as $record)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $record->username ?? 'N/A' }}</td>
                        <td>{{ $record->admin->username ?? 'N/A' }}</td>
                        <td>{{ $record->suggest_name }}</td>
                        <td>{{ $record->suggest_description }}</td>

                        {{-- IMAGE --}}
                        <td>
                            @if ($record->suggest_image)
                            <img src="{{ $record->suggest_image ? asset('storage/'.$record->suggest_image) : asset('img/logo1.svg') }}"  alt="Suggested Image" class="img-thumbnail" width="80">
                            @else
                                No Image
                            @endif
                        </td>

                        {{-- TOTAL VOTES --}}
                        <td>{{ $record->total_vote_count }}</td>

                        {{-- TRANSFER DATE --}}
                        <td>{{ $record->transfer_date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
