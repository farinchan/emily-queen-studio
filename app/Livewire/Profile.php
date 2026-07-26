<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Profil Saya')]
class Profile extends Component
{
    use WithFileUploads;

    // Profile Details
    public $image;
    public ?string $existingImage = null;
    public string $name = '';
    public string $email = '';
    public string $position = '';
    public string $instagram = '';
    public string $about = '';

    // Password Change
    public string $current_password = '';
    public string $new_password = '';
    public string $new_password_confirmation = '';

    // Session Logout Modal / Action
    public bool $confirmingLogout = false;
    public string $logout_password = '';

    public function mount(): void
    {
        /** @var User $user */
        $user = Auth::user();

        $this->name = $user->name ?? '';
        $this->email = $user->email ?? '';
        $this->position = $user->position ?? '';
        $this->instagram = $user->instagram ?? '';
        $this->about = $user->about ?? '';
        $this->existingImage = $user->image;
    }

    public function updateProfile(): void
    {
        /** @var User $user */
        $user = Auth::user();

        $this->validate([
            'image' => 'nullable|image|max:8192',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'position' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'about' => 'nullable|string',
        ]);

        $imagePath = $user->image;
        if ($this->image && is_object($this->image)) {
            $filename = Str::random(40).'.'.$this->image->getClientOriginalExtension();
            $this->image->storeAs('users', $filename, 'public');
            $imagePath = 'users/'.$filename;
            $this->existingImage = $imagePath;
            $this->image = null;
        }

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'position' => $this->position,
            'instagram' => $this->instagram,
            'about' => $this->about,
            'image' => $imagePath,
        ]);

        $this->dispatch('close-drawer');
        $this->dispatch('notify', message: 'Profil Anda berhasil diperbarui.');
    }

    public function updatePassword(): void
    {
        $this->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        /** @var User $user */
        $user = Auth::user();

        $user->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->current_password = '';
        $this->new_password = '';
        $this->new_password_confirmation = '';

        $this->dispatch('close-password-drawer');
        $this->dispatch('notify', message: 'Password Anda berhasil diperbarui.');
    }

    public function confirmLogout(): void
    {
        $this->resetValidation('logout_password');
        $this->logout_password = '';
        $this->confirmingLogout = true;
    }

    public function cancelLogout(): void
    {
        $this->confirmingLogout = false;
        $this->logout_password = '';
    }

    public function logoutOtherSessions(): void
    {
        $this->validate([
            'logout_password' => ['required', 'current_password'],
        ]);

        $userId = Auth::id();
        $currentSessionId = session()->getId();

        if (Auth::check()) {
            Auth::logoutOtherDevices($this->logout_password);
        }

        try {
            DB::table('sessions')
                ->where('user_id', $userId)
                ->when($currentSessionId, function ($q) use ($currentSessionId) {
                    $q->where('id', '!=', $currentSessionId);
                })
                ->delete();
        } catch (\Throwable $e) {}

        $this->confirmingLogout = false;
        $this->logout_password = '';

        $this->dispatch('notify', message: 'Seluruh sesi di perangkat lain telah dikeluarkan.');
    }

    public function logoutSession(string $sessionId): void
    {
        if ($sessionId === request()->session()->getId()) {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
            $this->redirect(route('login'));
            return;
        }

        if (config('session.driver') === 'database') {
            DB::table('sessions')
                ->where('user_id', Auth::id())
                ->where('id', $sessionId)
                ->delete();
        }

        $this->dispatch('notify', message: 'Sesi perangkat berhasil dikeluarkan.');
    }

    public function getSessionsProperty()
    {
        try {
            return DB::table('sessions')
                ->where('user_id', Auth::id())
                ->orderBy('last_activity', 'desc')
                ->get()
                ->map(function ($session) {
                    $agent = $this->parseUserAgent($session->user_agent);

                    return (object) [
                        'id' => $session->id,
                        'ip_address' => $session->ip_address ?: 'Unknown IP',
                        'is_current_device' => $session->id === request()->session()->getId(),
                        'platform' => $agent->platform,
                        'browser' => $agent->browser,
                        'is_desktop' => $agent->is_desktop,
                        'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
                    ];
                });
        } catch (\Throwable $e) {
            return collect();
        }
    }

    protected function parseUserAgent(?string $userAgent): object
    {
        if (!$userAgent) {
            return (object) ['platform' => 'Unknown', 'browser' => 'Unknown', 'is_desktop' => true];
        }

        $platform = 'Unknown Platform';
        if (preg_match('/macintosh|mac os x/i', $userAgent)) {
            $platform = 'macOS';
        } elseif (preg_match('/windows|win32/i', $userAgent)) {
            $platform = 'Windows';
        } elseif (preg_match('/android/i', $userAgent)) {
            $platform = 'Android';
        } elseif (preg_match('/iphone|ipad|ipod/i', $userAgent)) {
            $platform = 'iOS';
        } elseif (preg_match('/linux/i', $userAgent)) {
            $platform = 'Linux';
        }

        $browser = 'Unknown Browser';
        if (preg_match('/chrome/i', $userAgent) && !preg_match('/edg/i', $userAgent)) {
            $browser = 'Chrome';
        } elseif (preg_match('/safari/i', $userAgent) && !preg_match('/chrome/i', $userAgent)) {
            $browser = 'Safari';
        } elseif (preg_match('/firefox/i', $userAgent)) {
            $browser = 'Firefox';
        } elseif (preg_match('/edg/i', $userAgent)) {
            $browser = 'Edge';
        }

        $isDesktop = !preg_match('/mobile|android|iphone|ipad/i', $userAgent);

        return (object) [
            'platform' => $platform,
            'browser' => $browser,
            'is_desktop' => $isDesktop,
        ];
    }

    public function render()
    {
        return view('livewire.profile', [
            'sessions' => $this->sessions,
        ]);
    }
}
