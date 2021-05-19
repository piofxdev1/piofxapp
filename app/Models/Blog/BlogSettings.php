<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;

class BlogSettings extends Model
{
    use HasFactory;

    public function getSettings(){
        // Get Settings
        $client_id = request()->get('client.id');
        $settingsfilename = 'settings/blog_settings_'.$client_id.'.json';
        if(Storage::disk("s3")->exists($settingsfilename)){
            $settings = json_decode(Storage::disk("s3")->get($settingsfilename));
        }
        else{
            // Default Settings
            $settings = json_encode(array(
                "home_layout" => "default",
                "post_layout" => "right",
                "comments" => false,
            ), JSON_PRETTY_PRINT);
            Storage::disk("s3")->put($settingsfilename, $settings);
            $settings = json_decode($settings);
        }
        return $settings;
    }

}
