<?php

namespace App\Http\Livewire\LaravelExamples;

use App\Models\User;
use Livewire\Component;

class UserManagement extends Component
{
    public function render()
    {
        /** @var User $users */
        $users = User::all();
        return view('livewire.laravel-examples.user-management', compact('users'));
    }
}
