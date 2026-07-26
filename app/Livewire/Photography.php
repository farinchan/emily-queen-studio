<?php

namespace App\Livewire;

use App\Models\Photography as ModelsPhotography;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

#[Title('Photography')]
class Photography extends Component
{
    use WithPagination, WithFileUploads;

    public ?int $photographyId = null;

    public string $search = '';

    public $image;
    public ?string $existingImage = null;
    public string $title = '';
    public string $subtitle = '';
    public string $description = '';
    public string $keywordsInput = '';

    // Bulk selection
    public array $selectedItems = [];
    public bool $selectAll = false;

    protected $paginationTheme = 'tailwind';

    protected function rules(): array
    {
        return [
            'image' => $this->photographyId ? 'nullable|image|max:8192' : 'required|image|max:8192',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'keywordsInput' => 'nullable|string',
        ];
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
        $this->resetSelection();
    }

    public function updatedSelectAll(): void
    {
        if ($this->selectAll) {
            $this->selectedItems = $this->getFilteredItems()
                ->pluck('id')
                ->map(fn ($id) => (string) $id)
                ->toArray();
        } else {
            $this->selectedItems = [];
        }
    }

    public function updatedSelectedItems(): void
    {
        $currentPageIds = $this->getFilteredItems()
            ->pluck('id')
            ->map(fn ($id) => (string) $id)
            ->toArray();

        $this->selectAll = !empty($currentPageIds)
            && empty(array_diff($currentPageIds, $this->selectedItems));
    }

    private function resetSelection(): void
    {
        $this->selectedItems = [];
        $this->selectAll = false;
    }

    public function openCreateModal(): void
    {
        $this->resetForm();
    }

    public function openEditModal(int $photographyId): void
    {
        $this->resetValidation();
        $this->photographyId = $photographyId;
        $photography = ModelsPhotography::findOrFail($photographyId);
        $this->image = null;
        $this->existingImage = $photography->image;
        $this->title = $photography->title ?? '';
        $this->subtitle = $photography->subtitle ?? '';
        $this->description = $photography->description ?? '';
        $this->keywordsInput = is_array($photography->keywords) ? implode(', ', $photography->keywords) : '';
    }

    public function closeModal(): void
    {
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->photographyId = null;
        $this->image = null;
        $this->existingImage = null;
        $this->title = '';
        $this->subtitle = '';
        $this->description = '';
        $this->keywordsInput = '';
        $this->resetValidation();
    }

    public function savePhotography(): void
    {
        $this->validate();

        $isEdit = (bool) $this->photographyId;
        $photography = ModelsPhotography::find($this->photographyId);

        $imagePath = $photography?->getRawOriginal('image');
        if ($this->image && is_object($this->image)) {
            $filename = Str::random(40).'.'.$this->image->getClientOriginalExtension();
            $this->image->storeAs('photographies', $filename, 'public');
            $imagePath = 'photographies/'.$filename;
        }

        $keywords = !empty($this->keywordsInput)
            ? array_values(array_filter(array_map('trim', explode(',', $this->keywordsInput))))
            : null;

        ModelsPhotography::updateOrCreate(
            ['id' => $this->photographyId],
            [
                'image' => $imagePath,
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'description' => $this->description,
                'keywords' => $keywords,
            ]
        );

        $this->closeModal();
        $this->dispatch('close-drawer');
        $this->dispatch(
            'notify',
            message: $isEdit ? 'Photography berhasil diperbarui.' : 'Photography berhasil ditambahkan.',
        );
    }

    public function deletePhotography(int $photographyId): void
    {
        ModelsPhotography::destroy($photographyId);
        $this->selectedItems = array_values(
            array_diff($this->selectedItems, [(string) $photographyId])
        );
        $this->dispatch('notify', message: 'Photography berhasil dihapus.');
    }

    public function deleteSelected(): void
    {
        if (empty($this->selectedItems)) {
            return;
        }

        $count = count($this->selectedItems);
        ModelsPhotography::whereIn('id', $this->selectedItems)->delete();
        $this->resetSelection();
        $this->dispatch('notify', message: $count.' item photography berhasil dihapus.');
    }

    public function getFilteredItems(): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = ModelsPhotography::query();

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('subtitle', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%");
            });
        }

        return $query->orderBy('id', 'desc')->paginate(10);
    }

    public function render()
    {
        $items = $this->getFilteredItems();

        return view('livewire.photography', [
            'items' => $items,
        ]);
    }
}
