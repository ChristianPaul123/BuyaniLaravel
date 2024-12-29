<section class="min-height">
    <div>
        <div class="table-responsive">
            <table id="currentvotesTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Suggested By</th>
                        <th>Suggestion Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Verified By</th>
                        <th>Total Votes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suggestions as $suggestion)
                    <tr>
                        <td>{{ $suggestion->user->username ?? 'N/A' }}</td>
                        <td>{{ $suggestion->suggest_name }}</td>
                        <td>{{ $suggestion->suggest_description }}</td>
                        <td>
                            @if ($suggestion->suggest_image)
                                <img src="{{ asset($suggestion->suggest_image) }}" alt="Suggested Image" class="img-thumbnail" width="100">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ $suggestion->is_accepted ? 'Accepted' : 'Pending' }}</td>
                        <td>{{ $suggestion->admin->username ?? 'N/A' }}</td>
                        <td>{{ $suggestion->total_vote_count }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
