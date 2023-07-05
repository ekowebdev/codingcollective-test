<?php

namespace App\Http\Livewire;

use DateTime;
use Livewire\Component;
use App\Jobs\DepositJob;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class Wallet extends Component
{
    public $users, $userId, $name, $email, $balance, $amount, $url, $updateMode;

    public function __construct(){
        $this->updateMode = false;
        $this->url = env('SERVER_URI') . '/api';
    }

    public function render()
    {
        return view('livewire.wallet', ['users' => $this->getData()]);
    }

    public function getData()
    {
        $url = $this->url . "/users";
        $response = Http::timeout(15)->get($url);
        $this->users = $response->json();

        return $this->users;
    }

    private function resetInputFields(){
        $this->name = '';
        $this->email = '';
        $this->amount = '';
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $url = $this->url . "/user/" . $id;
        $response = Http::timeout(15)->get($url);
        $user = $response->json();

        $this->userId = $id;
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->balance = $user['balance'];
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function deposit()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'amount' => 'required',
        ]);

        $payload = [
            'order_id' => (string) Str::uuid(),
            'user_id' => $this->userId,
            'amount' => $this->amount,
            'timestamp' => (new DateTime)->format('Y-m-d H:i:s'),
        ];

        $response = Http::timeout(15)->withHeaders([
            'Authorization' => 'Bearer ' . base64_encode(env('TOKEN_KEY')),
        ])->post($this->url . '/deposit', $payload);

        if ($response->successful()) {
            $this->getData();
            $this->emit('data-updated');
            $this->message = 'Deposit #' .$response->json()['order_id'] . ' successfully';
        } else {
            $this->message = 'Deposit failed, please try again';
        }

        $this->updateMode = false;
        session()->flash('message', $this->message);
        $this->resetInputFields();
    }

    public function withdrawal()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'amount' => 'required',
        ]);

        $payload = [
            'order_id' => (string) Str::uuid(),
            'user_id' => $this->userId,
            'amount' => $this->amount,
            'timestamp' => (new DateTime)->format('Y-m-d H:i:s'),
        ];

        $response = Http::timeout(15)->withHeaders([
            'Authorization' => 'Bearer ' . base64_encode(env('TOKEN_KEY')),
        ])->post($this->url . '/withdrawal', $payload);

        if ($response->successful()) {
            $this->getData();
            $this->emit('data-updated');
            $this->message = 'Withdrawal #' .$response->json()['order_id'] . ' successfully';
        } else {
            $this->message = 'withdrawal failed, please try again';
        }

        $this->updateMode = false;
        session()->flash('message', $this->message);
        $this->resetInputFields();
    }
}
