<?php

namespace Database\Seeders;

use App\Models\Setting as SettingModel;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SettingModel::set('site_name', 'Emily Queen Home Photo Studio');
        SettingModel::set('site_description', 'Capture your precious moments with Emily Queen Home Photo Studio. We specialize in creating timeless memories through professional photography and videography services.');
        SettingModel::set('site_keyword', 'photography, studio, memories, moments, professional, Emily Queen, padang, Indonesia, sumatra barat, home studio, portrait, wedding, family, events');
        SettingModel::set('address', 'Jl. Sawahan V No.1, Sawahan, Kec. Padang Tim., Kota Padang, Sumatera Barat 25171');
        SettingModel::set('maps_embed', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3978.8861063821273!2d100.36831727495306!3d-0.9457072990451533!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b982c9fe455f%3A0x5061d73acccaf624!2sEmily%20Queen%20Home%20Photo%20Studio!5e1!3m2!1sid!2sid!4v1785122830601!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>');
        SettingModel::set('instagram', 'https://www.instagram.com/emilyqueen.homephotostudio/');
        SettingModel::set('facebook', 'https://www.facebook.com/emilyqueenstudio/');
        SettingModel::set('youtube', 'https://www.youtube.com/@emilyqueenstudio');
        SettingModel::set('whatsapp', '+6281234567890');
    }
}
