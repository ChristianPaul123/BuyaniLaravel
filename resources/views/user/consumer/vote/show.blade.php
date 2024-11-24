@extends('layouts.app')

@section('title', 'Voting System')

@section('content')
@include('user.includes.navbar-consumer')

<div class="main-content-wrapper">
    <div class="container my-5">
        <!-- Voting System Header -->
        <div class="text-center mb-4">
            <h1 class="fw-bold" style="color: #6CAF33;">Vote for Your Favorite Options</h1>
            <p class="text-muted">Cast your vote for your favorite options and suggest new ones!</p>
        </div>

        <div class="row">
            <!-- Voting Form Section -->
            <div class="col-md-6">
                <h3>Vote Here</h3>
                <form id="voteForm">
                    <div class="form-group mb-3">
                        <label for="option">Select Option:</label>
                        <select id="option" class="form-control">
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="Option {{ $i }}">Option {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="vote()">Vote</button>
                </form>
            </div>

            <!-- Ranking Section -->
            <div class="col-md-6">
                <h3>Ranking</h3>
                <ul id="ranking" class="list-group">
                    @for ($i = 1; $i <= 10; $i++)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Option {{ $i }} <span id="count{{ $i }}" class="badge bg-primary rounded-pill">0</span>
                        </li>
                    @endfor
                </ul>
            </div>
        </div>

        <!-- Suggestion Box Section -->
        <div class="mt-5">
            <h3>Suggest a New Option</h3>
            <form id="suggestionForm">
                <div class="form-group mb-3">
                    <label for="suggestion">Your Suggestion:</label>
                    <input type="text" id="suggestion" class="form-control" placeholder="Enter your suggestion here">
                </div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal">Submit Suggestion</button>
            </form>
            <ul id="suggestionsList" class="list-group mt-3"></ul>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to proceed with this action?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#successModal">Yes, Proceed</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Your operation was successful!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="submitSuggestion()" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Initialize vote counts for 10 options
    let voteCounts = {};
    for (let i = 1; i <= 10; i++) {
        voteCounts["Option " + i] = 0;
    }

    // Voting function
    function vote() {
        const selectedOption = document.getElementById("option").value;
        voteCounts[selectedOption]++;
        updateRanking();
    }

    // Update the ranking display
    function updateRanking() {
        for (let i = 1; i <= 10; i++) {
            document.getElementById("count" + i).innerText = voteCounts["Option " + i];
        }

        // Sort ranking by vote count
        const ranking = document.getElementById("ranking");
        Array.from(ranking.children)
            .sort((a, b) => parseInt(b.querySelector(".badge").innerText) - parseInt(a.querySelector(".badge").innerText))
            .forEach(item => ranking.appendChild(item));
    }

    // Handle suggestions
    function submitSuggestion() {
        const suggestionText = document.getElementById("suggestion").value.trim();
        if (suggestionText) {
            const suggestionsList = document.getElementById("suggestionsList");
            const suggestionItem = document.createElement("li");
            suggestionItem.className = "list-group-item";
            suggestionItem.textContent = suggestionText;
            suggestionsList.appendChild(suggestionItem);
            document.getElementById("suggestion").value = ""; // Clear input field
        }
    }
</script>
@endpush
