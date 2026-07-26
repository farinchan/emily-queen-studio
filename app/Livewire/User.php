<?php

namespace App\Livewire;

use App\Models\User as ModelsUser;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

#[Title('Users')]
class User extends Component
{
    use WithPagination, WithFileUploads;

    public ?int $userId = null;

    public string $search = '';

    public string $filterStatus = 'all'; // all, active, inactive

    public $image;
    public ?string $existingImage = null;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $position = '';
    public string $about = '';
    public string $instagram = '';
    public ?int $order = null;
    public bool $is_show = true;

    // Bulk selection
    public array $selectedUsers = [];
    public bool $selectAll = false;

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
            'order' => 'nullable|integer|min:0',
            'is_show' => 'boolean',
        ];
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
        $this->resetSelection();
    }

    public function updatedFilterStatus(): void
    {
        $this->resetPage();
        $this->resetSelection();
    }

    public function updatedSelectAll(): void
    {
        if ($this->selectAll) {
            $this->selectedUsers = $this->getFilteredUsers()
                ->pluck('id')
                ->map(fn ($id) => (string) $id)
                ->toArray();
        } else {
            $this->selectedUsers = [];
        }
    }

    public function updatedSelectedUsers(): void
    {
        $currentPageIds = $this->getFilteredUsers()
            ->pluck('id')
            ->map(fn ($id) => (string) $id)
            ->toArray();

        $this->selectAll = !empty($currentPageIds)
            && empty(array_diff($currentPageIds, $this->selectedUsers));
    }

    private function resetSelection(): void
    {
        $this->selectedUsers = [];
        $this->selectAll = false;
    }

    public function openCreateModal(): void
    {
        $this->resetForm();
    }

    public function openEditModal(int $userId): void
    {
        $this->resetValidation();
        $this->userId = $userId;
        $user = ModelsUser::findOrFail($userId);
        $this->image = null;
        $this->existingImage = $user->image;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->position = $user->position ?? '';
        $this->about = $user->about ?? '';
        $this->instagram = $user->instagram ?? '';
        $this->order = $user->order;
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
        $this->existingImage = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->position = '';
        $this->about = '';
        $this->instagram = '';
        $this->order = null;
        $this->is_show = true;
        $this->resetValidation();
    }

    public function saveUser(): void
    {
        $this->validate();

        $isEdit = (bool) $this->userId;
        $user = ModelsUser::find($this->userId);

        $imagePath = $user?->image;
        if ($this->image && is_object($this->image)) {
            $filename = Str::random(40).'.'.$this->image->getClientOriginalExtension();
            $this->image->storeAs('users', $filename, 'public');
            $imagePath = 'users/'.$filename;
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
                'order' => $this->order,
                'is_show' => $this->is_show,
            ]
        );

        $this->closeModal();
        $this->dispatch('close-drawer');
        $this->dispatch(
            'notify',
            message: $isEdit ? 'User berhasil diperbarui.' : 'User berhasil ditambahkan.',
        );
    }

    public function deleteUser(int $userId): void
    {
        ModelsUser::destroy($userId);
        $this->selectedUsers = array_values(
            array_diff($this->selectedUsers, [(string) $userId])
        );
        $this->dispatch('notify', message: 'User berhasil dihapus.');
    }

    public function deleteSelected(): void
    {
        if (empty($this->selectedUsers)) {
            return;
        }

        $count = count($this->selectedUsers);
        ModelsUser::whereIn('id', $this->selectedUsers)->delete();
        $this->resetSelection();
        $this->dispatch('notify', message: $count.' user berhasil dihapus.');
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
