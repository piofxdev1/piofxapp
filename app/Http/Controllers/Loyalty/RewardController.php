<?php

namespace App\Http\Controllers\Loyalty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Loyalty\Reward as Obj;
use App\Models\Loyalty\Customer;
use App\Models\Loyalty\LoyaltySetting;

use Illuminate\Support\Facades\Auth;

class RewardController extends Controller
{

    /**
     * Define the app and module object variables and component name 
     *
     */
    public function __construct(){
        // load the app, module and component name to object params
        $this->app      =   'Loyalty';
        $this->module   =   'Reward';
        $this->componentName = componentName('agency');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Obj $obj)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Obj $obj)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Obj $obj, LoyaltySetting $setting, Request $request)
    {
        // Authorize the request
        $this->authorize('create', $obj);
        
        // Get customer id
        $customer = Customer::where("id", $request->input('customer_id'))->first();

        // Retrieve client settings
        $setting = $setting->where('client_id', $request->client_id)->first();
        $settings = json_decode($setting->settings);

        if($request->credit_redeem == "credit"){
            if($settings->mode == 'generic'){
                $obj->create([
                    "agency_id" => $request->agency_id,
                    "client_id" => $request->client_id,
                    "user_id" => $request->user_id,
                    "customer_id" => $request->customer_id,
                    "amount" => $request->amount,
                    "description" => $request->description,
                    "credits" => $request->credits,
                ]);
            }
            else if($settings->mode == 'default'){
                $obj->create([
                    "agency_id" => $request->agency_id,
                    "client_id" => $request->client_id,
                    "user_id" => $request->user_id,
                    "customer_id" => $request->customer_id,
                    "amount" => $request->amount,
                    "description" => $request->description,
                    "credits" => $request->credits,
                ]);
            }
            else if($settings->mode == 'range_percent'){

                $amount = (int)$request->amount;
                $percent = 0;
                $description = "";

                if(((int)$settings->start_1 <= $amount) && ($amount <= (int)$settings->end_1)){
                    $percent = (int)$settings->percent_1;
                    $description = $settings->description_1;
                }
                else if(((int)$settings->start_2 <= $amount) && ($amount <= (int)$settings->end_2)){
                    $percent = (int)$settings->percent_2;
                    $description = $settings->description_2;                
                }
                else if(((int)$settings->start_3 <= $amount) && ($amount <= (int)$settings->end_3)){
                    $percent = (int)$settings->percent_3;
                    $description = $settings->description_3;                
                }

                
                $credits = $amount * ($percent/100);

                $obj->create([
                    "agency_id" => $request->agency_id,
                    "client_id" => $request->client_id,
                    "user_id" => $request->user_id,
                    "customer_id" => $request->customer_id,
                    "amount" => $amount,
                    "description" => $description,
                    "credits" => $credits,
                ]);
            }
            else if($settings->mode == 'range_fixed'){

                $amount = (int)$request->amount;
                $credits = 0;
                $description = "";

                if(((int)$settings->start_1 <= $amount) && ($amount <= (int)$settings->end_1)){
                    $credits = (int)$settings->credits_1;
                    $description = $settings->description_1;
                }
                else if(((int)$settings->start_2 <= $amount) && ($amount <= (int)$settings->end_2)){
                    $credits = (int)$settings->credits_2;
                    $description = $settings->description_2;                
                }
                else if(((int)$settings->start_3 <= $amount) && ($amount <= (int)$settings->end_3)){
                    $credits = (int)$settings->credits_3;
                    $description = $settings->description_3;                
                }

                $obj->create([
                    "agency_id" => $request->agency_id,
                    "client_id" => $request->client_id,
                    "user_id" => $request->user_id,
                    "customer_id" => $request->customer_id,
                    "amount" => $amount,
                    "description" => $description,
                    "credits" => $credits,
                ]);
            }
        }
        elseif($request->credit_redeem == "redeem"){
            $redeem = (int)$request->redeem;

            if((((int)$settings->min_redeem <= $redeem) && ($redeem <= (int)$settings->max_redeem))){
                $obj->create([
                    "agency_id" => $request->agency_id,
                    "client_id" => $request->client_id,
                    "user_id" => $request->user_id,
                    "customer_id" => $request->customer_id,
                    "amount" => $request->amount,
                    "redeem" => $redeem,
                ]);
            }
            else if($redeem <= (int)$settings->min_redeem){
                return redirect($request->current_url)->with("redeem_alert", "Minimum Redeem value is $settings->min_redeem.");
            }
        }

        if($request->current_url){
            return redirect($request->current_url);
        }

        return redirect()->route($this->module.'.public', ['phone' => $customer->phone]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Obj $obj, Request $request)
    {
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($slug, Obj $obj)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Obj $obj, $phone)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
   
    }

    public function public(Request $request){

        $obj = new Obj;
        $customer = new Customer;
        $setting = new LoyaltySetting;

        // Check if request object is empty
        if(!empty($request->input('phone'))){
            // Validate the request object
            $validated = $request->validate([
                "phone" => 'required|digits:10',
            ]);

            // Retrieve request variable
            $phone = $request->input('phone');
            
            // Retrieve records with that particular phone number
            $customer = $customer->where('phone', $phone)->where('client_id', $request->client_id)->first();

            $objs= [];
            if($customer){
                // Retrieve records
                $objs = $obj->where('client_id', $request->client_id)->where('customer_id', $customer->id)->get(); 
                
                // Execute only if there is atleast one record
                if($objs->count() >= 1){     
                    // Initialize required variables   
                    $remaining_credits = 0;

                    // Calculate the remaining reward points
                    foreach($objs as $reward){
                        $remaining_credits = $remaining_credits + ($reward->credits - $reward->redeem);
                    }

                    // Retrieve Records
                    $setting = $setting->where('client_id', $request->client_id)->first();
                    $settings = json_decode($setting->settings);
                    
                    return view("apps.".$this->app.".".$this->module.".public")
                        ->with("app", $this)
                        ->with("objs", $objs)
                        ->with("phone", $phone)
                        ->with("settings", $settings)
                        ->with("remaining_credits", $remaining_credits);
                }  
            }
            
            return view("apps.".$this->app.".".$this->module.".public")
                    ->with("app", $this)
                    ->with("objs", $objs)
                    ->with("phone", $phone)
                    ->with("alert", "No Records Found. Please talk with the Sales Executive");
        }

        return view("apps.".$this->app.".".$this->module.".public")
            ->with("app", $this);
    }
}
