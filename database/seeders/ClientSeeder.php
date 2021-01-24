<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('clients')->insert([
            'name' => 'Piofx App',
            'domain' => 'piofxapp.test',
            'settings' => '{
    "theme": "metronic7",
    "topmenu": "<ul class=\"header-tabs nav font-size-lg\" role=\"tablist\"><li class=\"nav-item\"> <a href=\"\/dashboard\" class=\"nav-link py-4 px-6 \" >Dashboard<\/a><\/li><li class=\"nav-item mr-3\"> <a href=\"\/client\" class=\"nav-link py-4 px-6 \" >Clients<\/a><\/li><li class=\"nav-item mr-3\"> <a href=\"#\" class=\"nav-link py-4 px-6\" data-toggle=\"tab\" data-target=\"#kt_header_tab_2\" role=\"tab\">Users<\/a><\/li><li class=\"nav-item mr-3\"> <a href=\"#\" class=\"nav-link py-4 px-6\" data-toggle=\"tab\" data-target=\"#kt_header_tab_2\" role=\"tab\">Pages<\/a><\/li><li class=\"nav-item mr-3\"> <a href=\"#\" class=\"nav-link py-4 px-6\" data-toggle=\"tab\" data-target=\"#kt_header_tab_2\" role=\"tab\">Blog<\/a><\/li><li class=\"nav-item mr-3\"> <a href=\"#\" class=\"nav-link py-4 px-6\" >Settings<\/a><\/li><li class=\"nav-item mr-3\"> <a href=\"\/logout\" class=\"nav-link py-4 px-6\" >Logout<\/a><\/li><\/ul>"
}'
        ]);

        DB::table('clients')->insert([
            'name' => 'Piofx',
            'domain' => 'piofx.test',
            'settings' => '{
    "theme": "arsha",
    "topmenu": "<ul class=\"header-tabs nav font-size-lg\" role=\"tablist\"><li class=\"nav-item\"> <a href=\"\/dashboard\" class=\"nav-link py-4 px-6 \" >Dashboard<\/a><\/li><li class=\"nav-item mr-3\"> <a href=\"\/client\" class=\"nav-link py-4 px-6 \" >Clients<\/a><\/li><li class=\"nav-item mr-3\"> <a href=\"#\" class=\"nav-link py-4 px-6\" data-toggle=\"tab\" data-target=\"#kt_header_tab_2\" role=\"tab\">Users<\/a><\/li><li class=\"nav-item mr-3\"> <a href=\"#\" class=\"nav-link py-4 px-6\" data-toggle=\"tab\" data-target=\"#kt_header_tab_2\" role=\"tab\">Pages<\/a><\/li><li class=\"nav-item mr-3\"> <a href=\"#\" class=\"nav-link py-4 px-6\" data-toggle=\"tab\" data-target=\"#kt_header_tab_2\" role=\"tab\">Blog<\/a><\/li><li class=\"nav-item mr-3\"> <a href=\"#\" class=\"nav-link py-4 px-6\" >Settings<\/a><\/li><li class=\"nav-item mr-3\"> <a href=\"\/logout\" class=\"nav-link py-4 px-6\" >Logout<\/a><\/li><\/ul>",
    "footermenu": "<div class=\"col-lg-3 col-md-6 footer-links\"><h4>Useful Links<\/h4><ul><li><i class=\"bx bx-chevron-right\"><\/i> <a href=\"#\">Home<\/a><\/li><li><i class=\"bx bx-chevron-right\"><\/i> <a href=\"#\">About us<\/a><\/li><li><i class=\"bx bx-chevron-right\"><\/i> <a href=\"#\">Services<\/a><\/li><li><i class=\"bx bx-chevron-right\"><\/i> <a href=\"#\">Terms of service<\/a><\/li><li><i class=\"bx bx-chevron-right\"><\/i> <a href=\"#\">Privacy policy<\/a><\/li><\/ul><\/div><div class=\"col-lg-3 col-md-6 footer-links\"><h4>Our Services<\/h4><ul><li><i class=\"bx bx-chevron-right\"><\/i> <a href=\"#\">Web Design<\/a><\/li><li><i class=\"bx bx-chevron-right\"><\/i> <a href=\"#\">Web Development<\/a><\/li><li><i class=\"bx bx-chevron-right\"><\/i> <a href=\"#\">Product Management<\/a><\/li><li><i class=\"bx bx-chevron-right\"><\/i> <a href=\"#\">Marketing<\/a><\/li><li><i class=\"bx bx-chevron-right\"><\/i> <a href=\"#\">Graphic Design<\/a><\/li><\/ul><\/div>",
    "sociallinks":"<div class=\"col-lg-3 col-md-6 footer-links\"><h4>Our Social Networks</h4><p>For latest updates follow us on your favourite network</p><div class=\"social-links mt-3\"> <a href=\"#\" class=\"twitter\"><i class=\"bx bxl-twitter\"></i></a> <a href=\"#\" class=\"facebook\"><i class=\"bx bxl-facebook\"></i></a> <a href=\"#\" class=\"instagram\"><i class=\"bx bxl-instagram\"></i></a> <a href=\"#\" class=\"google-plus\"><i class=\"bx bxl-skype\"></i></a> <a href=\"#\" class=\"linkedin\"><i class=\"bx bxl-linkedin\"></i></a></div></div>",

    "favicon": "https:\/\/i.imgur.com\/g466kjU.png",
    "logo": "https:\/\/i.imgur.com\/cIgsNrC.png",
    "logo_dark": "https:\/\/i.imgur.com\/9bhZ99U.png",
    "contact": "<div class=\"contact-block\">2nd floor, Oyester Uptown<br>Beside Durgam Cheruvu Metro<br>Madhapur-81<br><br><strong>Phone:<\/strong> +91 9000045750<br><strong>Email:<\/strong> nt@piofx.com<br><\/div>"
}'
        ]);

        DB::table('clients')->insert([
            'name' => 'PacketPrep',
            'domain' => 'techpp.test',
            'settings' => '{"theme":"pp","themeview":"themes.pp"}'
        ]);

        DB::table('clients')->insert([
            'name' => 'Skashi',
            'domain' => 'sakshi.test',
            'settings' => '{"theme":"sakshi","themeview":"themes.sakshi"}'
        ]);
    }
}
