<?php

namespace App\Http\Controllers;
use App\Restorant;
use App\Items;
use Illuminate\Http\Request;
use App\Images;
use App\User;
use App\UserRequest;
use App\Colors;
use App\DesignPatterns;


class FrontEndController extends Controller
{
    public function getSubDomain(){
        $subdomain = substr_count($_SERVER['HTTP_HOST'], '.') > 1 ? substr($_SERVER['HTTP_HOST'], 0, strpos($_SERVER['HTTP_HOST'], '.')) : '';
        if($subdomain==""|in_array($subdomain,config('app.ignore_subdomains'))){
            return false;
        }
        return $subdomain;
    }

    public function index(Request $request){ 
         
        $search_q = "";
        

        $images = $images = Images::join('users', 'users.id', '=', 'images.user_id')
                    ->leftJoin('image_colors', 'image_colors.image_id', '=', 'images.id')
                    ->leftJoin('image_design_patterns', 'image_design_patterns.image_id', '=', 'images.id')
	       			->select('images.*', 'users.name as username', 'users.profile_image', 'images.user_id') 
                    ->orderBy('images.id', 'desc')
	       			->groupBy('images.id')
	       			->get();

        if(\Request::has('q')&&strlen(\Request::input('q'))>1){

             $search_q = strip_tags($request->q);

             $colors = Colors::where('status', 1)
                        ->where(function($q) use($search_q) {
                            $searchValues = preg_split('/\s+/',$search_q, -1, PREG_SPLIT_NO_EMPTY);

                            foreach ($searchValues as $value) {
                                $stripedQuery='%'.strip_tags($value)."%";
                                $q->orWhere('name', 'like', $stripedQuery); 
                            }  
                        })->pluck('id');
                        
            $designPatterns = DesignPatterns::where('status', 1)
                ->where(function($q) use($search_q) {
                    $searchValues = preg_split('/\s+/',$search_q, -1, PREG_SPLIT_NO_EMPTY);

                    foreach ($searchValues as $value) {
                        $stripedQuery='%'.strip_tags($value)."%";
                        $q->orWhere('name', 'like', $stripedQuery); 
                    }  
                })->pluck('id');

            $images = Images::join('users', 'users.id', '=', 'images.user_id')
                    ->leftJoin('image_colors', 'image_colors.image_id', '=', 'images.id')
                    ->leftJoin('image_design_patterns', 'image_design_patterns.image_id', '=', 'images.id')
                    ->select('images.*', 'users.name as username', 'users.profile_image', 'images.user_id') 
                    ->where('images.status', 1)
                    ->where(function ($query) use($colors, $designPatterns) {
                        $query->orWhereIn('image_colors.color_id', $colors);
                        $query->orWhereIn('image_design_patterns.pattern_id', $designPatterns);
                    })
                    ->orderBy('images.id', 'desc')
                    ->groupBy('images.id')
                    ->get(); 
	       			
            //1. Find all items
            $items = Items::where(['available' => 1])->where(function ($q) {
                        $stripedQuery='%'.strip_tags(\Request::input('q'))."%";
                        $q->where('name', 'like',$stripedQuery)->orWhere('description', 'like',$stripedQuery);
                    })
                    ->with('category.restorant')
                    ->get();

          

           $restorants=array();
           foreach($items as $item) {
                if(isset($item->category)){
                    if(isset($restorants[$item->category->restorant_id])){
                        //Enlarge
                        $restorants[$item->category->restorant_id]->items_count++;
                    }else{
                        //Add
                        $restorants[$item->category->restorant_id]=$item->category->restorant;
                        $restorants[$item->category->restorant_id]->items_count=1;
                    }
                }
            }
 
            $restorantsQ = Restorant::where(['active' => 1])->where(function ($q) {
                $stripedQuery='%'.strip_tags(\Request::input('q'))."%";
                $q->where('name', 'like',$stripedQuery)->orWhere('description', 'like',$stripedQuery);
            });
            //dd($restorantsQ->get()->toArray());

            foreach($restorantsQ->get() as $restorant) {
                
                    if(isset($results[$restorant->id])){
                        //Enlarge - more value
                        $restorants[$restorant->id]->items_count+=5;
                    }else{
                        //Add
                        $restorants[$restorant->id]=$restorant;
                        $restorants[$restorant->id]->items_count=5;
                    }
                
            }
            
            
           // dd();

            usort($restorants, function($a, $b) {return strcmp($a->items_count, $b->items_count);});
        }else{
            $restorants = Restorant::where('active', 1)
                //->orderBy('name', 'desc')
                ->get();
        }

        return view('welcome',['images'=> $images, 'search_q'=>$search_q, 'restorants' =>$restorants,'title'=>\Request::has('q')&&strlen(\Request::input('q'))>1?__('Restaurant where you can find ').\Request::input('q'):__('Popular restaurants')]);
    }
    
    public function index2(){

        $restorant = Restorant::where('id',40)->first();  
             
        return view('manufacturer.dashboard',['restorant' =>$restorant]);
    }

    public function index3($manufacturer_id){ 

        $manufacturer = User::where('id',$manufacturer_id)->first();
        
        if($manufacturer)
        { 
            return view('manufacturer.dashboard',['restorant' =>$manufacturer]);
        }
        abort(404);
             
        
    }

    public function view_image($image_id){ 

        $image = Images::join('users', 'users.id', '=', 'images.user_id') 
	       			->select('images.*', 'users.name as username', 'users.profile_image') 
	       			->where('images.id', $image_id) 
                    ->orderBy('images.id', 'desc')
	       			->groupBy('images.user_id')
	       			->first(); 
 
       // $image = Images::where('id',$image_id)->first();
        
        if($image)
        { 
            $images = Images::join('users', 'users.id', '=', 'images.user_id') 
                ->select('images.*', 'users.name as username', 'users.profile_image', 'images.user_id') 
                ->where('images.user_id', $image->user_id) 
                ->where('images.id', '<>', $image->id)
                ->orderBy('images.id', 'desc')
                ->groupBy('images.id')
                ->orderBy('id','desc')
                ->take(8)
                ->get();  

            return view('image_vector',['restorant' =>$image, 'images'=>$images]);
        }
        abort(404);
             
        
    }

    public function manufacturer_profile(Request $request)
    {  
        $user = auth()->user();  
        $user_id = $user->id;  
        
        $images = Images::select('name','logo','id','description') 
                        ->where('user_id', $user_id) 
                        ->orderBy('id', 'desc') 
                        ->paginate(5);
        
        if ($request->ajax()) {

            $view = view('front.partials.image-list', compact('images'))->render();
    
            return response()->json(['html' => $view]);
        }  
        return view('front.manufacturer_profile', compact('images', 'user')); 
    }
 

    public function restorant($alias){
        $subDomain=$this->getSubDomain();
        if($subDomain&&$alias!==$subDomain){
            return redirect()->route('restorant',$subDomain);
        }
        $restorant = Restorant::where('subdomain',$alias)->get();


        //Working hours
        $ourDateOfWeek=[6,0,1,2,3,4,5][date('w')];

        $format="G:i";
        if(env('TIME_FORMAT',"24hours")=="AM/PM"){
            $format="g:i A";
        }

        /*$openingTime=date($format, strtotime($restorant[0]->hours[$ourDateOfWeek."_from"]));
        $closingTime=date($format, strtotime($restorant[0]->hours[$ourDateOfWeek."_to"]));

        return view('restorants.show',[
            'restorant' => $restorant[0],
            'openingTime' => $restorant[0]->hours&&$restorant[0]->hours[$ourDateOfWeek."_from"]?$openingTime:null,
            'closingTime' => $restorant[0]->hours&&$restorant[0]->hours[$ourDateOfWeek."_to"]?$closingTime:null,
        ]);*/

        $openingTime = $restorant[0]->hours&&$restorant[0]->hours[$ourDateOfWeek."_from"] ? date($format, strtotime($restorant[0]->hours[$ourDateOfWeek."_from"])) : null;
        $closingTime = $restorant[0]->hours&&$restorant[0]->hours[$ourDateOfWeek."_to"] ? date($format, strtotime($restorant[0]->hours[$ourDateOfWeek."_to"])) : null;

        return view('restorants.show',[
            'restorant' => $restorant[0],
            'openingTime' => $openingTime,
            'closingTime' => $closingTime,
        ]);
    }
}
