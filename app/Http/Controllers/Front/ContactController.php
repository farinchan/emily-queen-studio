<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Inbox;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class ContactController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key');
        $data = [
            'title' => 'Contact',
            'settings' => $settings,
        ];
        return view('front.pages.contact', $data);
    }

    public function store(Request $request)
    {
        // 1. Check Honeypot Trap (Field siluman jebakan bot)
        if (!empty($request->input('website_hp'))) {
            return back()->with('success', 'Terima kasih! Pesan Anda telah berhasil dikirim.');
        }

        // 2. Check Time-latch (Pencegahan bot otomatis mengisi < 2 detik)
        if ($request->has('form_time')) {
            try {
                $formTime = decrypt($request->input('form_time'));
                if (time() - $formTime < 2) {
                    return back()->with('success', 'Terima kasih! Pesan Anda telah berhasil dikirim.');
                }
            } catch (\Exception $e) {
                // If token invalid/tampered
            }
        }

        // 3. IP Rate Limiting (Maksimal 3 pengiriman pesan per 5 menit per alamat IP)
        $executed = RateLimiter::attempt(
            'send-inbox:' . $request->ip(),
            $perFiveMinutes = 3,
            function () {},
            $decaySeconds = 300
        );

        if (!$executed) {
            return back()->withErrors(['message' => 'Terlalu banyak pengiriman pesan dari koneksi Anda. Silakan coba lagi 5 menit kemudian.'])->withInput();
        }

        // 4. Input Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'phone.required' => 'Nomor HP/WhatsApp wajib diisi.',
            'subject.required' => 'Subjek / Layanan wajib diisi.',
            'message.required' => 'Pesan wajib diisi.',
        ]);

        Inbox::create($validated);

        return back()->with('success', 'Terima kasih! Pesan Anda telah berhasil dikirim. Tim kami akan segera menghubungi Anda.');
    }
}
