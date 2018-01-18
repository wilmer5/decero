<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ReportesController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request){

        $site = Auth::user()->id; //Id usuario Autenticado

        if ($request->isMethod('post')){    
            //return $request; 
            if ($request->fecha1 && $request->fecha2){
                
                $first = $request->fecha1;
                $last = $request->fecha2;

            } else {

                $step = '-7 day';
                $format = 'Y-m-d';
                $current1 = strtotime(date('Y-m-d'));
                $current2 = strtotime( $step, $current1 );
                $first = date( $format, $current2 );        
                $last = date( $format, $current1 );                
                
            }

        } else {

            $step = '-7 day';
            $format = 'Y-m-d';
            $current1 = strtotime(date('Y-m-d'));
            $current2 = strtotime( $step, $current1 );
            $first = date( $format, $current2 );        
            $last = date( $format, $current1 );                

        }
        
        $results = DB::select('select count(id) as clicks, COUNT(IF(monto>0,1,NULL)) as altas, date_format(fecha,"%d/%m/%Y") AS fecha, sum(monto) as total FROM clicks where site = :site AND fecha BETWEEN :first AND :last GROUP BY fecha', ['site' => $site, 'first' => $first, 'last' => $last]);

    	return view('reportes/general')->with(array('valores' => $results));
    }


    public function paises(Request $request){

        $site = Auth::user()->id; //Id usuario Autenticado

        if ($request->isMethod('post')){    
            //return $request; 
            if ($request->fecha1 && $request->fecha2){
                
                $first = $request->fecha1;
                $last = $request->fecha2;

            } else {

                $step = '-7 day';
                $format = 'Y-m-d';
                $current1 = strtotime(date('Y-m-d'));
                $current2 = strtotime( $step, $current1 );
                $first = date( $format, $current2 );        
                $last = date( $format, $current1 );                
                
            }

        } else {

            $step = '-7 day';
            $format = 'Y-m-d';
            $current1 = strtotime(date('Y-m-d'));
            $current2 = strtotime( $step, $current1 );
            $first = date( $format, $current2 );        
            $last = date( $format, $current1 );                

        }
        
        $results = DB::select('select IF( pais =  "",  "Otros", pais ) AS pais, count(id) as clicks, 
                        COUNT(IF(monto>0,1,NULL)) as altas, sum(CAST(monto AS DECIMAL(10,8))) as total FROM clicks
            WHERE site = :site AND fecha BETWEEN :first AND :last GROUP BY pais order by clicks desc', ['site' => $site, 'first' => $first, 'last' => $last]);        

    	return view('reportes/paises')->with(array('valores' => $results));
    }    
}
