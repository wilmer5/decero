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

                $fechas = $this->getfechas();
                $first = $fechas[0];
                $last = $fechas[1];                
                
            }
 
        } else {

            $fechas = $this->getfechas();
            $first = $fechas[0];
            $last = $fechas[1];               

        }
        
        $results = DB::select('select count(id) as clicks, COUNT(IF(monto>0,1,NULL)) as altas, date_format(fecha,"%d/%m/%Y") AS fecha, sum(monto) as total FROM clicks where site = :site AND fecha BETWEEN :first AND :last GROUP BY fecha', ['site' => $site, 'first' => $first, 'last' => $last]);

    	return view('reportes/general')->with(array('valores' => $results, 'first' => $first, 'last' => $last));
    }

    ////// Reporte por paises
    public function paises(Request $request){

        $site = Auth::user()->id; //Id usuario Autenticado

        if ($request->isMethod('post')){    
            //return $request; 
            if ($request->fecha1 && $request->fecha2){
                
                $first = $request->fecha1;
                $last = $request->fecha2;

            } else {

                $fechas = $this->getfechas();
                $first = $fechas[0];
                $last = $fechas[1];
                
            }

        } else {

            $fechas = $this->getfechas();
            $first = $fechas[0];
            $last = $fechas[1];

        }
        
        $results = DB::select('select IF( pais =  "",  "Otros", pais ) AS pais, count(id) as clicks, 
                        COUNT(IF(monto>0,1,NULL)) as altas, sum(CAST(monto AS DECIMAL(10,8))) as total FROM clicks
            WHERE site = :site AND fecha BETWEEN :first AND :last GROUP BY pais order by clicks desc', ['site' => $site, 'first' => $first, 'last' => $last]);        

    	return view('reportes/paises')->with(array('valores' => $results, 'first' => $first, 'last' => $last));
    }    

    //Reporte por sistema operativo
    public function sistema(Request $request){

        $site = Auth::user()->id; //Id usuario Autenticado

        if ($request->isMethod('post')){    
            //return $request; 
            if ($request->fecha1 && $request->fecha2){
                
                $first = $request->fecha1;
                $last = $request->fecha2;

            } else {

                $fechas = $this->getfechas();
                $first = $fechas[0];
                $last = $fechas[1];
                
            }

        } else {

            $fechas = $this->getfechas();
            $first = $fechas[0];
            $last = $fechas[1];

        }
        
        $results = DB::select('select IF( so =  "",  "Otros", so ) AS so, count(id) as clicks, 
                        COUNT(IF(monto>0,1,NULL)) as altas, sum(CAST(monto AS DECIMAL(10,8))) as total FROM clicks
            WHERE site = :site AND fecha BETWEEN :first AND :last GROUP BY so order by clicks desc', ['site' => $site, 'first' => $first, 'last' => $last]);        

        return view('reportes/sistema')->with(array('valores' => $results, 'first' => $first, 'last' => $last));
    }    

    //Reporte por navegador
    public function navegador(Request $request){

        $site = Auth::user()->id; //Id usuario Autenticado

        if ($request->isMethod('post')){    
            //return $request; 
            if ($request->fecha1 && $request->fecha2){
                
                $first = $request->fecha1;
                $last = $request->fecha2;

            } else {

                $fechas = $this->getfechas();
                $first = $fechas[0];
                $last = $fechas[1];
                
            }

        } else {

            $fechas = $this->getfechas();
            $first = $fechas[0];
            $last = $fechas[1];

        }
        
        $results = DB::select('select IF( navegador =  "",  "Otros", navegador ) AS navegador, count(id) as clicks, 
                        COUNT(IF(monto>0,1,NULL)) as altas, sum(CAST(monto AS DECIMAL(10,8))) as total FROM clicks
            WHERE site = :site AND fecha BETWEEN :first AND :last GROUP BY navegador order by clicks desc', ['site' => $site, 'first' => $first, 'last' => $last]);        

        return view('reportes/navegador')->with(array('valores' => $results, 'first' => $first, 'last' => $last));
    }

    //Reporte por dispositivo
    public function dispositivo(Request $request){

        $site = Auth::user()->id; //Id usuario Autenticado

        if ($request->isMethod('post')){    
            //return $request; 
            if ($request->fecha1 && $request->fecha2){
                
                $first = $request->fecha1;
                $last = $request->fecha2;

            } else {

                $fechas = $this->getfechas();
                $first = $fechas[0];
                $last = $fechas[1];
                
            }

        } else {

            $fechas = $this->getfechas();
            $first = $fechas[0];
            $last = $fechas[1];

        }
        
        $results = DB::select('select IF( tipod =  "1",  "Movil", "PC" ) AS dispositivo, count(id) as clicks, 
                        COUNT(IF(monto>0,1,NULL)) as altas, sum(CAST(monto AS DECIMAL(10,8))) as total FROM clicks
            WHERE site = :site AND fecha BETWEEN :first AND :last GROUP BY dispositivo order by clicks desc', ['site' => $site, 'first' => $first, 'last' => $last]);        

        return view('reportes/dispositivo')->with(array('valores' => $results, 'first' => $first, 'last' => $last));
    }    

    //Reporte por contenido
    public function contenido(Request $request){

        $site = Auth::user()->id; //Id usuario Autenticado

        if ($request->isMethod('post')){    
            //return $request; 
            if ($request->fecha1 && $request->fecha2){
                
                $first = $request->fecha1;
                $last = $request->fecha2;

            } else {

                $fechas = $this->getfechas();
                $first = $fechas[0];
                $last = $fechas[1];
                
            }

        } else {

            $fechas = $this->getfechas();
            $first = $fechas[0];
            $last = $fechas[1];

        }
        
        $results = DB::select('select IF( contenido =  "1",  "Ocio", "Adulto" ) AS contenido, count(id) as clicks, 
                        COUNT(IF(monto>0,1,NULL)) as altas, sum(CAST(monto AS DECIMAL(10,8))) as total FROM clicks
            WHERE site = :site AND fecha BETWEEN :first AND :last GROUP BY contenido order by clicks desc', ['site' => $site, 'first' => $first, 'last' => $last]);        

        return view('reportes/contenido')->with(array('valores' => $results, 'first' => $first, 'last' => $last));
    }    

    public function referidos(Request $request){

        $site = Auth::user()->id; //Id usuario Autenticado

        if ($request->isMethod('post')){    
            //return $request; 
            if ($request->fecha1 && $request->fecha2){
                
                $first = $request->fecha1;
                $last = $request->fecha2;

            } else {

                $fechas = $this->getfechas();
                $first = $fechas[0];
                $last = $fechas[1];
                
            }

        } else {

            $fechas = $this->getfechas();
            $first = $fechas[0];
            $last = $fechas[1];

        }
        
        // $results = DB::select('select users.name, sum(beneficio) as total from panel, users where panel.referido = users.id  and 
        // panel.site = :site and panel.fecha BETWEEN :first and :last GROUP by panel.referido ORDER by total asc', ['site' => $site, 'first' => $first, 'last' => $last]);        

        // $results= DB::select(DB::raw('select u.name, sum(p.beneficio) as total from panel p, users u where p.referido = u.id  and 
        //  p.site = :site and p.fecha BETWEEN :first and :last GROUP by p.referido ORDER by total asc', ['site' => $site, 'first' => $first, 'last' => $last]));        

        $results = DB::table('panel')
                    ->join('users','users.id', '=', 'panel.referido')
                    ->select('users.name', DB::raw('sum(panel.beneficio) as total'))
                    ->where('panel.site', '=', $site)
                    ->whereBetween('panel.fecha', array($first, $last))
                    ->groupBy('name')
                    ->orderBy('total', 'desc')
                    ->get();

        //return $events;
        //dd($results);
        return view('reportes/referidos')->with(array('valores' => $results, 'first' => $first, 'last' => $last));
        //return view('reportes/referidos')->with('valores',$results);
      
    }        

    function getfechas(){

        $step = '-7 day';
        $format = 'Y-m-d';
        $current1 = strtotime(date('Y-m-d'));
        $current2 = strtotime( $step, $current1 );
        $first = date( $format, $current2 );        
        $last = date( $format, $current1 );   
        return array($first,$last);        

    }

}
