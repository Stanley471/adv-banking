<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Plans extends Model {
    use Uuid, SoftDeletes;
    protected $table = "plan";
    protected $fillable = [
        'units', 
        'name', 
        'slug', 
        'edited_by', 
        'created_by', 
        'details', 
        'start_date', 
        'close_date', 
        'expiring_date', 
        'period', 
        'duration', 
        'units', 
        'original', 
        'price', 
        'status', 
        'interest', 
        'image', 
        'type', 
        'cat_id', 
        'fee', 
        'fee_type', 
        'percent_pc', 
        'fiat_pc', 
        'location', 
        'insurance', 
        'type',
        'suitability',
        'how',
        'terms',
        'trustee',
        'custodian',
        'prospectus',
        'recommendation',
        'claim_duration',
        'reminded',
        'min_sell',
        'min_buy',
        'sale_percent',
        'dividend',
        'sell_units',
    ];

    protected $dates = ['expiring_date'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id')->whereType('invest')->withTrashed();
    } 
    
    public function priceHistory()
    {
        return $this->hasMany(PriceHistory::class, 'plan_id')->orderBy('date', 'asc');
    }    

    public function priceHistoryDetails()
    {
        return $this->hasMany(PriceHistory::class, 'plan_id')->whereBetween('date', [$this->last()->date, $this->first()->date])->orderBy('date', 'asc');
    }   
    
    public function yesterdayHistory()
    {
        return PriceHistory::wherePlanId($this->id)->whereDate('date', Carbon::yesterday())->first();
    }
    
    public function first()
    {
        if($this->priceHistory->last()->date >= Carbon::today()){
            return PriceHistory::wherePlanId($this->id)->whereDate('date', Carbon::today())->first();
        }else{
            return PriceHistory::wherePlanId($this->id)->whereYear('date', '=', date('Y'))->orderBy('date', 'desc')->first();
        }
    }  
    
    public function last()
    {
        return PriceHistory::wherePlanId($this->id)->whereYear('date', '=', date('Y'))->orderBy('date', 'asc')->first();
    }
    
    public function upBy($type)
    {
        if($type == 'today'){
            return currencyFormat(number_format(100 - $this->yesterdayHistory()->amount * 100 / $this->first()->amount, 2));
        }else{
            return currencyFormat(number_format(100 - $this->first()->amount * 100 / $this->yesterdayHistory()->amount, 2));
        }
    } 

    public function YTD($type)
    {
        if($type == 'first'){
            return currencyFormat(number_format(100 - $this->last()->amount * 100 / $this->first()->amount, 2));
        }else{
            return currencyFormat(number_format(100 - $this->first()->amount * 100 / $this->last()->amount, 2));
        }
    } 

    public function fundComposition()
    {
        return $this->hasMany(FundComposition::class, 'plan_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by')->withTrashed();
    } 
    
    public function editedBy()
    {
        return $this->belongsTo(Admin::class, 'edited_by')->withTrashed();
    }
    
    public function updates()
    {
        return $this->hasMany(Planupdate::class, 'plan_id');
    }       
    
    public function followed()
    {
        return $this->hasMany(Followed::class, 'plan_id')->withTrashed();
    }    
    
    public function allUnits()
    {
        return $this->hasMany(Units::class, 'plan_id')->withTrashed();
    }

    public function users()
    {
        return $this->hasMany(Followed::class, 'plan_id');
    }    
    
    public function processedDividends()
    {
        return $this->hasMany(Category::class, 'plan_id')->whereType('dividend');
    }
}
