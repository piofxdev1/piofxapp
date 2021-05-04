<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
// use App\Models\Core\Client;
use App\Models\Blog\Post;
use Kyslik\ColumnSortable\Sortable;

use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    use HasFactory, Sortable;

    // The attributes that are mass assignable
	protected $fillable = ["user_id", "client_id", 'agency_id', 'name', 'slug','image','description'];

	public $sortable = ["id", "title", "created_at"];

    // retrieve all records
    public function getRecords(){
		$posts = Cache::remember('posts', 60, function(){
			return $this->sortable()->orderBy('id', 'asc')->with('posts')->get();
		});
		return $posts;
    }

    // Retrieve specific record based on slug
    public function getRecord($slug){
        return $this->where("slug", $slug)->first();
    }

        /**
	 * Get the user that owns the page.
	 *
	 */
	public function user()
	{
	    return $this->belongsTo(User::class);
	}

	//  /**
	//  * Get the client that owns the page.
	//  *
	//  */
	// public function client()
	// {
	//     return $this->belongsTo(Client::class);
    // }
    
    /**
	 * Get the client that owns the page.
	 *
	 */
	public function posts()
	{
	    return $this->hasMany(Post::class);
	}
}
