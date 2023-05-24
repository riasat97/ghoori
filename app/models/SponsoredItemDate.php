<?php

use Carbon\Carbon;

class SponsoredItemDate extends \Eloquent {
    protected $table = 'sponsored_item_dates';
	protected $guarded = [];
    protected $dt; //DateTime manager
    public function __construct(array $attributes = array()){
        parent::__construct($attributes);
        $this->dt = new Carbon();
    }

    public function getOccupiedDates($position,$group,$capacity=1,$offset = 60, $startDate = null){
        if(is_null($startDate)) {
            $startDate = $this->dt->tomorrow()->toDateString();
        }
        $endDate = $this->dt->parse($startDate)->addDays($offset)->toDateString();
        $occupiedDates = DB::table($this->table)
            ->select('sponsored_item_dates.date')
            ->join('sponsored_items', 'sponsored_item_dates.sponsored_item_id', '=', 'sponsored_items.id')
            ->where('sponsored_item_dates.date','>=',$startDate)
            ->where('sponsored_item_dates.date','<=',$endDate)
            ->where('sponsored_item_dates.group',$group)
            ->where('sponsored_item_dates.position',$position)
            ->where(function($query)
            {
                $query->where('sponsored_items.reviewStatus','=', 'accepted')
                        ->orWhere('sponsored_items.reviewStatus', '=', 'pending');
            })            
            ->groupBy('sponsored_item_dates.date')
            ->havingRaw("COUNT(sponsored_item_dates.date) >= $capacity")
            ->lists('date');
        return $occupiedDates;
    }

    function datesAreAvailable($position,$group,array $dates,$capacity=1,$offset=60,$startDate = null){
        $occupiedDates = $this->getOccupiedDates($position,$group,$capacity,$offset,$startDate);
        $conflictDates = array_intersect($dates,$occupiedDates);
        return (count($conflictDates)==0);
    }

    function sponsoredItem(){
        return $this->belongsTo('SponsoredItem','sponsored_item_id');
    }
}