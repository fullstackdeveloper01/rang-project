<?php
namespace App\Http\Controllers;
 
use App\Images;
use App\Restorant;
use App\User;
use Auth;
use App\Colors;
use App\DesignPatterns;
use App\ImageColors;
use App\ImageDesignPatterns;
use App\Helpers\ImaggaAPI;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Notifications\RestaurantCreated;
use Illuminate\Support\Facades\Validator;

//use Intervention\Image\Image;
use Image;

use App\Imports\RestoImport;
use Maatwebsite\Excel\Facades\Excel;
use PHPUnit\Util\Json;

class ImageControler extends Controller
{

    protected $imagePath='uploads/images/';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        $search = $request->search;

        if(auth()->user()->hasRole('admin')){ 

            if(!empty($search))
            {
                $images = Images::join('users', 'users.id', '=', 'images.user_id')
                    ->leftJoin('image_colors', 'image_colors.image_id', '=', 'images.id')
                    ->leftJoin('image_design_patterns', 'image_design_patterns.image_id', '=', 'images.id')
                    ->select('images.*') 
                    ->where(function ($q) {
                        $stripedQuery='%'.strip_tags(\Request::input('search'))."%";
                        $q->where('image_colors.name', 'like',$stripedQuery);
                        $q->orWhere('image_design_patterns.name', 'like',$stripedQuery);
                    })
                    ->orderBy('images.id', 'desc')
                    ->groupBy('images.id')
                    ->paginate(10);
            }else{
                $images = Images::orderBy('id', 'desc')->paginate(10);
            }  
            return view('images.index', ['images' => $images, 'search' => $search, 'user_id' => '']); 

        }else if(auth()->user()->hasRole('manufacturer'))
        {  
            if(!empty($search))
            {
                $images = Images::join('users', 'users.id', '=', 'images.user_id')
                    ->leftJoin('image_colors', 'image_colors.image_id', '=', 'images.id')
                    ->leftJoin('image_design_patterns', 'image_design_patterns.image_id', '=', 'images.id')
                    ->select('images.*') 
                    ->where('images.user_id', auth()->user()->id)
                    ->where(function ($q) {
                        // $stripedQuery='%'.strip_tags(\Request::input('search'))."%";
                        // $q->orWhere('image_colors.name', 'like',$stripedQuery);
                        // $q->orWhere('image_design_patterns.name', 'like',$stripedQuery);

                        $searchValues = preg_split('/\s+/', \Request::input('search'), -1, PREG_SPLIT_NO_EMPTY);
                        foreach ($searchValues as $value) {
                            $stripedQuery='%'.strip_tags($value)."%";
                            //$q->orWhere('name', 'like', "%{$value}%");
                            $q->orWhere('image_colors.name', 'like',$stripedQuery);
                            $q->orWhere('image_design_patterns.name', 'like',$stripedQuery);
                        } 
                    })
                    ->orderBy('images.id', 'desc')
                    ->groupBy('images.id')
                    ->paginate(10);
            }else{
                $images = Images::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(10);
            }
            

            return view('images.index', ['images' => $images, 'search' => $search, 'user_id' => '']);

        }else return redirect()->route('orders.index')->withStatus(__('No Access'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manufacturer_profile($id, Request $request)
    {   
         $search = $request->search;
  
        if(auth()->user()->hasRole('admin')){ 

            if(!empty($search))
            {
                $images = Images::join('users', 'users.id', '=', 'images.user_id')
                    ->leftJoin('image_colors', 'image_colors.image_id', '=', 'images.id')
                    ->leftJoin('image_design_patterns', 'image_design_patterns.image_id', '=', 'images.id')
                    ->select('images.*') 
                    ->where(function ($q) {
                        $stripedQuery='%'.strip_tags(\Request::input('search'))."%";
                        $q->where('image_colors.name', 'like',$stripedQuery);
                        $q->orWhere('image_design_patterns.name', 'like',$stripedQuery);
                    })
                    ->orderBy('images.id', 'desc')
                    ->groupBy('images.id')
                    ->paginate(10);
            }else{
                $images = Images::where('user_id', $id)->orderBy('id', 'desc')->paginate(10);
            }  
            return view('images.index', ['images' => $images, 'search' => $search, 'user_id' => $id]); 

        }else return redirect()->route('orders.index')->withStatus(__('No Access'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
          
        if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manufacturer')){

            $colors = Colors::orderBy('id', 'desc')->get();  
            $designPatterns = DesignPatterns::orderBy('id', 'desc')->get();
            $manufacturer = [];

            if(auth()->user()->hasRole('admin'))
            {
                $manufacturer = User::role('manufacturer')->pluck('name', 'id');
              
            }    
            return view('images.create', ['colors' => $colors, 'designPatterns' => $designPatterns, 'manufacturers' =>$manufacturer]);
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
        if(auth()->user()->hasRole('admin'))
        {
             //Validate first
            $request->validate([  
                'logo' => ['required'],
                'user_id' => ['required'],
                'patterns' => "required|array",
                'colors' => "required|array", 
            ]);  

        }else{
             //Validate first
            $request->validate([  
                'logo' => ['required'],
                'patterns' => "required|array",
                'colors' => "required|array", 
            ]);  
        }
       
 
 
        //Create Images
        $images = new Images;
        $images->name = $request->name;

        if(auth()->user()->hasRole('admin'))
        {
            $images->user_id = $request->user_id;
        }else{
            $images->user_id = auth()->user()->id;
        }
            
        
        $images->description = $request->description; 
        $colors = $request->colors;
        $patterns = $request->patterns; 
        //strip_tags($request->description.""); 
        $images->save(); 

        $id = $images->id; 
        if(!empty($colors))
        {   
            $colorsArr = [];
            foreach ($colors as $key => $color) {
                $row = [];
                $row['image_id'] = $id;
                $row['color_id'] = $color;
                $colorsArr[] = $row;
            }
            ImageColors::insert($colorsArr); 
        }

        if(!empty($patterns))
        {
            $patternsArr = [];
            foreach ($patterns as $key => $pattern) {
                $row = [];
                $row['image_id'] = $id;
                $row['pattern_id'] = $pattern;
                $patternsArr[] = $row;
            }
            ImageDesignPatterns::insert($patternsArr); 
        } 

        if ($request->file('logo')) {

            $file = $request->file('logo');

            $filename = 'images/'. time().uniqid(rand()) . '_image.' . $file->getClientOriginalExtension();

            $file->move(public_path($this->imagePath), $filename);

            $images->logo = $filename;   

            $images->update();
        } 
        
        return redirect()->route('image.index')->withStatus(__('Image successfully created.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restorant  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Images $image)
    {
         
        if(auth()->user()->id==$image->user_id ||auth()->user()->hasRole('admin')){

            $ccolors = Colors::orderBy('id', 'desc')->get();  
            $ddesignPatterns = DesignPatterns::orderBy('id', 'desc')->get(); 
             
            $colors = ImageColors::select('color_id')->where('image_id', $image->id)->pluck('color_id');  
 
            $designPatterns = ImageDesignPatterns::select('pattern_id')->where('image_id', $image->id)->pluck('pattern_id');  
            
            $colorsArr =[];

            if(!empty($colors))
            {
                foreach($colors as $key => $data)
                {
                    $colorsArr[] = $data;
                }
            } 
            $patternsArr =[];

            if(!empty($designPatterns))
            {
                foreach($designPatterns as $key => $data)
                {
                    $patternsArr[] = $data;
                }
            }
            
            return view('images.edit',['image' => $image, 'colors' => $colorsArr, 'designPatterns'=> $patternsArr, 'ccolors' => $ccolors, 'ddesignPatterns'=> $ddesignPatterns]);
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
    public function update(Request $request, Images $image)
    {
        // Validate first
         $request->validate([ 
            'colors' => "required|array|min:1",
            'patterns' => "required|array|min:1",
        ]);  
 
        //Create Restorant 
        $image->name = $request->name; 
        $image->description = $request->description; 

        $colors = $request->colors;
        $patterns = $request->patterns; 

    
        ImageColors::where('image_id', $image->id)->delete(); 
        ImageDesignPatterns::where('image_id', $image->id)->delete(); 

        $id = $image->id; 
        if(!empty($colors))
        {   
            $colorsArr = [];
            foreach ($colors as $key => $color) {
                $row = [];
                $row['image_id'] = $id;
                $row['color_id'] = $color;
                $colorsArr[] = $row;
            }
            ImageColors::insert($colorsArr); 
        }

        if(!empty($patterns))
        {
            $patternsArr = [];
            foreach ($patterns as $key => $pattern) {
                $row = [];
                $row['image_id'] = $id;
                $row['pattern_id'] = $pattern;
                $patternsArr[] = $row;
            }
            ImageDesignPatterns::insert($patternsArr); 
        } 

        if ($request->file('logo')) {

            $file = $request->file('logo');

            $filename = 'images/'. time().uniqid(rand()) . '_image.' . $file->getClientOriginalExtension();

            $file->move(public_path($this->imagePath), $filename);

            $image->logo = $filename; 
        } 
        
        $image->update(); 

        if(auth()->user()->hasRole('admin')){
            return redirect()->route('image.edit',['id' => $image->id])->withStatus(__('Image successfully updated.'));
        }else{
            return redirect()->route('image.edit',['id' => $image->id])->withStatus(__('Image successfully updated.'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restorant  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Images $image)
    {
        $image->status=0;
        $image->save();

        return redirect()->route('image.index')->withStatus(__('Images successfully deactivated.'));
    }

    public function activateImage(Images $image)
    {
        //Activate the restaurant
        $image->status = 1; 
        $image->update(); 

        return redirect()->route('image.index')->withStatus(__('Image successfully activated.'));
    }
    public function show(Images $image)
    {
         
    } 

    public function addbulkImage(Request $request)
    { 

        if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manufacturer')){

            $colors = Colors::orderBy('id', 'desc')->get();  
            $designPatterns = DesignPatterns::orderBy('id', 'desc')->get();  

            return view('images.bulk-image', ['colors' => $colors, 'designPatterns' => $designPatterns]); 

        }else return redirect()->route('orders.index')->withStatus(__('No Access'));

    }

    public function storebulkImage(Request $request)
    {

        $data = $request->all(); 

        $file = $request->file('csv_file');  
        $fileCount = $request->totalfiles;  
        $image_count = $request->image_count;  

        $colors = $request->colors; 
        $patterns = $request->patterns; 
        

        if(!empty($file))
        { 
              
            //Create Images

            $image = new Images; 

            $ImaggaAPI = ImaggaAPI::instance();

            $image->user_id = auth()->user()->id;  

            $image->save();  

            $filename = 'images/'. time().uniqid(rand()) . '_image.' . $file->getClientOriginalExtension();

            $file->move(public_path($this->imagePath), $filename);

            $image->logo = $filename;  

            $image->update(); 

            $image_id = $image->id; 

            $filename = asset('uploads').'/'.$filename;

            if(!empty($colors))
            {   
                $colors = explode(',', $colors); 

                $colorsArr = [];
                foreach ($colors as $key => $color) {
                    $row = [];
                    $row['image_id'] = $image_id;
                    $row['color_id'] = $color;
                    $colorsArr[] = $row;
                }
                ImageColors::insert($colorsArr); 
            }

            if(!empty($patterns))
            {
                $patterns = explode(',', $patterns); 
        
                $patternsArr = [];
                foreach ($patterns as $key => $pattern) {
                    $row = [];
                    $row['image_id'] = $image_id;
                    $row['pattern_id'] = $pattern;
                    $patternsArr[] = $row;
                }
                ImageDesignPatterns::insert($patternsArr); 
            }    
            echo json_encode(['status'=> 1, 'image_id'=>$image_id, 'image_count' => $image_count, 'rows' => $fileCount, 'fileurl' => $filename]); die; 
        }  

        echo json_encode(['status'=> 0, 'image_count' => 0]); die; 

    } 
    

    public function csvUploadImages(Request $request)
    { 
        if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manufacturer')){

            if($request->file('csv_file'))
            {
                $colors = $request->colors; 
                $patterns = $request->patterns; 

                $csv_file = $request->file('csv_file'); 
 
                $rows = Excel::toArray(new Images, $csv_file);

                if($rows)
                {
                    $row = array_map('array_filter', $rows[0]);
                    $rows = array_filter($row);  

                    echo json_encode(['status'=> 1,'rows' => count($rows), 'image_count' => 0]); die;
                } 
                echo json_encode(['status'=> 0,'rows' => count($rows), 'image_count' => 0]); die;
            }else{
                return view('images.csv-import');
            }  
        }else return redirect()->route('orders.index')->withStatus(__('No Access'));

    }

    public function imageAjaxStore(Request $request)
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manufacturer')){
            
            if($request->file('csv_file'))
            {
                $csv_file = $request->file('csv_file'); 
                $image_count = (int)$request->image_count;
 
                $rows = Excel::toArray(new Images, $csv_file);

                if($rows)
                {
                    $row = array_map('array_filter', $rows[0]);
                    $rows = array_filter($row); 

                    $totalCount = $image_count + 10; 

                    for ($i=$image_count; $i < $totalCount; $i++) { 
                       
                    } 
                    echo json_encode(['status'=> 1,'rows' => count($rows), 'image_count' => $i, 'old' => $image_count]); die;
                } 
                echo json_encode(['status'=> 0,'rows' => 0, 'image_count' => 0]); die;
                

            }
        }
       
    } 

    public function storebulkImage2(Request $request)
    {

        $data = $request->all();

        $images = $request->file('images'); 

        if(!empty($images))

        { 

            $imageArr = [];

            foreach ($images as $key => $file)  
            {

                //Create Images

                $image = new Images; 

                $image->user_id = auth()->user()->id;  

                $image->save();  

                $filename = 'images/'. time().uniqid(rand()) . '_image.' . $file->getClientOriginalExtension();

 
                $file->move(public_path($this->imagePath), $filename);

 
                $image->logo = $filename;  

                $image->update(); 

                $imageArr[$image->id] = $filename;
  
            } 
 
            $colorsArr = [];

            $dessArr = [];

            $ImaggaAPI = ImaggaAPI::instance();
            
            foreach ($imageArr as $image_id => $url) 
            {

               $filename = asset('uploads').'/'.$url;

                $colors = $ImaggaAPI->get_image_colors($filename, $image_id, true);

                $patterns = $ImaggaAPI->get_image_design_patterns($filename, $image_id, true); 

               
                if(!empty($colors))

                {

                   $colorsArr = array_merge($colorsArr, $colors);

                } 

                if(!empty($patterns))

                {

                    $dessArr = array_merge($dessArr, $patterns); 

                }  

            } 

            if(!empty($colorsArr))

            {

                ImageColors::insert($colorsArr); 

            } 

            if(!empty($dessArr))

            {

                ImageDesignPatterns::insert($dessArr); 

            }  

            return redirect()->route('image.index')->withStatus(__('Image successfully created.'));

        }  

        return redirect()->back()->withStatus(__('Something went wrong, please try again.')); 

    } 
    
}