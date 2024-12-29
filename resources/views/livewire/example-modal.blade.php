<div>
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Example</h5>
                </div>
                <div class="modal-body">
                    {{ $message }}
                    {{ $dirtyString }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="removeDirty()">Change Password</button>
                </div>
            </div>
        </div>
    </div>

</div>

@script
<script>
    document.addEventListener('livewire:initialized',()=>{

      @this.on('show-modal',(event)=>{
        var myModalEl=document.querySelector('#exampleModal');

        var modal=bootstrap.Modal.getOrCreateInstance(myModalEl)

        myModalEl.addEventListener('hidden.bs.modal', () => {
                @this.dispatch('testtest'); // Call the Livewire method to reset variables
            });
      })
    })
  </script>
@endscript
