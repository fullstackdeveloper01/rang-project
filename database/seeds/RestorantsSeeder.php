<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RestorantsTableSeeder extends Seeder
{

    public function shuffle_assoc(&$array) {
        $keys = array_keys($array);

        shuffle($keys);

        foreach($keys as $key) {
            $new[$key] = $array[$key];
        }

        $array = $new;

        return true;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /*$pizza = json_decode(File::get('database/seeds/json/pizza_res.json'),true);
        foreach (json_decode($pizza,true) as $key => $value) {
           print_r($key."\n");
           print_r(json_encode($value)."\n");
        }*/


        //Restorant owner
         DB::table('users')->insert([
            'name' => "Demo Owner",
            'email' =>  "owner@example.com",
            'password' => Hash::make("secret"),
            'api_token' => Str::random(80),
            'email_verified_at' => now(),
            'phone' =>  "",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //Assign owner role
        DB::table('model_has_roles')->insert([
            'role_id' => 2,
            'model_type' =>  'App\User',
            'model_id'=> 2
        ]);

        $pizza=json_decode(File::get(base_path('database/seeds/json/pizza_res.json')),true);
        $mex=json_decode(File::get(base_path('database/seeds/json/mexican_res.json')),true);
        $burg=json_decode(File::get(base_path('database/seeds/json/burger_res.json')),true);
        $reg=json_decode(File::get(base_path('database/seeds/json/regular_res.json')),true);

        $restorants=array();

        $this->shuffle_assoc($pizza);
        $this->shuffle_assoc($mex);
        $this->shuffle_assoc($burg);
        $this->shuffle_assoc($reg);

 
        $this->shuffle_assoc($pizza);
        $this->shuffle_assoc($mex);
        $this->shuffle_assoc($burg);
        $this->shuffle_assoc($reg); 


        $id=1;
        $catId=1;
        foreach ($restorants as $key => $restorant) {
            DB::table('restorants')->insert([
                'name'=>$restorant['name'],
                'logo'=>$restorant['image'],
                'subdomain'=>strtolower(preg_replace('/[^A-Za-z0-9]/', '', $restorant['name'])),
                'user_id'=>2,
                'created_at' => now(),
                'updated_at' => now(),
                'lat' => 42.005,
                'lng' => 21.44,
                'address' => '6 Yukon Drive Raeford, NC 28376',
                'phone' => '(530) 625-9694',
                'description'=>$restorant['description'],
                'minimum'=>10,
            ]);

            DB::table('hours')->insert([
                'restorant_id' => $id,
                '0_from' => '05:00',
                '0_to' => '23:00',
                '1_from' => '05:00',
                '1_to' => '23:00',
                '2_from' => '05:00',
                '2_to' => '23:00',
                '3_from' => '05:00',
                '3_to' => '23:00',
                '4_from' => '05:00',
                '4_to' => '23:00',
                '5_from' => '05:00',
                '5_to' => '23:00',
                '6_from' => '05:00',
                '6_to' => '23:00',
            ]);

            foreach ($restorant['items'] as $category => $categoryData) {
                DB::table('categories')->insert([
                    'name'=>$category,
                    'restorant_id'=>$id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                foreach ($categoryData as $key => $menuItem) {
                    DB::table('items')->insert([
                        'name'=>isset($menuItem['title'])?$menuItem['title']:"",
                        'description'=>isset($menuItem['description'])?$menuItem['description']:"",
                        'image'=>isset($menuItem['image'])?$menuItem['image']:"",
                        'price'=>isset($menuItem['price'])?$menuItem['price']:"",
                        'category_id'=>$catId,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
                $catId++;
            }

            $id++;
        }

    }
}
