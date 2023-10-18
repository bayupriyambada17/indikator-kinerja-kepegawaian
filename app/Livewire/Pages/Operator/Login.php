<?php

namespace App\Livewire\Pages\Operator;

use Livewire\Component;

class Login extends Component
{
    public $users, $email, $password, $name;
    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }
    public function login()
    {
        $validatedDate = $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (auth()->attempt(array('email' => $this->email, 'password' => $this->password))) {
            if (auth()->user()->roles == 1) {
                session()->flash('message', "You have been successfully login.");
                return redirect(route('rektor.dashboard'));
            } else if (auth()->user()->roles == 2) {
                session()->flash('message', "You have been successfully login.");
                return redirect(route('operator.dashboard'));
            }
        } else {
            session()->flash('error', 'email and password are wrong.');
            return redirect(route('operator.login'));
        }
    }
    public function render()
    {
        return view('livewire.pages.operator.login')->layout('layouts.auth');
    }
}
