<?php

namespace Database\Seeders;

use App\Models\Photography;
use Illuminate\Database\Seeder;

class PhotographySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $photographies = [
            [
                'slug' => 'elegant-wedding',
                'label' => 'Wedding · Jakarta',
                'title' => 'Elegant Wedding',
                'subtitle' => 'Timeless vows, beautifully captured forever.',
                'description' => 'A collection of elegant wedding moments, capturing the essence of love and celebration.',
                'image' => 'https://instagram.fpku1-2.fna.fbcdn.net/v/t51.82787-15/712339763_18119067862783224_1113204353301940061_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=102&ig_cache_key=MzkwOTA1Mjc5NzkwMTE2NDc4Mg%3D%3D.3-ccb7-5&ccb=7-5&_nc_sid=58cdad&efg=eyJ2ZW5jb2RlX3RhZyI6IkNBUk9VU0VMX0lURU0ueHBpZHMuMzI3Ny5zZHIucmVndWxhcl9waG90by5DMyJ9&_nc_ohc=9CSr6QyKsz0Q7kNvwHpOmCS&_nc_oc=AdoWPFlb_c564gzssU-v4V8KRVZNppduMYRgUxuhIebx5qQdqjKCQy34EDS--SNrCRE&_nc_ad=z-m&_nc_cid=1101&_nc_zt=23&_nc_ht=instagram.fpku1-2.fna&_nc_gid=_nJ9iBQS7Uayml7dYlg0iw&_nc_ss=7a22e&oh=00_AQCgNQrYSLEsfJeq8hJbe1vAh9IpSBjBDyhuklzl_0eJ3g&oe=6A6C8697',
                'keywords' => ['wedding', 'elegant', 'romantic', 'celebration'],
                'content' => '
<style>* { box-sizing: border-box; } body {margin: 0;}.w-full.h-full.object-cover.group-hover\:scale-105.transition-transform.duration-700{margin:30px 0px 0px 0px;}#ianhj9{width:72px;height:72px;}</style><body id="ilx9"><section class="bg-white text-[#171717] py-20 px-6 sm:px-12 lg:px-16 max-w-5xl mx-auto border-b border-black/5"><div class="text-center max-w-2xl mx-auto mb-14"><span class="text-[9px] uppercase tracking-[.32em] text-[#817a72] block mb-3">Chapter I · The Vows</span><h2 class="font-display text-4xl sm:text-5xl leading-tight text-[#171717]">Janji Suci dalam Balutan Keanggunan Abadi</h2></div><div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center"><div class="lg:col-span-7 space-y-6"><p class="text-base sm:text-lg leading-relaxed text-black/80 font-light">
                Pernikahan Sebastian &amp; Linda diselenggarakan dalam suasana yang anggun dan dipenuhi kehangatan. Dari detik-detik persiapan di pagi hari hingga pesta dansa di bawah pendar lilin, setiap senyuman dan air mata bahagia terdokumentasi dengan penuh kejujuran visual.
            </p><blockquote class="border-l-2 border-black/30 pl-6 py-3 font-display italic text-2xl text-black/90">
                “Di dalam matamu kutemukan rumah, dan di dalam hatimu kutemukan cinta sejati.”
            </blockquote><p class="text-xs uppercase tracking-[.25em] text-[#817a72] font-medium">— Sebastian &amp; Linda</p></div><div class="lg:col-span-5 overflow-hidden rounded-sm bg-black/5 aspect-[4/5] shadow-sm group"><img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&amp;fit=crop&amp;w=1000&amp;q=80" alt="Wedding Ceremony" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/></div></div><section class="py-20 px-6 sm:px-12 max-w-4xl mx-auto border-b border-black/5"><div class="bg-white border border-black/10 p-8 sm:p-14 shadow-sm text-center relative overflow-hidden"><span class="text-[9px] uppercase tracking-[.3em] text-[#817a72] block mb-4">Review Pengantin</span><h3 class="font-display text-2xl sm:text-3xl italic text-[#171717] mb-6 leading-relaxed">
            “Melihat kembali album foto pernikahan kami membawa kami kembali ke setiap detik emosi dan kebahagiaan. Terima kasih tim Emily Queen Studio telah mengabadikan cerita kami secara sempurna.”
        </h3><div class="pt-4 border-t border-black/10 max-w-xs mx-auto"><span class="font-display text-lg block text-[#171717]">Sebastian &amp; Linda</span><span class="text-[10px] uppercase tracking-[.2em] text-[#817a72]">Jakarta, Indonesia</span></div></div></section><img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&amp;fit=crop&amp;w=1800&amp;q=88" alt="Evening Reception" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/><img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&amp;fit=crop&amp;w=1800&amp;q=88" alt="Evening Reception" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/><img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&amp;fit=crop&amp;w=1800&amp;q=88" alt="Evening Reception" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/><img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&amp;fit=crop&amp;w=1800&amp;q=88" alt="Evening Reception" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/></section><section class="py-16 px-6 max-w-3xl mx-auto text-center"><div class="mx-auto rounded-full overflow-hidden mb-5 shadow-sm bg-black/5" id="ianhj9"><img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&amp;fit=crop&amp;w=400&amp;q=80" alt="Photographer Avatar" class="w-full h-full object-cover"/></div><span class="text-[9px] uppercase tracking-[.28em] text-[#817a72] block mb-1">Captured By</span><h3 class="font-display text-3xl text-[#171717] mb-3">Fajri Rinaldi Chan</h3><p class="text-sm font-light text-black/70 leading-relaxed max-w-lg mx-auto">
                                    Menangkap kehangatan, emosi, dan kejujuran momen pernikahan Anda dalam karya visual yang tak lekang oleh waktu.
                                </p></section><section class="max-w-[1400px] mx-auto px-6 py-12 border-b border-black/5"><div class="overflow-hidden rounded-sm bg-black/5 aspect-[16/9] shadow-sm group"></div></section><section class="py-16 px-6 max-w-3xl mx-auto"></section></body>
',
            ],
            [
                'slug' => 'warm-family',
                'label' => 'Family · Bali',
                'title' => 'Warm Family',
                'subtitle' => 'Cherished moments, laughter, and love.',
                'description' => 'A collection of warm family moments, capturing the essence of togetherness and joy.',
                'image' => 'https://instagram.fpku1-2.fna.fbcdn.net/v/t51.82787-15/670912381_18115049197783224_1734346122907614738_n.jpg?stp=dst-jpg_e35_p1080x1080_tt6&_nc_cat=106&ig_cache_key=Mzg4MTQ4ODMzNzQ1MDE3MDAzMw%3D%3D.3-ccb7-5&ccb=7-5&_nc_sid=58cdad&efg=eyJ2ZW5jb2RlX3RhZyI6IkNBUk9VU0VMX0lURU0ueHBpZHMuMjQ5OC5zZHIucmVndWxhcl9waG90by5DMyJ9&_nc_ohc=-LsjaAwHmQEQ7kNvwHow9qj&_nc_oc=AdqYcPU0_dfGVm-tP0NxFcfEImgBDu31ImaTX9tHCyFe_ZpwJpVLy8d6HZQfhdMHJVQ&_nc_ad=z-m&_nc_cid=1101&_nc_zt=23&_nc_ht=instagram.fpku1-2.fna&_nc_gid=HxMu7_Pkfh6yHPMtO1-YPg&_nc_ss=7a22e&oh=00_AQAlSNAt48eOClZmFAYWk7Z1dHTAMp51Ur_b2UbSh6Pycg&oe=6A6C8F06',
                'keywords' => ['family', 'warm', 'joyful', 'portrait'],
                'content' => '
<style>* { box-sizing: border-box; } body {margin: 0;}#ikw6r{width:72px;height:72px;}.font-display.text-3xl.sm\:text-4xl.text-\[\#171717\]{margin:0 0 40px 0;}</style><body><section class="bg-white text-[#171717] py-20 px-6 sm:px-12 lg:px-16 max-w-5xl mx-auto border-b border-black/5"><div class="text-center max-w-2xl mx-auto mb-14"><span class="text-[9px] uppercase tracking-[.3em] text-[#817a72] block mb-3">Family Legacy</span><h2 class="font-display text-4xl sm:text-5xl leading-tight text-[#171717]">Kehangatan Keluarga dalam Senyum Alami</h2></div><div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center"><div class="lg:col-span-7 space-y-6"><p class="text-base sm:text-lg leading-relaxed text-black/80 font-light">
                Sesi dokumentasi keluarga Keluarga Pratama di Jimbaran, Bali. Mengabadikan tawa spontan anak-anak, dekapan hangat orang tua, serta momen kebersamaan di bawah pendar sinar matahari sore yang hangat.
            </p><blockquote class="border-l-2 border-black/30 pl-6 py-3 font-display italic text-2xl text-black/90">
                “Keluarga adalah tempat di mana kisah cinta terbesar kita dimulai dan terus bertumbuh.”
            </blockquote><p class="text-xs uppercase tracking-[.25em] text-[#817a72] font-medium">— Keluarga Pratama</p></div></div></section><section class="py-20 px-6 max-w-[1600px] mx-auto border-b border-black/5"><div class="text-center mb-12"><span class="text-[9px] uppercase tracking-[.3em] text-[#817a72] block mb-2">Moments Showcase</span><h3 class="font-display text-3xl sm:text-4xl text-[#171717]">Galeri Tawa &amp; Kebersamaan</h3></div><div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6"><div class="overflow-hidden rounded-sm bg-black/5 aspect-[3/4] shadow-sm group"><img src="https://images.unsplash.com/photo-1511895426328-dc8714191300?auto=format&amp;fit=crop&amp;w=800&amp;q=80" alt="Parents &amp; Child" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/></div><div class="overflow-hidden rounded-sm bg-black/5 aspect-[3/4] shadow-sm group"><img src="https://images.unsplash.com/photo-1544078751-58fee2d8a03b?auto=format&amp;fit=crop&amp;w=800&amp;q=80" alt="Candid Laughter" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/></div><div class="overflow-hidden rounded-sm bg-black/5 aspect-[3/4] shadow-sm group"><img src="https://images.unsplash.com/photo-1502086223501-7ea6ecd79368?auto=format&amp;fit=crop&amp;w=800&amp;q=80" alt="Child Outdoors" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/></div><div class="overflow-hidden rounded-sm bg-black/5 aspect-[3/4] shadow-sm group"><img src="https://images.unsplash.com/photo-1509198397868-475647b2a1e5?auto=format&amp;fit=crop&amp;w=800&amp;q=80" alt="Family Sunset Hug" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/></div></div></section><section class="bg-[#171717] text-white py-20 px-6 sm:px-12 text-center my-8"><div class="max-w-3xl mx-auto space-y-6"><span class="text-[9px] uppercase tracking-[.4em] text-white/50 block">Philosophy</span><h3 class="font-display text-3xl sm:text-5xl italic font-normal leading-snug text-white/95">
            “Hal terindah dari sebuah foto adalah kenangan yang tak pernah berubah meskipun orang di dalamnya terus bertumbuh.”
        </h3><p class="text-xs uppercase tracking-[.25em] text-white/60 font-light pt-4">— Emily Queen Studio</p></div></section><div class="max-w-[1400px] mx-auto px-6 py-10"><div class="overflow-hidden rounded-sm bg-black/5 aspect-[16/9] shadow-sm group"><img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&amp;fit=crop&amp;w=2000&amp;q=88" alt="Wide Featured Photo" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/></div></div><div class="max-w-[1400px] mx-auto px-6 py-10"><div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10"><div class="overflow-hidden rounded-sm bg-black/5 aspect-[4/5] shadow-sm group"><img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&amp;fit=crop&amp;w=1200&amp;q=80" alt="Photo 1" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/></div><div class="overflow-hidden rounded-sm bg-black/5 aspect-[4/5] shadow-sm group"><img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?auto=format&amp;fit=crop&amp;w=1200&amp;q=80" alt="Photo 2" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/></div></div></div><div class="max-w-[1400px] mx-auto px-6 py-10"><div class="overflow-hidden rounded-sm bg-black/5 aspect-[16/9] shadow-sm group"><img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&amp;fit=crop&amp;w=2000&amp;q=88" alt="Wide Featured Photo" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/></div></div><section class="py-16 px-6 max-w-3xl mx-auto text-center"><div class="mx-auto rounded-full overflow-hidden mb-5 shadow-sm bg-black/5" id="ikw6r"><img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&amp;fit=crop&amp;w=400&amp;q=80" alt="Photographer Avatar" class="w-full h-full object-cover"/></div><span class="text-[9px] uppercase tracking-[.28em] text-[#817a72] block mb-1">Captured By</span><h3 class="font-display text-3xl text-[#171717] mb-3">Emily Queen</h3><p class="text-sm font-light text-black/70 leading-relaxed max-w-lg mx-auto">
        Menangkap kehangatan, emosi, dan kejujuran momen keluarga Anda dalam karya visual yang tak lekang oleh waktu.
    </p></section></body>
',
            ],
            [
                'slug' => 'graduation-photo',
                'label' => 'Graduation · Padang',
                'title' => 'Graduation Photo',
                'subtitle' => 'Memories of graduation filled with spirit and pride.',
                'description' => 'A collection of graduation moments, capturing the essence of achievement and pride.',
                'image' => 'https://instagram.fpku1-3.fna.fbcdn.net/v/t51.82787-15/731032165_18122390395783224_5252738551109508059_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=109&ig_cache_key=MzkzMjI2NzA3NDc5NTU2ODg2OQ%3D%3D.3-ccb7-5&ccb=7-5&_nc_sid=58cdad&efg=eyJ2ZW5jb2RlX3RhZyI6IkNBUk9VU0VMX0lURU0ueHBpZHMuMTIwMC5zZHIucmVndWxhcl9waG90by5DMyJ9&_nc_ohc=3S17BAVqqTAQ7kNvwFI9kWq&_nc_oc=Adqa-2sdzxKVPX_mBY0Wx_ttGOf8HOhCWHsZIJvz55zv-DYKAb01_G-x5208g2bvD20&_nc_ad=z-m&_nc_cid=1101&_nc_zt=23&_nc_ht=instagram.fpku1-3.fna&_nc_gid=5SpM3vgrjlaF78KyAW0N_w&_nc_ss=7a22e&oh=00_AQAkjVksn-_tDHzmTmp82nlHn1T_gl1uCwq-NYT_dAL3tg&oe=6A6CA3DB',
                'keywords' => ['graduation', 'celebration', 'pride', 'achievement'],
                'content' => '
<section class="bg-white text-[#171717] py-20 px-6 sm:px-12 lg:px-16 max-w-5xl mx-auto border-b border-black/5">
    <div class="text-center max-w-2xl mx-auto mb-14">
        <span class="text-[9px] uppercase tracking-[.3em] text-[#817a72] block mb-3">Milestone Celebration</span>
        <h2 class="font-display text-4xl sm:text-5xl leading-tight text-[#171717]">Merayakan Kelulusan &amp; Perjuangan Akademik</h2>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-7 space-y-6">
            <p class="text-base sm:text-lg leading-relaxed text-black/80 font-light">
                Kelulusan adalah pencapaian bersejarah yang menandai akhir dari perjuangan panjang dan awal dari perjalanan baru. Kami mengabadikan momen kebanggaan ini bersama keluarga dan sahabat terdekat.
            </p>
            <blockquote class="border-l-2 border-black/30 pl-6 py-3 font-display italic text-2xl text-black/90">
                &ldquo;Masa depan adalah milik mereka yang percaya pada keindahan impian mereka.&rdquo;
            </blockquote>
            <p class="text-xs uppercase tracking-[.25em] text-[#817a72] font-medium">— Wisudawan 2026</p>
        </div>

    </div>
</section>

<section class="py-20 px-6 max-w-[1500px] mx-auto border-b border-black/5">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
        <div class="overflow-hidden rounded-sm bg-black/5 aspect-[3/4] shadow-sm group">
            <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=900&q=80" alt="Campus Celebration" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
        </div>
        <div class="overflow-hidden rounded-sm bg-black/5 aspect-[3/4] shadow-sm group">
            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=900&q=80" alt="Cap Toss" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
        </div>
        <div class="overflow-hidden rounded-sm bg-black/5 aspect-[3/4] shadow-sm group">
            <img src="https://images.unsplash.com/photo-1627556592933-ffe99c1cd9eb?auto=format&fit=crop&w=900&q=80" alt="Graduate Portrait" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
        </div>
    </div>
</section>

<section class="py-20 px-6 sm:px-12 max-w-4xl mx-auto">
    <div class="text-center mb-12">
        <span class="text-[9px] uppercase tracking-[.3em] text-[#817a72] block mb-2">Information</span>
        <h3 class="font-display text-4xl text-[#171717]">Pertanyaan Umum Layanan Wisuda</h3>
    </div>
    <div class="space-y-6">
        <div class="border-b border-black/10 pb-5">
            <h4 class="font-display text-xl mb-2 text-[#171717]">Berapa lama proses edit dan pengiriman hasil foto wisuda?</h4>
            <p class="text-sm text-black/70 font-light leading-relaxed">Teaser foto dikirimkan H+3 setelah sesi pemotretan. Galeri online penuh dan album cetak selesai dalam 1-2 minggu.</p>
        </div>
        <div class="border-b border-black/10 pb-5">
            <h4 class="font-display text-xl mb-2 text-[#171717]">Apakah melayani pemotretan wisuda keluarga di studio dan lokasi luar?</h4>
            <p class="text-sm text-black/70 font-light leading-relaxed">Ya, tim kami menyediakan sesi foto studio indoor ber-AC maupun sesi dokumentasi di area kampus pilihan Anda.</p>
        </div>
    </div>
</section>
',
            ],
            [
                'slug' => 'group-photo',
                'label' => 'Corporate & Editorial · Jakarta',
                'title' => 'Group Photo',
                'subtitle' => 'A warm moment of teamwork and togetherness.',
                'description' => 'A collection of group moments, capturing the essence of collaboration and camaraderie.',
                'image' => 'https://instagram.fpku1-2.fna.fbcdn.net/v/t51.82787-15/728786431_18121449754783224_1959732146962004143_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=106&ig_cache_key=MzkyNTcwMTI5MDAyMzcxMjU0Mg%3D%3D.3-ccb7-5&ccb=7-5&_nc_sid=58cdad&efg=eyJ2ZW5jb2RlX3RhZyI6IkNBUk9VU0VMX0lURU0ueHBpZHMuMzI3Ny5zZHIucmVndWxhcl9waG90by5DMyJ9&_nc_ohc=pq21caWrN6AQ7kNvwHBDAIN&_nc_oc=AdqOnwCspsdtYkIqzbdwJNw4IIfkuBKvlCfk4aQVRC3DemwZDzF9sFRK5OOkPyQz_D8&_nc_ad=z-m&_nc_cid=1101&_nc_zt=23&_nc_ht=instagram.fpku1-2.fna&_nc_gid=IuMPMtL-Tvrnp4jvi1BGtw&_nc_ss=7a22e&oh=00_AQAXIdi9dsLYqS4HIu9trOdkdkD-231GXA19zm3X1z9yGA&oe=6A6CD838',
                'keywords' => ['group', 'team', 'collaboration', 'corporate'],
                'content' => '
<style>* { box-sizing: border-box; } body {margin: 0;}*{box-sizing:border-box;}body{margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;}.max-w-\[1400px\].mx-auto.px-6.py-12.space-y-6{padding:0 0 100px 0;}</style><body id="ie54"><section class="bg-white text-[#171717] py-20 px-6 sm:px-12 lg:px-16 max-w-5xl mx-auto border-b border-black/5"><div class="text-center max-w-2xl mx-auto mb-14"><span class="text-[9px] uppercase tracking-[.3em] text-[#817a72] block mb-3">Corporate &amp; Team</span><h2 class="font-display text-4xl sm:text-5xl leading-tight text-[#171717]">Sinergi Tim &amp; Profesionalisme Modern</h2></div><div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center"><div class="lg:col-span-7 space-y-6"><p class="text-base sm:text-lg leading-relaxed text-black/80 font-light">
                Potret grup dan tim korporat profesional memperkuat reputasi serta karakter kolaborasi brand Anda. Kami menghadirkan penataan cahaya studio presisi dengan sikap hangat penuh rasa percaya diri.
            </p><blockquote class="border-l-2 border-black/30 pl-6 py-3 font-display italic text-2xl text-black/90">
                “Kebersamaan adalah awal, menjaga kebersamaan adalah kemajuan, dan bekerja sama adalah keberhasilan.”
            </blockquote><p class="text-xs uppercase tracking-[.25em] text-[#817a72] font-medium">— Tim Studio &amp; Mitra Korporat</p></div></div></section><div class="max-w-[1500px] mx-auto px-6 py-16"><div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start"><div class="overflow-hidden rounded-sm bg-black/5 aspect-[4/5] shadow-sm group md:translate-y-4"><img src="https://images.unsplash.com/photo-1544078751-58fee2d8a03b?auto=format&amp;fit=crop&amp;w=800&amp;q=80" alt="Stagger 1" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/></div><div class="overflow-hidden rounded-sm bg-black/5 aspect-[4/5] shadow-md group md:-translate-y-4"><img src="https://images.unsplash.com/photo-1523438885200-e635ba2c371e?auto=format&amp;fit=crop&amp;w=800&amp;q=80" alt="Stagger 2" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/></div><div class="overflow-hidden rounded-sm bg-black/5 aspect-[4/5] shadow-sm group md:translate-y-8"><img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&amp;fit=crop&amp;w=800&amp;q=80" alt="Stagger 3" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/></div></div></div><div class="max-w-[1400px] mx-auto px-6 py-12 space-y-6"><div class="overflow-hidden rounded-sm bg-black/5 aspect-[16/9] shadow-sm group"><img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&amp;fit=crop&amp;w=1800&amp;q=88" alt="Featured Main" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/></div><div class="grid grid-cols-2 md:grid-cols-4 gap-4"><div class="overflow-hidden rounded-sm bg-black/5 aspect-[4/3] shadow-sm group"><img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&amp;fit=crop&amp;w=600&amp;q=80" alt="Detail 1" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/></div><div class="overflow-hidden rounded-sm bg-black/5 aspect-[4/3] shadow-sm group"><img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?auto=format&amp;fit=crop&amp;w=600&amp;q=80" alt="Detail 2" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/></div><div class="overflow-hidden rounded-sm bg-black/5 aspect-[4/3] shadow-sm group"><img src="https://images.unsplash.com/photo-1544078751-58fee2d8a03b?auto=format&amp;fit=crop&amp;w=600&amp;q=80" alt="Detail 3" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/></div><div class="overflow-hidden rounded-sm bg-black/5 aspect-[4/3] shadow-sm group"><img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&amp;fit=crop&amp;w=600&amp;q=80" alt="Detail 4" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"/></div></div></div></body>',
            ],
        ];

        foreach ($photographies as $photoData) {
            Photography::updateOrCreate(
                ['slug' => $photoData['slug']],
                $photoData
            );
        }
    }
}
