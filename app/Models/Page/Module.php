<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Core\Client;
use App\Models\Page\Module;
use App\Models\Page\Theme;
use App\Models\Page\Page;
use App\Models\Page\Asset;
use Illuminate\Support\Facades\Cache;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Storage;

class Module extends Model
{
    use HasFactory,Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'html',
        'html_minified',
        'settings',
        'admin',
        'user_id',
        'client_id',
        'agency_id',
        'theme_id',
        'status',
    ];


    /**
     * Get the list of records from database
     *
     * @var array
     */
    public function getRecords($item,$limit,$theme_id){
    	return $this->where('name','LIKE',"%{$item}%")
                    ->where('client_id',request()->get('client.id'))
                    ->where('theme_id',$theme_id)
                    ->orderBy('created_at','desc')
                    ->paginate($limit);

    }

    /**
     * Refresh the cache data
     *
     */

    public function refreshCache(){

        // get the domain name
        $domain = $this->client->domain;

        // reload the cache
        Cache::forget('module_'.$domain.'_'.$this->slug);
        Cache::forever('module_'.$domain.'_'.$this->slug,$this);

    }

    /**
     * Function to replace the variables
     *
     */

    public function processHtml($theme_id)
    {
        $content = $this->html;
        $settings = json_decode($this->settings);

        //dd($content);
        if(preg_match_all('/{{+(.*?)}}/', $content, $regs))
        {
          
            foreach ($regs[1] as $reg){
              $variable = trim($reg);

                $pos_0 = substr($variable,0,1);
                if($pos_0=='$'){
                    $variable_name = str_replace('$', '', $variable);
                    $data = (isset($settings->$variable_name)) ? $settings->$variable_name : '';
                    $content = str_replace('{{'.$reg.'}}', $data , $content);
                }

                 if($pos_0==':'){
                    $variable_name = str_replace(':', '', $variable);
                    $theme = Theme::where('client_id',$this->client_id)->where('id',$this->theme_id)->first();
                    $sett = json_decode($theme->settings);

                    $data = (isset($sett->$variable_name)) ? $sett->$variable_name : '';
                    $content = str_replace('{{'.$reg.'}}', $data , $content);
                }
                
                if($pos_0=='&'){
                    $variable_name = str_replace('&', '', $variable);


                    $asset = Asset::where('client_id',$this->client_id)->where('theme_id',$theme_id)->where('slug',$variable_name)->first();

                    $data = ($asset) ? Storage::disk('s3')->url($asset->path) : '';
                    $content = str_replace('{{'.$reg.'}}', $data , $content);
                }
            }
            
        } 


       

        $content = $this->minifyHtml($content);
        $this->html_minified = $content; 
        $this->save();
        
        $settings = json_decode($this->client->settings);

        if($settings){
          //update all pages in the theme
          $pages = Page::where('client_id',$this->client_id)->where('theme_id',$theme_id)->get();
          foreach($pages as $page){
            $page->processHtml();
            $page->refreshCache($theme_id);
          }
        }
          
    }


    /**
     * Function to replace the local & global variables
     *
     */
    public function processPageModuleHtml($theme_id,$settings_page)
    {
        $content = $this->html;
        $settings = json_decode($this->settings);
        $settings_page = json_decode($settings_page);
        $theme = Theme::where('client_id',$this->client_id)->where('id',$this->theme_id)->first();
        $settings_theme = json_decode($theme->settings);

        //dd($content);
        if(preg_match_all('/{{+(.*?)}}/', $content, $regs))
        {
          
            foreach ($regs[1] as $reg){
              $variable = trim($reg);

                $pos_0 = substr($variable,0,1);
                if($pos_0=='$'){
                    $variable_name = str_replace('$', '', $variable);
                    
                    //check page else module else in theme
                    if(isset($settings_page->$variable_name)){
                        $data = $settings_page->$variable_name;
                    }else if(isset($settings->$variable_name))
                        $data = $settings->$variable_name;
                    else if(isset($settings_theme->$variable_name))
                        $data = $settings_theme->$variable_name;
                    else
                        $data='';
                    $content = str_replace('{{'.$reg.'}}', $data , $content);
                }

                 if($pos_0==':'){
                    $variable_name = str_replace(':', '', $variable);

                    //check page else module else in theme
                    if(isset($settings_page->$variable_name)){
                        $data = $settings_page->$variable_name;
                    }else if(isset($settings->$variable_name))
                        $data = $settings->$variable_name;
                    else if(isset($settings_theme->$variable_name))
                        $data = $settings_theme->$variable_name;
                    else
                        $data='';

                   // $data = (isset($sett->$variable_name)) ? $sett->$variable_name : '';
                    $content = str_replace('{{'.$reg.'}}', $data , $content);
                }
                
                if($pos_0=='&'){
                    $variable_name = str_replace('&', '', $variable);
                    $asset = Asset::where('client_id',$this->client_id)->where('theme_id',$theme_id)->where('slug',$variable_name)->first();
                    $data = ($asset) ? Storage::disk('s3')->url($asset->path) : '';
                    $content = str_replace('{{'.$reg.'}}', $data , $content);
                }
            }
            
        } 

       
        return $content;
          
    }

     /**
     * Function to replace the local & global variables from Local storage
     *
     */
    public static function processPageModuleHtmlLocal($theme_id,$settings_page,$content,$settings,$server=false)
    {
        //$content = $this->html;
        //$settings = json_decode($settings);
        if(is_string($settings))
            $settings = json_decode($settings);

        $theme = null;
        $theme_slug= request()->get('client.theme.slug');
        if(Storage::disk('public')->exists('devmode/'.$theme_id.'/data/theme_'.$theme_slug.'.json'))
            $theme = json_decode(Storage::disk('public')->get('devmode/'.$theme_id.'/data/theme_'.$theme_slug.'.json'));
        
        $settings_theme = null;
        if(Storage::disk('public')->exists('devmode/'.$theme_id.'/code/settings/theme_'.$theme_slug.'.json'))
            $settings_theme = json_decode(Storage::disk('public')->get('devmode/'.$theme_id.'/code/settings/theme_'.$theme_slug.'.json'));
        
        //dd($content);
        if(preg_match_all('/{{+(.*?)}}/', $content, $regs))
        {
          
            foreach ($regs[1] as $reg){
              $variable = trim($reg);

                $pos_0 = substr($variable,0,1);
                if($pos_0=='$'){
                    $variable_name = str_replace('$', '', $variable);
                    
                    //check page else module else in theme
                    if(isset($settings_page->$variable_name)){
                        $data = $settings_page->$variable_name;
                    }else if(isset($settings->$variable_name))
                        $data = $settings->$variable_name;
                    else if(isset($settings_theme->$variable_name))
                        $data = $settings_theme->$variable_name;
                    else
                        $data='';
                    $content = str_replace('{{'.$reg.'}}', $data , $content);
                }


                 if($pos_0==':'){
                    $variable_name = str_replace(':', '', $variable);

                    //check page else module else in theme
                    if(isset($settings_page->$variable_name)){
                        $data = $settings_page->$variable_name;
                    }else if(isset($settings->$variable_name))
                        $data = $settings->$variable_name;
                    else if(isset($settings_theme->$variable_name))
                        $data = $settings_theme->$variable_name;
                    else
                        $data='';

                   // $data = (isset($sett->$variable_name)) ? $sett->$variable_name : '';
                    $content = str_replace('{{'.$reg.'}}', $data , $content);
                }
                
                if($pos_0=='&'){
                    $variable_name = str_replace('&', '', $variable);
                    $asset = null;
                    if(Storage::disk('public')->exists('devmode/'.$theme_id.'/data/asset_'.$variable_name.'.json'))
                        $asset = json_decode(Storage::disk('public')->get('devmode/'.$theme_id.'/data/asset_'.$variable_name.'.json'));
                    
                    if(!$server)
                        $data = ($asset) ? Storage::disk('public')->url('devmode/'.$theme_id.'/code/assets/'.$asset->type.'/file_'.$asset->slug) : '';
                    else{
                        if(isset($asset->slug)){
                            $path = 'themes/'.$theme_id.'/file_'.$asset->slug;
                            $data = ($asset) ? Storage::disk('s3')->url($path) : '';
                        }else{
                            $data ='';
                        }
                       
                    }

                    $content = str_replace('{{'.$reg.'}}', $data , $content);
                }
            }
            
        } 



        return $content;
          
    }



    /**
     * Function to minify the html code
     *
     */
    public function minifyHtml($buffer) {

        $search = array(
            '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
            '/[^\S ]+\</s',     // strip whitespaces before tags, except space
            '/(\s)+/s',         // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' // Remove HTML comments
        );

        $replace = array(
            '>',
            '<',
            '\\1',
            ''
        );

        $buffer = preg_replace($search, $replace, $buffer);

        return $buffer;
    }

    /**
   * Get the user that owns the page.
   *
   */
  public function saveSettings()
  {
      $data = request()->all();
      $settings = new Module;
      $flag=0;
      foreach($data as $key => $value){
        if(substr( $key, 0, 8 ) === "settings"){
          $d = str_replace("settings_", "", $key);
          $settings->$d = $value;
          $flag = 1;
        }
      }
      if($flag){
        $this->settings = json_encode($settings);
        $this->save();
        $this->processHtml($this->theme_id);
      }
      
  }

    /**
	 * Get the user that owns the page.
	 *
	 */
	public function user()
	{
	    return $this->belongsTo(User::class);
	}

	 /**
	 * Get the client that owns the page.
	 *
	 */
	public function client()
	{
	    return $this->belongsTo(Client::class);
	}
}
