<?php

namespace App\Livewire;

use App\Models\User as ModelsUser;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class User extends Component
{
    public ?int $userId = null;

    public string $search = '';

    public $image;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $position = '';
    public string $about = '';
    public string $instagram = '';
    public bool $is_show = true;

    protected function rules(): array
    {
        return [
            'image' => 'nullable|image|max:8192',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$this->userId,
            'password' => $this->userId ? 'nullable|string|min:8' : 'required|string|min:8',
            'position' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'instagram' => 'nullable|string|max:255',
            'is_show' => 'boolean',
        ];
    }

    public function openCreateModal(): void
    {
        $this->resetForm();
    }

    public function openEditModal(int $userId): void
    {
        $this->userId = $userId;
        $user = ModelsUser::findOrFail($userId);
        $this->image = $user->image;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->position = $user->position;
        $this->about = $user->about;
        $this->instagram = $user->instagram;
        $this->is_show = $user->is_show;
    }

    public function closeModal(): void
    {
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->userId = null;
        $this->resetValidation();
    }

    public function saveUser(): void
    {
        $user = ModelsUser::find($this->userId);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->storeAs('public/images', Str::random(40).'.'.$this->image->getClientOriginalExtension());
        }else {
            $imagePath = $user ? $user->image : null;
        }

        ModelsUser::updateOrCreate(
            ['id' => $this->userId],
            [
                'image' => $imagePath,
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password ? bcrypt($this->password) : ($user ? $user->password : null),
                'position' => $this->position,
                'about' => $this->about,
                'instagram' => $this->instagram,
                'is_show' => $this->is_show,
            ]
        );
    }

    public function render()
    {
        $data = [
            'users' => ModelsUser::all(),
            'roles' => Role::all(),
        ];

        return view('livewire.user', $data);
    }
}
