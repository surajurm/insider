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
        $skipIds = [];
    	foreach ($winners as $index => $winner) {
            $country[] = $winner['country'];
    		if(count($skipIds) == 0){
    			$skipIds[]  = $winner['id'];
    		}
    		$nonWinner = $this->getNonWiningClub($winner['country'], $skipIds); 
            $memberList = Arr::prepend($nonWinner, $winner);
    		$groups[$index]['name'] = 'Group '.$groupIndex[$index];
    		$groups[$index]['members']  = $memberList;
            info($winner['id']);
            $memberId  = array_pluck($nonWinner, 'id');
            $skipIds = array_merge($memberId, $skipIds);
    	}
    	return array_chunk($groups, 4);
    }


   	// Private function to get non winner member list of different countries 
    private function getNonWiningClub($countryName, $skipId){
        info('----------------------------');
        $country[] = $countryName; 
        $getIds ;
        
        for ($i=0; $i < 3; $i++) { 
            $uniqueCountry = \DB::table('clubs')->select('id', 'country')->where('is_winner', 'No')->whereNotIn('country', $country)->whereNotIn('id', $skipId)->groupBy('id','country')->limit(1)->first(); 
            $country[]  = $uniqueCountry->country; 
            $skipId = Arr::prepend($skipId, $uniqueCountry->id);
            $getIds[]  = $uniqueCountry->id;
        } 
        return self::whereIn('id', $getIds)->inRandomOrder()->get()->toArray();
    }
}
