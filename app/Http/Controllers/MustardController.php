<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE DB;
use App\Imports\DollarrateImport;
use Illuminate\Pagination\Paginator;
use App\Models\Dollars;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class MustardController extends Controller
{
    public function getdollar_rate()
    {  
        
 $get_chart_month =Dollars::chart_month();
           $labels = $get_chart_month->keys();
    $data = $get_chart_month->values();
        $get_dollar_rate =new Dollars();
        $dollar_rate=$get_dollar_rate ->getdollar_rate();
        return view ('welcome',
         compact('labels', 'data','dollar_rate')
 );
    }
   public function importdollar(){
        Excel::import(new DollarrateImport, request()->file('file'));
        return redirect()->back()->with('success', 'Dollar Rate has been imported successfully');
    }

    public function get_filter_rate(Request $request)
    {
       $get_dollar_rate=Dollars::filter_rate($request);
     return response()->json(  $get_dollar_rate);
    }








}
