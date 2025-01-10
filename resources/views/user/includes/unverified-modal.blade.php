<div class="modal fade" id="verificationModal" tabindex="-1" aria-labelledby="verificationModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="verificationModalLabel">Verification Required</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p><i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i></p>
                <p>You must get verified first to access this functionality!</p>
                <p>If you have already submitted your documents, please wait for the admin to verify your account.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="/user/farmer/profile" class="btn btn-primary">Get Verified</a>
            </div>
        </div>
    </div>
</div>

<script>
    function showVerificationModal() {
        $('#verificationModal').modal('show');
    }
</script>