{{-- Second Row: Address Information --}}
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Assigned Employee</h4>
                @if($isDisabled)
                    <button wire:click="toggleEdit" class="btn btn-sm btn-secondary">
                        @if($isEditing) Cancel Edit @else Edit Employee @endif
                    </button>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <label for="employee-name">Employee Name</label>
                    <input 
                        type="text" 
                        id="employee-name" 
                        wire:model="employeeName" 
                        class="form-control"
                        @if(!$isEditing) disabled @endif
                    >
                    @if($isDisabled)
                        @if($isEditing)
                            <button wire:click="assignEmployee" class="btn btn-primary mt-3">
                                Update Employee
                            </button>
                        @else
                            <button wire:click="assignEmployee" class="btn btn-primary mt-3">
                                Assign Employee
                            </button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
