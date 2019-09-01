<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Club extends Model
{
    //

    protected $table = 'clubs';

    public $timestamp = false; 

    public function getClubList(){
    	$groups; 
    	$winners  =  self::where('is_winner', 'Yes')->inRandomOrder()->get()->toArray();
        $groupIndex = ["A", "B", "C", "D", "E", "F", "G", "H"]; 
        $index = 0; 
        $skipIds = '';
        $nonWinner = self::where('is_winner', 'No')->inRandomOrder()->get()->toArray(); 

    	foreach ($winners as $index => $winner) {

            $country[] = $winner['country'];

            // info(strlen($skipIds));
    		if(strlen($skipIds) == 0){
    			$skipIds  = $winner['id'];
    		}
    		
    		$nonWinner = $this->getNonWiningClub($winner['country'], $skipIds); 
    		
            $memberList = Arr::prepend($nonWinner, $winner);
          
    		$groups[$index]['name'] = 'Group '.$groupIndex[$index];
    		$groups[$index]['members']  = $memberList;
            info($winner['id']);
            $memberId  = array_pluck($nonWinner, 'id'); 

            /* dd($memberId);*/
    		if(strlen($skipIds) == 1){
                $skipIds = implode(',',$memberId); 
            }else{
                $skipIds = $skipIds.','. implode(',',$memberId);    
            }
    		//dd($skipIds);
            $index = $index + 1;
    	}
    	return array_chunk($groups, 4);
    }


   	// Private function to get non winner member list of different countries 
    private function getNonWiningClub($countryName, $skipId){
        info('----------------------------');
        $skipIds = explode(',', $skipId);
        $country[] = $countryName; 
        $getIds ;

        for ($i=0; $i < 3; $i++) { 
            $uniqueCountry = \DB::table('clubs')->select('id', 'country')->where('is_winner', 'No')->whereNotIn('country', $country)->whereNotIn('id', $skipIds)->groupBy('id','country')->limit(1)->first(); 
            $country[]  = $uniqueCountry->country; 
            $skipIds = Arr::prepend($skipIds, $uniqueCountry->id);
            $getIds[]  = $uniqueCountry->id;
        } 
       
      
        info(json_encode($country));
        info('----------------------------');
        info(json_encode($getIds));
        return self::whereIn('id', $getIds)->inRandomOrder()->get()->toArray();
    }
}
