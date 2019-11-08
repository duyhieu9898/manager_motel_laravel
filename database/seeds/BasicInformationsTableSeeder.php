<?php

use Illuminate\Database\Seeder;
use App\BasicInformation;

class BasicInformationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        BasicInformation::insert([
            ['name' => 'home_name','content' => 'HOMO SAPIENS'],
            ['name' => 'home_header','content' => 'BOOKING ONLINE'],
            ['name' => 'link_logo_header','content' => 'logo.png'],
            ['name' => 'slogan_header','content' => 'Website booking room good price and fast time'],
            ['name' => 'footer_left_title','content' => 'Trụ sở chính'],
            ['name' => 'footer_left_address','content' => '169 Đường 32,Liên Mạc, Bắc Từ Liêm, TP Hà Nội'],
            ['name' => 'footer_left_phone','content' => 'Điện thoại: 0366 025 756'],
            ['name' => 'footer_left_mail','content' => 'Gmail: duyhieu9898@gmail.com'],
            ['name' => 'footer_mid_title','content' => 'Chi nhánh'],
            ['name' => 'footer_mid_address','content' => '169 Đường 32,Liên Mạc, Bắc Từ Liêm, TP Hà Nội'],
            ['name' => 'footer_mid_phone','content' => 'Điện thoại: 0366 025 756'],
            ['name' => 'footer_mid_mail','content' => 'Gmail: duyhieu9898@gmail.com'],
            ['name' => 'footer_right_title','content' => 'Fanpages của chúng tôi'],
            ['name' => 'footer_right_facebook','content' => 'https://www.facebook.com/Bot-chat-fb-220963458793205/?modal=admin_todo_tour'],
            ['name' => 'room_banner_first','content' => 'benefit! Book now to get more privileges'],
            ['name' => 'room_banner_second','content' => 'Quick time! We will contact you 24 hours in advance from the time of booking'],
            ['name' => 'link_about_me', 'content' => 'https://www.topcv.vn/xem-cv/43fb6293a5795a0e01008739259bf2db']
        ]);
    }
}
