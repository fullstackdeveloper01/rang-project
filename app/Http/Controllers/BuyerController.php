<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Order;
use App\Status;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Notifications\DriverCreated;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('admin')){
            return view('buyer.index', ['buyers' =>User::role('buyer')->orderBy('id', 'desc')->paginate(15)]);
        }else return redirect()->route('orders.index')->withStatus(__('No Access'));
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $buyer)
    { 
        $buyer->delete();
        // $buyer->active=0;
        // $buyer->save();
        // User::where('id', $buyer->id)->delete(); 

        return redirect()->route('buyer.index')->withStatus(__('Buyer successfully deleted.'));
    }

     
}
