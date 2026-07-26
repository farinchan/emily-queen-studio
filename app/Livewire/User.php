<?php

namespace App\Livewire;

use App\Models\User as ModelsUser;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

#[Title('Users')]
class User extends Component
{
    use WithPagination;

    public ?int $userId = null;

    public string $search = '';

    public string $filterStatus = 'all'; // all, active, inactive

    public $image;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $position = '';
    public string $about = '';
    public string $instagram = '';
    public bool $is_show = true;
    public bool $showDrawer = false;

    protected $paginationTheme = 'tailwind';

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

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilterStatus(): void
    {
        $this->resetPage();
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
        $this->is_show = (bool) $user->is_show;
    }

    public function closeModal(): void
    {
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->userId = null;
        $this->image = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->position = '';
        $this->about = '';
        $this->instagram = '';
        $this->is_show = true;
        $this->resetValidation();
    }

    public function saveUser(): void
    {
        $this->validate();

        $user = ModelsUser::find($this->userId);

        $imagePath = $user?->image;
        if ($this->image && is_object($this->image)) {
            $imagePath = $this->image->storeAs('public/images', Str::random(40).'.'.$this->image->getClientOriginalExtension());
        }

        ModelsUser::updateOrCreate(
            ['id' => $this->userId],
            [
                'image' => $imagePath,
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password ? bcrypt($this->password) : ($user?->password),
                'position' => $this->position,
                'about' => $this->about,
                'instagram' => $this->instagram,
                'is_show' => $this->is_show,
            ]
        );

        $this->closeModal();
    }

    public function deleteUser(int $userId): void
    {
        ModelsUser::destroy($userId);
    }

    public function toggleShow(int $userId): void
    {
        $user = ModelsUser::findOrFail($userId);
        $user->update(['is_show' => !(bool) $user->is_show]);
    }

    public function getFilteredUsers(): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = ModelsUser::query();

        // Search by name, email, or position
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('email', 'like', "%{$this->search}%")
                  ->orWhere('position', 'like', "%{$this->search}%");
            });
        }

        // Filter by status
        match ($this->filterStatus) {
            'active' => $query->where('is_show', true),
            'inactive' => $query->where('is_show', false),
            default => null,
        };

        return $query->orderBy('order', 'asc')
                     ->orderBy('name', 'asc')
                     ->paginate(10);
    }

    public function render()
    {
        $users = $this->getFilteredUsers();
        $totalFiltered = ModelsUser::when(!empty($this->search), function ($q) {
            $q->where(function ($sub) {
                $sub->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%")
                    ->orWhere('position', 'like', "%{$this->search}%");
            });
        })->when($this->filterStatus === 'active', fn ($q) => $q->where('is_show', true))
          ->when($this->filterStatus === 'inactive', fn ($q) => $q->where('is_show', false))
          ->count();

        return view('livewire.user', [
            'users' => $users,
            'totalFiltered' => $totalFiltered,
        ]);
    }
}
