<section class="min-height">
    <div>
        <div class="table-responsive">
            <table id="pastvotedTable" class="table table-bordered">
              <thead>
                    <tr>
                        <th>#</th>
                        <th>suggest name</th>
                        <th>suggest description</th>
                        <th>suggest image</th>
                        <th>total vote count</th>
                        <th>transfer_date</th>
                        <th>username</th>
                        <th>verified_by</th>
                        <th>View</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($votedproducts as $votedproduct)
                    <tr>
                        <td>{{ $votedproduct->email }}</td>
                        <td>{{ $votedproduct->username }}</td>
                        <td>{{ $votedproduct->email }}</td>
                        <td>{{ $votedproduct->email }}</td>
                        <td>{{ $votedproduct->email }}</td>
                        <td>{{ $votedproduct->phone_number }}</td>
                        <td>{{ $votedproduct->status == 1 ? 'Active' : 'Inactive' }}</td>
                        <td>{{ $votedproduct->last_online }}</td>
                        <td class="table-action-buttons">
                        </td>
                        <td>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

