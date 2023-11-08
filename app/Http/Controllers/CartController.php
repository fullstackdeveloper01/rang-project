<?php

namespace App\Http\Controllers;

use Cart;
use App\Items; 
use App\Images; 
use Carbon\Carbon; 
use Illuminate\Http\Request; 

class CartController extends Controller
{
    function __construct() { 

       
    }
   
    public function index(Request $request){
        $cart = Cart::getContent();
        return view('view_cart', ['cart' => $cart]);
    }

    public function add(Request $request){
        //$item = Images::find($request->id);
        $item = Images::join('users', 'users.id', '=', 'images.user_id') 
	       			->select('images.*', 'users.name as username') 
	       			->where('images.id', $request->id) 
	       			->first(); 
        if($item){
         
            //Check if added item is from the same restorant as previus items in cart
            $canAdd = false;
            $attributes = [];
            if(Cart::getContent()->isEmpty()){
                
            }else{
            
                foreach (Cart::getContent() as $key => $cartItem) {
                    $attributes = $cartItem->attributes; 
                    break; 
                }
            } 
      
        
            if(!empty($attributes))
            { 
                foreach ($attributes as $key => $data) {
                    
                    if($item->id == $data['id'])
                    {  
                        $data['qty'] = 1 + $data['qty'];
                        $attributes[$key] = $data;
                        $canAdd = true;
                        break;
                    } 
                }  
            }   
            if($canAdd == true)
            {  
               Cart::add(1, 'cart', 1, 1, $attributes);
                 
            }else{
                if(!empty($item->logo))
                {
                    $image = asset('uploads').'/'.$item->logo;
                }else{
                    $image = asset('uploads').'/no-image.png';
                }
                
                $attributes[$item->id] = array('id'=>$item->id,'qty'=>1,'user_id'=>$item->user_id,'image'=>$image,'username'=>$item->username);
                Cart::add(1, 'cart', 1, 1, $attributes);
            } 
        
            return response()->json([
                'data' => Cart::getContent(),
                'status' => true,
                'errMsg' => ''
            ]);
        }else{
            return response()->json([
                'status' => false,
                'errMsg' => "You can't add items!"
            ]); 
        }
    }

    public function getContent(){
        //Cart::clear();
        return response()->json([
            'data' => Cart::getContent(),
            'total' => 0,
            'totalFormat' => 0,
            'withDelivery' => 0,
            'withDeliveryFormat' => 0,
            'status' => true,
            'errMsg' => ''
        ]);
    }

    public function minutesToHours($numMun){
        $h =(int) ($numMun/60);
        $min=$numMun%60;
        if($min<10){
            $min="0".$min;
        }

        $time=$h.":".$min;
        if(env('TIME_FORMAT',"24hours")=="AM/PM"){
            $time=date("g:i A", strtotime($time));
        }
        return $time;
    }


    /*"0_from" => "09:00"
  "0_to" => "20:00"
  "1_from" => "09:00"
  "1_to" => "20:00"
  "2_from" => "09:00"
  "2_to" => "20:00"
  "3_from" => "09:00"
  "3_to" => "20:00"
  "4_from" => "09:00"
  "4_to" => "20:00"
  "5_from" => "09:00"
  "5_to" => "17:00"
  "6_from" => "09:00"
  "6_to" => "17:00"*/

  /*
    "0_from" => "9:00 AM"
  "0_to" => "8:10 PM"
  "1_from" => "9:00 AM"
  "1_to" => "8:00 PM"
  "2_from" => "9:00 AM"
  "2_to" => "8:00 PM"
  "3_from" => "9:00 AM"
  "3_to" => "8:00 PM"
  "4_from" => "9:00 AM"
  "4_to" => "8:00 PM"
  "5_from" => "9:00 AM"
  "5_to" => "5:00 PM"
  "6_from" => "9:00 AM"
  "6_to" => "5:00 PM"
   */

    public function getMinutes($time){
        $parts=explode(':',$time);
        return ((int)$parts[0])*60+(int)$parts[1];
    }



    public function getTimieSlots($hours){

        $ourDateOfWeek=[6,0,1,2,3,4,5][date('w')];
        $restaurantOppeningTime=$this->getMinutes(date("G:i", strtotime($hours[$ourDateOfWeek."_from"])));
        $restaurantClosingTime=$this->getMinutes(date("G:i", strtotime($hours[$ourDateOfWeek."_to"])));


        //Interval
        $intervalInMinutes=env('DELIVERY_INTERVAL_IN_MINUTES',30);

        //Generate thintervals from
        $currentTimeInMinutes= Carbon::now()->diffInMinutes(Carbon::today());
        $from= $currentTimeInMinutes>$restaurantOppeningTime?$currentTimeInMinutes:$restaurantOppeningTime;//Workgin time of the restaurant or current time,



        //print_r('now: '.$from);
        //To have clear interval
        $missingInterval=$intervalInMinutes-($from%$intervalInMinutes); //21

        //print_r('<br />missing: '.$missingInterval);

        //Time to prepare the order in minutes
        $timeToPrepare=30; //30

        //First interval
        $from+= $timeToPrepare<=$missingInterval?$missingInterval:($intervalInMinutes-(($from+$timeToPrepare)%$intervalInMinutes))+$timeToPrepare;

        //$from+=$missingInterval;

        //Generate thintervals to
        $to= $restaurantClosingTime;//Closing time of the restaurant or current time


        $timeElements=[];
        for ($i=$from; $i <= $to ; $i+=$intervalInMinutes) {
            array_push($timeElements,$i);
        }
        //print_r("<br />");
        //print_r($timeElements);



        $slots=[];
        for ($i=0; $i < count($timeElements)-1 ; $i++) {
            array_push($slots,[$timeElements[$i],$timeElements[$i+1]]);
        }

        //print_r("<br />SLOTS");
        //print_r($slots);


        //INTERVALS TO TIME
        $formatedSlots=[];
        for ($i=0; $i < count($slots) ; $i++) {
            $key=$slots[$i][0]."_".$slots[$i][1];
            $value=$this->minutesToHours($slots[$i][0])." - ".$this->minutesToHours($slots[$i][1]);
            $formatedSlots[$key]=$value;
            //array_push($formatedSlots,[$key=>$value]);
        }



        return($formatedSlots);


    }

    public function getRestorantHours($restorantID){
          //Create all the time slots
          //The restaurant
          $restaurant=Restorant::findOrFail($restorantID);
          
          $timeSlots=$restaurant->hours?$this->getTimieSlots($restaurant->hours->toArray()):[];

          //Modified time slots for app
          $timeSlotsForApp=[];
          foreach ($timeSlots as $key => $timeSlotsTitle) {
             array_push($timeSlotsForApp,array('id'=>$key,'title'=>$timeSlotsTitle));
          }

          //Working hours
          $ourDateOfWeek=[6,0,1,2,3,4,5][date('w')];
  
          $format="G:i";
          if(env('TIME_FORMAT',"24hours")=="AM/PM"){
              $format="g:i A";
          }
  
  
          $openingTime=date($format, strtotime($restaurant->hours[$ourDateOfWeek."_from"]));
          $closingTime=date($format, strtotime( $restaurant->hours[$ourDateOfWeek."_to"]));

          $params = [
            'restorant' => $restaurant,
            'timeSlots' => $timeSlotsForApp,
            'openingTime' => $restaurant->hours&&$restaurant->hours[$ourDateOfWeek."_from"]?$openingTime:null,
            'closingTime' => $restaurant->hours&&$restaurant->hours[$ourDateOfWeek."_to"]?$closingTime:null,
         ];

         if($restaurant){
            return response()->json([
                'data' => $params,
                'status' => true,
                'errMsg' => ''
            ]);
        }else{
            return response()->json([
                'status' => false,
                'errMsg' => 'Restorants not found!'
            ]);
        }

    }

    public function cart(){
       
        $params = [
            'title' => 'Shopping Cart Checkout',
            'data' => Cart::getContent(),
            'restorant' => '',
            'timeSlots' => '',
            'openingTime' => '',
            'closingTime' => '',
        ]; 

        //Open for all
        return view('cart')->with($params);
    }

    public function clear(Request $request){
 
        //Find first status id,
        ///$oreder->stauts()->attach($status->id,['user_id'=>auth()->user()->id]);
        Cart::clear();
        return redirect()->route('front')->withStatus(__('Cart clear.'));
        //return back()->with('success',"The shopping cart has successfully beed added to the shopping cart!");;
    }


    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function remove(Request $request){
       // $item = Images::find($request->id);
        $item_id = $request->id;

        $attributes = array();
        foreach (Cart::getContent() as $key => $cartItem) {
            $attributes = $cartItem->attributes; 
            break; 
        }
        $canAdd = false;

        if(!empty($attributes))
        { 
            foreach ($attributes as $key => $data) {
                
                if($item_id == $data['id'])
                {   
                    unset($attributes[$key]); 
                    $canAdd = true;
                    break;
                } 
            }  
        }  
 
        if($canAdd == true)
        {   
            Cart::update(1, array('attributes' => $attributes));

            return response()->json([ 
                'status' => true,
                'errMsg' => ''
            ]);

        }else{

            return response()->json([
                'errMsg' => "Item can't be found!",
                'status' => false
            ], 401);

        }
    }

    /**
     * Makes general api resonse
     */
    private function generalApiResponse(){
        return response()->json([
            'status' => true,
            'errMsg' => ''
        ]);
    }

    /**
     * Updates cart
     */
    private function updateCartQty($howMuch,$item_id){ 

        $attributes = array();
        foreach (Cart::getContent() as $key => $cartItem) {
            $attributes = $cartItem->attributes; 
            break; 
        }
        $canAdd = false;

        if(!empty($attributes))
        { 
            foreach ($attributes as $key => $data) {
                
                if($item_id == $data['id'])
                {  
                    if($howMuch == 1)
                    {
                        $data['qty'] = 1 + $data['qty'];
                    }else{
                        $data['qty'] = $data['qty'] - 1;
                    }
                    if($data['qty'] > 0)
                    {
                        $attributes[$key] = $data;
                    }else{
                        unset($attributes[$key]);
                    } 
                    $canAdd = true;
                    break;
                } 
            }  
        }  
 
        if($canAdd == true)
        {   
            Cart::update(1, array('attributes' => $attributes));
        } 
        return $this->generalApiResponse();
    }


    /**
     * Increase cart
     */
    public function increase($image_id){ 
       return $this->updateCartQty(1,$image_id);
    }

    /**
     * Decrese cart
     */
    public function decrease($image_id){
        return $this->updateCartQty(-1,$image_id);
    }

}

