<?php

namespace App\Models\Loyalty;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Loyalty\Customer;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'phone', 'credits', 'redeem'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
