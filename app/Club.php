<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    //

    protected $table = 'clubs';

    public $timestamp = false; 

    public function getClubList(){
    	$groups; 
    	$winners  =  self::where('is_winner', 'Yes')->inRandomOrder()->get()->toArray();
    	$skipIds  =  '';
        $groupIndex = ["A", "B", "C", "D", "E", "F", "G", "H"]; 
        $index = 0; 
    	foreach ($winners as $index => $winner) {
           // info(strlen($skipIds));
    		if(strlen($skipIds) > 0){
    			$skipId   = explode(',', $skipIds);
    		}else{
    			$skipId[] = $winner['id'];
    			$skipIds  = $winner['id']; 
    		}
    		// calling function to get non winner member list of different countries 
    		$nonWinner = $this->getNonWiningClub($winner['country'], $skipIds); 
    		// Add winner in to member list 
    		$nonWinner->push($winner); 
    		$memberList = $nonWinner->reverse(); 
    		$memberList = json_decode(json_encode(array_merge($memberList->toArray())));
    		$groups[$index]['name'] = 'Group '.$groupIndex[$index];
    		$groups[$index]['members']  = $memberList;
    		$skipIds = $skipIds.','. implode(',', $nonWinner->pluck('id')->all()); 
    		$index = $index + 1;
    	}
    	return array_chunk($groups, 4);
    }


   	// Private function to get non winner member list of different countries 
    private function getNonWiningClub($countryName, $skipId){
        info($skipId);
        $skipId = explode(',', $skipId);
    	return  self::select('clubs.*')->where('is_winner', 'No')
    						->where('country', '!=', $countryName)
    						->whereNotIn('id', $skipId)->distinct('clubs.country')
    						->inRandomOrder()->limit(3)->get();

    }
}
