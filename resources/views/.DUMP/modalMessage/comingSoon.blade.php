<style>
    .custom-container {
        background-color: #3F6F23;
        font-family: 'Poppins', sans-serif;
        color: aliceblue;
        border: 3px solid black;
        border-radius: 15px;
    }
</style>

<!-- Error Message Modal -->
<div class="modal fade" id="pendingMessageModal" tabindex="-1" role="dialog" aria-labelledby="pendingMessageModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content px-2 pt-3 custom-container">
            <div class="container d-flex align-items-center justify-content-between">
                <h3 class="modal-title" id="pendingMessageModal" style="font-size: 35px; font-weight: bold;">Coming Soon!</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 35px; color: red; background-color: transparent; border: transparent;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body py-2 mx-2">
                    <p>An error has occurred. Please try again later.</p>
                </div>
        </div>
    </div>
</div>