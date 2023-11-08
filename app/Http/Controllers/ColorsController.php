<?php
namespace App\Http\Controllers;
 
use App\Images;
use App\Restorant;
use App\User;
use App\ImageColors;
use App\Colors;
use App\ImageDesignPatterns;
use App\Helpers\ImaggaAPI;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Validator; 
 
use Maatwebsite\Excel\Facades\Excel;
use PHPUnit\Util\Json;

class ColorsController extends Controller
{ 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        $search = $request->search; 
       
        if(auth()->user()){ 
           
            if(empty($search))
            {
                $colors = Colors::orderBy('id', 'desc')->paginate(10); 
            }else{
                $stripedQuery='%'.strip_tags($search)."%"; 
                $colors = Colors::where('name', 'like', $stripedQuery)->paginate(10);
            }  
            return view('colors.index', ['colors' => $colors, 'search' => $search]); 

        }else return redirect()->route('orders.index')->withStatus(__('No Access'));
    }
 

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(auth()->user()){
            return view('colors.create');
        }else return redirect()->route('orders.index')->withStatus(__('No Access'));
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate first
        $request->validate([  
            'name' => "required",
        ]);  
 
 
        //Create Images
        $colors = new Colors;
        $colors->name = $request->name;
        $colors->code = $request->code; 
        $colors->user_id = auth()->user()->id; 
        $colors->save(); 
 
        
        return redirect()->route('colors.create')->withStatus(__('Color successfully created.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restorant  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Colors $color)
    {          
        if($color){ 
            return view('colors.edit',['color' => $color]);
        }
        return redirect()->route('home')->withStatus(__('No Access'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Colors $color)
    {
         
        // Validate first
         $request->validate([ 
            'name' => "required", 
        ]);  
 
        //Create Restorant 
        $color->name = $request->name; 
        $color->code = $request->code; 
        
        $color->update(); 

        if(auth()->user()->hasRole('admin')){
            return redirect()->route('colors.index')->withStatus(__('Color successfully updated.'));
        }else{
            return redirect()->route('colors.index')->withStatus(__('Color successfully updated.'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restorant  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Colors $color)
    {  
        $color->status=0;
        $color->delete(); 
        return redirect()->route('colors.index')->withStatus(__('Color successfully deleted.'));
    } 
    public function show(Colors $color)
    {
         
    } 

    public function storeNewOptions(Request $request)
    {  
        $name = $request->name; 

        if(empty($name))
        {
            echo json_encode(['status'=> 0, 'message' => 'Please enter name']); die;
        }
        $is_check = Colors::where('name', $name)->first();
        if($is_check)
        {
            echo json_encode(['status'=> 0, 'message' => 'Colors Already exists']); die;
                
        }else{

            $colors = new Colors;
            $colors->name = $name; 
            $colors->user_id = auth()->user()->id; 
            $colors->save(); 
            $colors_id = $colors->id; 

            echo json_encode(['status'=> 1,'id' =>$colors_id]); die;
        } 
          echo json_encode(['status'=> 0,'message' => 'something went wrong please try again']); die;
                
    }
}