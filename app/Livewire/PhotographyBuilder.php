<?php

namespace App\Livewire;

use App\Models\Photography;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.builder')]
#[Title('GrapesJS Page Builder')]
class PhotographyBuilder extends Component
{
    public Photography $photography;
    public string $content = '';

    public function mount(Photography $photography): void
    {
        $this->photography = $photography;
        $this->content = $photography->content ?? '';
    }

    public function saveContent(string $content): void
    {
        $this->photography->update(['content' => $content]);
        $this->content = $content;
        $this->dispatch('notify', message: 'Konten GrapesJS berhasil disimpan!');
    }

    public function render()
    {
        return view('livewire.photography-builder');
    }
}
