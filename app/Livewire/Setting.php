<?php

namespace App\Livewire;

use App\Models\Setting as SettingModel;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Pengaturan Website')]
class Setting extends Component
{
    use WithFileUploads;

    public string $site_name = '';
    public string $site_description = '';
    public string $site_keyword = '';
    public $site_logo;
    public ?string $existing_site_logo = null;
    public $site_favicon;
    public ?string $existing_site_favicon = null;
    public string $address = '';
    public string $maps_embed = '';
    public string $instagram = '';
    public string $facebook = '';
    public string $youtube = '';
    public string $whatsapp = '';

    public function mount(): void
    {
        $this->site_name = SettingModel::get('site_name', 'Emily Queen Studio');
        $this->site_description = SettingModel::get('site_description', '');
        $this->site_keyword = SettingModel::get('site_keyword', '');
        $this->existing_site_logo = SettingModel::get('site_logo', null);
        $this->existing_site_favicon = SettingModel::get('site_favicon', null);
        $this->address = SettingModel::get('address', '');
        $this->maps_embed = SettingModel::get('maps_embed', '');
        $this->instagram = SettingModel::get('instagram', '');
        $this->facebook = SettingModel::get('facebook', '');
        $this->youtube = SettingModel::get('youtube', '');
        $this->whatsapp = SettingModel::get('whatsapp', '');
    }

    public function save(): void
    {
        $this->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'site_keyword' => 'nullable|string',
            'site_logo' => 'nullable|image|max:8192',
            'site_favicon' => 'nullable|image|max:2048',
            'address' => 'nullable|string',
            'maps_embed' => 'nullable|string',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
        ]);

        if ($this->site_logo && is_object($this->site_logo)) {
            $filename = Str::random(40).'.'.$this->site_logo->getClientOriginalExtension();
            $this->site_logo->storeAs('settings', $filename, 'public');
            $logoPath = 'settings/'.$filename;
            SettingModel::set('site_logo', $logoPath);
            $this->existing_site_logo = $logoPath;
            $this->site_logo = null;
        }

        if ($this->site_favicon && is_object($this->site_favicon)) {
            $filename = Str::random(40).'.'.$this->site_favicon->getClientOriginalExtension();
            $this->site_favicon->storeAs('settings', $filename, 'public');
            $faviconPath = 'settings/'.$filename;
            SettingModel::set('site_favicon', $faviconPath);
            $this->existing_site_favicon = $faviconPath;
            $this->site_favicon = null;
        }

        SettingModel::set('site_name', $this->site_name);
        SettingModel::set('site_description', $this->site_description);
        SettingModel::set('site_keyword', $this->site_keyword);
        SettingModel::set('address', $this->address);
        SettingModel::set('maps_embed', $this->maps_embed);
        SettingModel::set('instagram', $this->instagram);
        SettingModel::set('facebook', $this->facebook);
        SettingModel::set('youtube', $this->youtube);
        SettingModel::set('whatsapp', $this->whatsapp);

        $this->dispatch('notify', message: 'Pengaturan website berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.setting');
    }
}
