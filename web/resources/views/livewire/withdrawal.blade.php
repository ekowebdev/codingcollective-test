<div wire:ignore.self class="modal fade" id="withdrawalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Withdrawal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input type="hidden" wire:model="user_id">
                        <label for="exampleFormControlInput1">Name</label>
                        <input type="text" class="form-control" wire:model="name" id="exampleFormControlInput1" placeholder="Enter Name" disabled>
                        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Email</label>
                        <input type="email" class="form-control" wire:model="email" id="exampleFormControlInput2" placeholder="Enter Email" disabled>
                        @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Amount</label>
                        <input type="text" class="form-control" wire:model="amount" id="exampleFormControlInput2" placeholder="Enter Amount">
                        @error('amount') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="withdrawal()" class="btn btn-primary" data-dismiss="modal">Save</button>
            </div>
       </div>
    </div>
</div>