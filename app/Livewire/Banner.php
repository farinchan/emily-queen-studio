<?php

namespace App\Livewire;

use App\Models\Banner as ModelsBanner;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

#[Title('Banners')]
class Banner extends Component
{
    use WithPagination, WithFileUploads;

    public ?int $bannerId = null;

    public string $search = '';

    public $image;
    public ?string $existingImage = null;
    public string $label = '';
    public string $title = '';
    public string $subtitle = '';
    public string $link = '';

    // Bulk selection
    public array $selectedBanners = [];
    public bool $selectAll = false;

    protected $paginationTheme = 'tailwind';

    protected function rules(): array
    {
        return [
            'image' => $this->bannerId ? 'nullable|image|max:8192' : 'required|image|max:8192',
            'title' => 'required|string|max:255',
            'label' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
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
            $this->selectedBanners = $this->getFilteredBanners()
                ->pluck('id')
                ->map(fn ($id) => (string) $id)
                ->toArray();
        } else {
            $this->selectedBanners = [];
        }
    }

    public function updatedSelectedBanners(): void
    {
        $currentPageIds = $this->getFilteredBanners()
            ->pluck('id')
            ->map(fn ($id) => (string) $id)
            ->toArray();

        $this->selectAll = !empty($currentPageIds)
            && empty(array_diff($currentPageIds, $this->selectedBanners));
    }

    private function resetSelection(): void
    {
        $this->selectedBanners = [];
        $this->selectAll = false;
    }

    public function openCreateModal(): void
    {
        $this->resetForm();
    }

    public function openEditModal(int $bannerId): void
    {
        $this->resetValidation();
        $this->bannerId = $bannerId;
        $banner = ModelsBanner::findOrFail($bannerId);
        $this->image = null;
        $this->existingImage = $banner->image;
        $this->title = $banner->title;
        $this->label = $banner->label ?? '';
        $this->subtitle = $banner->subtitle ?? '';
        $this->link = $banner->link ?? '';
    }

    public function closeModal(): void
    {
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->bannerId = null;
        $this->image = null;
        $this->existingImage = null;
        $this->title = '';
        $this->label = '';
        $this->subtitle = '';
        $this->link = '';
        $this->resetValidation();
    }

    public function saveBanner(): void
    {
        $this->validate();

        $isEdit = (bool) $this->bannerId;
        $banner = ModelsBanner::find($this->bannerId);

        $imagePath = $banner?->getRawOriginal('image');
        if ($this->image && is_object($this->image)) {
            $filename = Str::random(40).'.'.$this->image->getClientOriginalExtension();
            $this->image->storeAs('banners', $filename, 'public');
            $imagePath = 'banners/'.$filename;
        }

        ModelsBanner::updateOrCreate(
            ['id' => $this->bannerId],
            [
                'image' => $imagePath,
                'title' => $this->title,
                'label' => $this->label,
                'subtitle' => $this->subtitle,
                'link' => $this->link,
            ]
        );

        $this->closeModal();
        $this->dispatch('close-drawer');
        $this->dispatch(
            'notify',
            message: $isEdit ? 'Banner berhasil diperbarui.' : 'Banner berhasil ditambahkan.',
        );
    }

    public function deleteBanner(int $bannerId): void
    {
        ModelsBanner::destroy($bannerId);
        $this->selectedBanners = array_values(
            array_diff($this->selectedBanners, [(string) $bannerId])
        );
        $this->dispatch('notify', message: 'Banner berhasil dihapus.');
    }

    public function deleteSelected(): void
    {
        if (empty($this->selectedBanners)) {
            return;
        }

        $count = count($this->selectedBanners);
        ModelsBanner::whereIn('id', $this->selectedBanners)->delete();
        $this->resetSelection();
        $this->dispatch('notify', message: $count.' banner berhasil dihapus.');
    }

    public function getFilteredBanners(): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = ModelsBanner::query();

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('label', 'like', "%{$this->search}%")
                  ->orWhere('subtitle', 'like', "%{$this->search}%")
                  ->orWhere('link', 'like', "%{$this->search}%");
            });
        }

        return $query->orderBy('id', 'desc')->paginate(10);
    }

    public function render()
    {
        $banners = $this->getFilteredBanners();

        return view('livewire.banner', [
            'banners' => $banners,
        ]);
    }
}
