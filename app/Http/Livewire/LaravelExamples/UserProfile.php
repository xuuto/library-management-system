<?php

namespace App\Http\Livewire\LaravelExamples;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserProfile extends Component
{
    use WithFileUploads;

    public User $user;
    public bool $showSuccesNotification  = false;
    public $image_url;

    public bool $showDemoNotification = false;

    protected  $rules = [
        'user.name' => 'max:40|min:3',
        'user.email' => 'email:rfc,dns',
        'user.phone' => 'max:10',
        'user.about' => 'max:200',
        'user.location' => 'min:3',
        'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif',
    ];

    public function mount(): void
    {
        $this->user = auth()->user();
//        dd($this->user);
//        dd($this->user);

    }

    public function save(): void
    {
        if(env('IS_DEMO')) {
           $this->showDemoNotification = true;
        } else {
            $this->validate();
            if ($this->image_url) {
                $imagePath = $this->image_url->store('images', 'public');
//                    dd($imagePath);
                $this->user->image_url = $imagePath;
            }
            $this->user->save();
            $this->showSuccesNotification = true;
        }
    }
    public function render()
    {
        return view(view: 'livewire.laravel-examples.user-profile');
    }
}
