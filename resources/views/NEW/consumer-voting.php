<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Page with Ranking and Suggestions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
</head>
<body>
<div class="container my-5">
    <h1 class="text-center mb-4">Vote for Your Favorite Options</h1>
    <div class="row">
        <!-- Voting Form Section -->
        <div class="col-md-6">
            <h3>Vote Here</h3>
            <form id="voteForm">
                <div class="form-group mb-3">
                    <label for="option">Select Option:</label>
                    <select id="option" class="form-control">
                        <option value="Option 1">Option 1</option>
                        <option value="Option 2">Option 2</option>
                        <option value="Option 3">Option 3</option>
                        <option value="Option 4">Option 4</option>
                        <option value="Option 5">Option 5</option>
                        <option value="Option 6">Option 6</option>
                        <option value="Option 7">Option 7</option>
                        <option value="Option 8">Option 8</option>
                        <option value="Option 9">Option 9</option>
                        <option value="Option 10">Option 10</option>
                    </select>
                </div>
                <button type="button" class="btn btn-primary" onclick="vote()">Vote</button>
            </form>
        </div>
        
        <!-- Ranking Section -->
        <div class="col-md-6">
            <h3>Ranking</h3>
            <ul id="ranking" class="list-group">
                <!-- List items for 10 options -->
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Option 1 <span id="count1" class="badge bg-primary rounded-pill">0</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Option 2 <span id="count2" class="badge bg-primary rounded-pill">0</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Option 3 <span id="count3" class="badge bg-primary rounded-pill">0</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Option 4 <span id="count4" class="badge bg-primary rounded-pill">0</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Option 5 <span id="count5" class="badge bg-primary rounded-pill">0</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Option 6 <span id="count6" class="badge bg-primary rounded-pill">0</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Option 7 <span id="count7" class="badge bg-primary rounded-pill">0</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Option 8 <span id="count8" class="badge bg-primary rounded-pill">0</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Option 9 <span id="count9" class="badge bg-primary rounded-pill">0</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Option 10 <span id="count10" class="badge bg-primary rounded-pill">0</span>
                </li>
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
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirmModal">Submit Suggestion</button>
        </form>
        <ul id="suggestionsList" class="list-group mt-3"></ul>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to proceed with this action?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal"  data-toggle="modal" data-target="#successModal">Yes, Proceed</button>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Your operation was successful!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="submitSuggestion()" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>


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

    // Initialize Sortable for dynamic ordering
    new Sortable(document.getElementById("ranking"), {
        animation: 150
    });
</script>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
