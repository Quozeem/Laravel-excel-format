<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use DB;
use Carbon\Carbon;

class Dollars extends Model
{
    use HasFactory;
    protected $table = "dollar_rate";
    public $timestamps=false;
    protected $fillable = 
    [
        'dollarrate_rate','dollarrate_date'
             ];
             public static function chart_month()
             {
                $get_chart_month =Dollars::select(DB::raw("COUNT(*) as count"),
                 DB::raw("MONTHNAME(dollarrate_date) as month_name"))
                ->whereYear('dollarrate_date', date('Y'))
                ->groupBy(DB::raw("(month_name)"))
                ->pluck('count', 'month_name');
           return  $get_chart_month ;    
             }
     public function getdollar_rate()
             {
    $date=Carbon::now();
       $dollar_rate = DB::table('dollar_rate')
       ->whereDate('dollarrate_date','=',date('Y-m-d'))
          ->paginate(12);
       if(is_null($dollar_rate))
              {
                  return null;
              }
              return $dollar_rate;
             } 
          
  public static function filter_rate($request)
  {
    if($request->filter == 'date')
    {
$dollar_rate = DB::table('dollar_rate')
->orderby('dollarrate_date','desc')
->get();
return  $dollar_rate;
    }
    else
    if($request->filter == 'High')
    {
        $dollar_rated = DB::table('dollar_rate')
        ->orderby('dollarrate_rate','DESC')
        ->get();
        return $dollar_rated;
    }
    else if($request->filter == 'Low')
    {
        $dollar_rated = DB::table('dollar_rate')
        ->orderby('dollarrate_rate','ASC')
        ->get();
        return $dollar_rated;
    }
  }
                        
}

