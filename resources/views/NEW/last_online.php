<!-- required -->
@include('user.includes.popup-style')

@if()
<!-- Last Online -->
<div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
  <div class="modal-dialog modal-dialog-centered mobile-modal">
          <div class="modal-content">
            <i class="close bi bi-x" aria-label="Close" wire:click="$set('showEmailModal', false)" data-bs-dismiss="modal"></i>
            <i class="icon icon-bg-info bi bi-exclamation-diamond"></i>
            <div class="container-contents container-contents-info">
                <h3>TEXT HERE</h3>
                <form>
                    <label for="email" class="form-label">TEXT HERE</label>
                    <br>
                    <button data-bs-dismiss="modal" type="button" class="btn btn-primary mt-3" style="width:100px;">OK</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

<!-- not required -->
@include('user.includes.popup-js')
