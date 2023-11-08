<?php
namespace App\Http\Controllers;
 
use App\Images; 
use App\User;
use App\ImageColors;
use App\UserRequest;
use App\ImageDesignPatterns; 
use App\UserRequestManufacturer; 
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Validator;  

class UserRequestController extends Controller
{
    
    /**
     * Display a listing of the request.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(auth()->user()->hasRole('admin')){ 
            $request = UserRequest::orderBy('id', 'desc')->paginate(10);
            return view('user_request.admin', ['requests' => $request]); 

        }else if(auth()->user()->hasRole('manufacturer'))
        {  
            $request = UserRequest::join('request_manufacturer', 'user_request.id', '=', 'request_manufacturer.request_id')
            ->select('user_request.*', 'request_manufacturer.status as manuf_status', 'request_manufacturer.is_accept')  
            ->where('request_manufacturer.manufacturer_id', auth()->user()->id)->orderBy('user_request.id', 'desc')->groupBy('user_request.id')->paginate(10);
            
            return view('user_request.manufacturer', ['requests' => $request]);
        }else return redirect()->route('orders.index')->withStatus(__('No Access'));

        // }else if(auth()->user()->hasRole('buyer'))
        // {  
        //     $request = UserRequest::where('buyer_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(10);
        //     return view('user_request.buyer', ['requests' => $request]);
        // }else return redirect()->route('orders.index')->withStatus(__('No Access'));
    }

    /**
     * Display a buyer request
     *
     * @return \Illuminate\Http\Response
     */
    public function send_request()
    { 
        if( auth()->user())
        {  
            $request = UserRequest::where('buyer_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(10);
            return view('user_request.buyer', ['requests' => $request]);
        }else return redirect()->route('orders.index')->withStatus(__('No Access'));
    }

    /**
     * Display a single request
     *
     *@param Request id 
     *@return \Illuminate\Http\Response
     */
    public function view($userRequestID)
    {
        if(!empty($userRequestID))
        {
            $userRequest = UserRequest::find($userRequestID);
            
            if($userRequest)
            {
                $user_manufacturer = UserRequestManufacturer::where('request_id', $userRequestID)->where('manufacturer_id', auth()->user()->id)->first();
               
                return view('user_request.view', ['request' => $userRequest, 'user_manufacturer'=> $user_manufacturer]); 
            } 
        }
        return redirect()->back()->withStatus(__('Request Not found.'));
    }   

    /**
     * Buyer accpet request 
     *
     *@param Request id
     *@param Request Manufacture id
     *@return \Illuminate\Http\Response
     **/
    public function buyer_accept_request($userRequestID, $manuf_id)
    {
        $user_id = auth()->user()->id; 

        $userRequest = UserRequest::find($userRequestID);

        if(!empty($userRequest) && $user_id)
        {
            $userRequestManufacturer = UserRequestManufacturer::where('id', $manuf_id)->first();
         
            if(!empty($userRequestManufacturer))
            {
                if(($userRequestManufacturer->request_id == $userRequestID))
                { 
                    $userRequestManufacturer->is_accept = 1;
                    $userRequestManufacturer->accept_date = date('Y-m-d H:i:s');
                    $userRequestManufacturer->save();

                    $userRequest->status = 1;
                    $userRequest->save();

                    return redirect()->back()->withStatus(__('Request Accepted.')); 
                } 
            }
        }
        return redirect()->back()->withStatus(__('Request not found.'));
    }

    /**
     * Change request status
     *
     *@param Request id
     *@param Request Status
     *@return \Illuminate\Http\Response
     */
    public function request_status($userRequestID, $status)
    { 
        if(!empty($userRequestID))
        {
            $user_id = auth()->user()->id;

            $userRequest = UserRequest::find($userRequestID);
            
            if($userRequest)
            {
                $userRequestManufacturer = UserRequestManufacturer::where('manufacturer_id', $user_id)->where('request_id', $userRequestID)->first();
                
                if($userRequestManufacturer)
                {
                    $userRequestManufacturer->status = $status; 
                    $userRequestManufacturer->update(); 

                    return redirect()->back()->withStatus(__('Request status successfully changed.'));
                }

            } 
        }
        return redirect()->back()->withStatus(__('Request Not found.'));
         
        
    }

}