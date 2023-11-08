<?php
namespace App\Http\Controllers;

use Cart;  
use Carbon\Carbon;  
use Illuminate\Http\Request;
use App\Images;
use App\User;
use App\UserRequest;
use App\UserRequestItems;
use App\UsersMaterials;
use App\UserRequestManufacturer;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    public function index(){
        $cart = Cart::getContent(); 

        if($cart->isEmpty()){
            return redirect()->route('front')->withStatus(__('Your cart is empty.'));
        }   

        $materials = DB::table('materials')->orderBy('name', 'asc')->get(); 
        return view('checkout.request',['cart' =>$cart, 'materials'=> $materials]);
    }

    public function ticket($request_id){

        $request = UserRequest::find($request_id);

        if($request)
        { 
           $user_id = auth()->user()->id;
           if($request->buyer_id == $user_id)
           {
                return view('checkout.ticket',['request' =>$request]);
           } 
        } 
        abort(404); 
    }

    public function user_request(Request $request)
    {
        $data = $request->all(); 
        $cart = Cart::getContent();

        if($cart->isEmpty()){
            return redirect()->route('front')->withStatus(__('Your cart is empty.'));
        } 

        $userRequest = new UserRequest; 
        $userRequest->buyer_id = auth()->user()->id;

        // if(!empty($request->fabric_type) && is_array($request->fabric_type))
        // {
        //     $userRequest->fabric_type = implode(',', $request->fabric_type);
        // } 
        
        if($request->width_type == 'tubular')
        {
            if(!empty($request->tubular_inches) && is_array($request->tubular_inches))
            {
                $userRequest->tubular_inches = implode(',', $request->tubular_inches);
            }
        }else{
            if(!empty($request->open_width_inches) && is_array($request->open_width_inches))
            {
                $userRequest->open_width_inches = implode(',', $request->open_width_inches);
            }
        } 

        $fabric_type = $request->fabric_type; 
        
        $userRequest->fabric_type = $request->fabric_type; 
        $userRequest->width_type = $request->width_type; 
        $userRequest->gsm_count = $request->gsm_count; 
        $userRequest->measurement = $request->measurement; 
        $userRequest->design_quantity = $request->quantity; 

        //create new request
        $userRequest->save(); 

        if($userRequest->id)
        {
            $attributes = [];
            $requestItems = [];
            $request_id = $userRequest->id;

            foreach ($cart as $key => $cartItem) {
                $attributes = $cartItem->attributes; 
                break; 
            }

            if(!empty($attributes))
            { 
                $total_quantity = 0;
                foreach ($attributes as $key => $data)
                {
                    $row = [];
                    $row['image_id'] = $data['id'];
                    $row['manufacturer_id'] = $data['user_id'];
                    $row['quantity'] = $data['qty'];
                    $row['request_id'] = $request_id;
                    $row['status'] = 0;
                    $requestItems[] = $row;
                    $total_quantity += $data['qty'];
                } 
                //add request images
                UserRequestItems::insert($requestItems);
                
                $menuf = UsersMaterials::join('users', 'users_material.user_id', '=', 'users.id')
                        ->select('users_material.*')->where('users_material.material_id', $fabric_type)->groupBy('users_material.user_id')->get();
                
                if(!empty($menuf))
                {
                    $menufArr = [];
                    foreach ($menuf as $key => $dataRow)
                    {
                        $row = [];
                        $row['manufacturer_id'] = $dataRow->user_id;
                        $row['request_id'] = $request_id;
                        $menufArr[] = $row; 
                    }
                    UserRequestManufacturer::insert($menufArr);
                }
                //request update
                //$userRequest->total_quantity = $total_quantity;
                //$userRequest->update();
            }
            Cart::clear();

            return redirect()->route('request.ticket', $request_id)->withStatus(__('Ticket created successfully.'));
        }else{
            return redirect()->back()->withStatus(__('Ticket not create'));
        }       

    }
}