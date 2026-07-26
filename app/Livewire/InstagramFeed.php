<?php

namespace App\Livewire;

use App\Models\InstagramAccount;
use App\Models\InstagramMedia;
use App\Services\InstagramSyncService;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Integrasi Instagram')]
class InstagramFeed extends Component
{
    use WithPagination;

    public string $search = '';

    public function toggleVisibility(int $mediaId): void
    {
        $media = InstagramMedia::find($mediaId);
        if ($media) {
            $media->is_visible = ! $media->is_visible;
            $media->save();
            $this->dispatch('notify', message: 'Status visibilitas postingan berhasil diubah.');
        }
    }

    public function render()
    {
        $account = InstagramAccount::query()->first();

        $mediaItems = collect();
        if ($account) {
            $query = InstagramMedia::where('instagram_account_id', $account->id);

            if ($this->search) {
                $query->where('caption', 'like', '%'.$this->search.'%');
            }

            $mediaItems = $query->orderByDesc('posted_at')->paginate(12);
        }

        return view('livewire.instagram-feed', [
            'account' => $account,
            'mediaItems' => $mediaItems,
        ]);
    }
}
