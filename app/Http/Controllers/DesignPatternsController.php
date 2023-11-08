<?php
namespace App\Http\Controllers;
  
use App\DesignPatterns;
use App\ImageDesignPatterns;
use App\Helpers\ImaggaAPI;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Validator; 
 
use Maatwebsite\Excel\Facades\Excel;
use PHPUnit\Util\Json;

class DesignPatternsController extends Controller
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
                $colors = DesignPatterns::orderBy('id', 'desc')->paginate(10); 
            }else{
                $stripedQuery='%'.strip_tags($search)."%"; 
                $colors = DesignPatterns::where('name', 'like', $stripedQuery)->paginate(10);
            } 
            return view('designPatterns.index', ['colors' => $colors, 'search' => $search]); 

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
            return view('designPatterns.create');
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
        $colors = new DesignPatterns;
        $colors->name = $request->name; 
        $colors->user_id = auth()->user()->id; 
        $colors->save(); 
 
        
        return redirect()->route('designPatterns.create')->withStatus(__('Design Patterns successfully created.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restorant  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(DesignPatterns $designPattern)
    {          
        if($designPattern){ 
            return view('designPatterns.edit',['color' => $designPattern]);
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
    public function update(Request $request, DesignPatterns $designPattern)
    {
         
        // Validate first
         $request->validate([ 
            'name' => "required", 
        ]);  
 
        //Create Restorant 
        $designPattern->name = $request->name;  
        
        $designPattern->update(); 

        if(auth()->user()->hasRole('admin')){
            return redirect()->route('designPatterns.index')->withStatus(__('Design Patterns successfully updated.'));
        }else{
            return redirect()->route('designPatterns.index')->withStatus(__('Design Patterns successfully updated.'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restorant  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(DesignPatterns $designPattern)
    {  
        $designPattern->status=0;
        $designPattern->delete(); 
        return redirect()->route('designPatterns.index')->withStatus(__('Design Patterns successfully deleted.'));
    } 
    public function show(DesignPatterns $designPatterns)
    {
         
    } 

    public function storeNewOptions(Request $request)
    {  
        $name = $request->name; 
        
        if(empty($name))
        {
            echo json_encode(['status'=> 0, 'message' => 'Please enter name']); die;
        }
        $is_check = DesignPatterns::where('name', $name)->first();
        if($is_check)
        {
            echo json_encode(['status'=> 0, 'message' => 'Pattern Already exists']); die;
                
        }else{

            $designPatterns = new DesignPatterns;
            $designPatterns->name = $name; 
            $designPatterns->user_id = auth()->user()->id; 
            $designPatterns->save(); 
            $id = $designPatterns->id;  
            echo json_encode(['status'=> 1,'id' =>$id]); die;
        } 
        echo json_encode(['status'=> 0,'message' => 'something went wrong please try again']); die;
                
    }
}