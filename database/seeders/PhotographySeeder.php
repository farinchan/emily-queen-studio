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
        if (Photography::count() === 0) {
            Photography::create([
                'image' => 'https://instagram.fpku1-2.fna.fbcdn.net/v/t51.82787-15/712339763_18119067862783224_1113204353301940061_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=102&ig_cache_key=MzkwOTA1Mjc5NzkwMTE2NDc4Mg%3D%3D.3-ccb7-5&ccb=7-5&_nc_sid=58cdad&efg=eyJ2ZW5jb2RlX3RhZyI6IkNBUk9VU0VMX0lURU0ueHBpZHMuMzI3Ny5zZHIucmVndWxhcl9waG90by5DMyJ9&_nc_ohc=9CSr6QyKsz0Q7kNvwHpOmCS&_nc_oc=AdoWPFlb_c564gzssU-v4V8KRVZNppduMYRgUxuhIebx5qQdqjKCQy34EDS--SNrCRE&_nc_ad=z-m&_nc_cid=1101&_nc_zt=23&_nc_ht=instagram.fpku1-2.fna&_nc_gid=_nJ9iBQS7Uayml7dYlg0iw&_nc_ss=7a22e&oh=00_AQCgNQrYSLEsfJeq8hJbe1vAh9IpSBjBDyhuklzl_0eJ3g&oe=6A6C8697',
                'title' => 'Elegant Wedding',
                'slug' => 'elegant-wedding',
                'subtitle' => 'Timeless vows, beautifully captured forever.',
                'description' => 'A collection of elegant wedding moments, capturing the essence of love and celebration.',
                'keywords' => ['wedding', 'elegant', 'romantic'],
            ]);

            Photography::create([
                'image' => 'https://instagram.fpku1-2.fna.fbcdn.net/v/t51.82787-15/670912381_18115049197783224_1734346122907614738_n.jpg?stp=dst-jpg_e35_p1080x1080_tt6&_nc_cat=106&ig_cache_key=Mzg4MTQ4ODMzNzQ1MDE3MDAzMw%3D%3D.3-ccb7-5&ccb=7-5&_nc_sid=58cdad&efg=eyJ2ZW5jb2RlX3RhZyI6IkNBUk9VU0VMX0lURU0ueHBpZHMuMjQ1OC5zZHIucmVndWxhcl9waG90by5DMyJ9&_nc_ohc=-LsjaAwHmQEQ7kNvwHow9qj&_nc_oc=AdqYcPU0_dfGVm-tP0NxFcfEImgBDu31ImaTX9tHCyFe_ZpwJpVLy8d6HZQfhdMHJVQ&_nc_ad=z-m&_nc_cid=1101&_nc_zt=23&_nc_ht=instagram.fpku1-2.fna&_nc_gid=HxMu7_Pkfh6yHPMtO1-YPg&_nc_ss=7a22e&oh=00_AQAlSNAt48eOClZmFAYWk7Z1dHTAMp51Ur_b2UbSh6Pycg&oe=6A6C8F06',
                'title' => 'Warm Family',
                'slug' => 'warm-family',
                'subtitle' => 'Cherished moments, laughter, and love.',
                'description' => 'A collection of warm family moments, capturing the essence of togetherness and joy.',
                'keywords' => ['family', 'warm', 'joyful'],
            ]);

            Photography::create([
                'image' => 'https://instagram.fpku1-3.fna.fbcdn.net/v/t51.82787-15/731032165_18122390395783224_5252738551109508059_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=109&ig_cache_key=MzkzMjI2NzA3NDc5NTU2ODg2OQ%3D%3D.3-ccb7-5&ccb=7-5&_nc_sid=58cdad&efg=eyJ2ZW5jb2RlX3RhZyI6IkNBUk9VU0VMX0lURU0ueHBpZHMuMTIwMC5zZHIucmVndWxhcl9waG90by5DMyJ9&_nc_ohc=3S17BAVqqTAQ7kNvwFI9kWq&_nc_oc=Adqa-2sdzxKVPX_mBY0Wx_ttGOf8HOhCWHsZIJvz55zv-DYKAb01_G-x5208g2bvD20&_nc_ad=z-m&_nc_cid=1101&_nc_zt=23&_nc_ht=instagram.fpku1-3.fna&_nc_gid=5SpM3vgrjlaF78KyAW0N_w&_nc_ss=7a22e&oh=00_AQAkjVksn-_tDHzmTmp82nlHn1T_gl1uCwq-NYT_dAL3tg&oe=6A6CA3DB',
                'title' => 'Graduation Photo',
                'slug' => 'graduation-photo',
                'subtitle' => 'Memories of graduation filled with spirit and pride.',
                'description' => 'A collection of graduation moments, capturing the essence of achievement and pride.',
                'keywords' => ['graduation', 'celebration', 'pride'],
            ]);

            Photography::create([
                'image' => 'https://instagram.fpku1-2.fna.fbcdn.net/v/t51.82787-15/728786431_18121449754783224_1959732146962004143_n.jpg?stp=dst-jpg_e35_tt6&_nc_cat=106&ig_cache_key=MzkyNTcwMTI5MDAyMzcxMjU0Mg%3D%3D.3-ccb7-5&ccb=7-5&_nc_sid=58cdad&efg=eyJ2ZW5jb2RlX3RhZyI6IkNBUk9VU0VMX0lURU0ueHBpZHMuMzI3Ny5zZHIucmVndWxhcl9waG90by5DMyJ9&_nc_ohc=pq21caWrN6AQ7kNvwHBDAIN&_nc_oc=AdqOnwCspsdtYkIqzbdwJNw4IIfkuBKvlCfk4aQVRC3DemwZDzF9sFRK5OOkPyQz_D8&_nc_ad=z-m&_nc_cid=1101&_nc_zt=23&_nc_ht=instagram.fpku1-2.fna&_nc_gid=IuMPMtL-Tvrnp4jvi1BGtw&_nc_ss=7a22e&oh=00_AQAXIdi9dsLYqS4HIu9trOdkdkD-231GXA19zm3X1z9yGA&oe=6A6CD838',
                'title' => 'Group Photo',
                'slug' => 'group-photo',
                'subtitle' => 'A warm moment of teamwork and togetherness.',
                'description' => 'A collection of group moments, capturing the essence of collaboration and camaraderie.',
                'keywords' => ['group', 'team', 'collaboration'],
            ]);
        }

    }
}
