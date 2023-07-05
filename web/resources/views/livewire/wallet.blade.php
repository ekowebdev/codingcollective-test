<div>
    @include('livewire.deposit')
    @include('livewire.withdrawal')
    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
          {{ session('message') }}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered mt-5" wire:init="getData">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Balance</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $value)
                <tr>
                    <td>{{ $value['id'] }}</td>
                    <td>{{ $value['name'] }}</td>
                    <td>{{ $value['email'] }}</td>
                    <td>{{ $value['balance'] }}</td>
                    <td>
                    <button data-toggle="modal" data-target="#depositModal" wire:click="edit({{ $value['id'] }})" class="btn btn-success btn-sm">Deposit</button>
                    <button data-toggle="modal" data-target="#withdrawalModal" wire:click="edit({{ $value['id'] }})" class="btn btn-danger btn-sm">Withdrawal</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
