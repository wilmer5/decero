<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use App\Registro;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$current = date("Y-m-d"); //fecha de hoy
        $current = '2017-06-25';
        $site = Auth::user()->id; //Id usuario Autenticado

        //$conversiones = DB::table('panel')->where('site', '=', $site)->where('fecha', '=', $current)->count();  
        //$clicks = DB::table('clicks')->where('site', '=', $site)->where('fecha', '=', $current)->count(); 
        //$ganancias = DB::table('panel')->where('site', '=', $site)->where('fecha', '=', $current)->sum('beneficio'); 
        //$ganancias = round($ganancias, 2, PHP_ROUND_HALF_DOWN);
        //return $ganancias;

        $registrospanel = Registro::where('site', $site)->first();

        //$registrospanel = DB::select('select * from registros where site = :site', ['site' => $site]);

        if ($registrospanel){

            $fecha1 = $registrospanel->momento;
            $fecha2 = date("Y-m-d H:i:s");
            $fecha1 = strtotime($fecha1);
            $fecha2 = strtotime($fecha2);
            $minutos = round(($fecha2 - $fecha1) / 60);

            if ($minutos > 15) {
                //return 'Más de 15 minutos de diferencia '.$minutos.' '.$fecha2;
                $valores = $this->consultarvalores($site, $current);
                
                $registrospanel->clicks = $valores["clicks"]; 
                $registrospanel->conversiones = $valores["conversiones"]; 
                $registrospanel->ganancias = $valores["ganancias"]; 
                $registrospanel->gananciashoy = $valores["gananciashoy"];
                $registrospanel->cobrado = $valores["cobrado"];
                $registrospanel->pendiente = $valores["pendiente"];
                $registrospanel->porcobrar = $valores["porcobrar"];
                $registrospanel->momento = date("Y-m-d H:i:s");

                if( $registrospanel->isDirty() ) { $registrospanel->save(); }

            } else{
                
                $clicks       = $registrospanel->clicks; 
                $conversiones = $registrospanel->conversiones; 
                $ganancias    = $registrospanel->ganancias; 
                $gananciashoy = $registrospanel->gananciashoy;
                $cobrado      = $registrospanel->cobrado;
                $pendiente    = $registrospanel->pendiente;
                $porcobrar    = $registrospanel->porcobrar;
                $valores = array('clicks' => $clicks, 'conversiones' => $conversiones, 'ganancias'    => $ganancias, 'cobrado'      => $cobrado, 'pendiente'    => $pendiente, 'porcobrar'    => $porcobrar, 'gananciashoy' => $gananciashoy);                
            }

        } else {

            $valores = $this->consultarvalores($site, $current);
            $data = new Registro;
            $data->clicks = $valores["clicks"]; 
            $data->conversiones = $valores["conversiones"]; 
            $data->ganancias = $valores["ganancias"]; 
            $data->gananciashoy = $valores["gananciashoy"];
            $data->cobrado = $valores["cobrado"];
            $data->pendiente =  $valores["pendiente"];
            $data->porcobrar = $valores["porcobrar"];
            $data->site = $site;
            $data->momento = date("Y-m-d H:i:s");
            $data->save();
            //return "No hay registros";
        }

        //return view('home')->with(array('conversiones' => $conversiones, 'ganancias' => $ganancias));

        return view('home')->with($valores);
        
    }

    function consultarvalores($site, $current){
        $resultshoy = DB::select('select count(id) as conversiones, sum(beneficio) as ganancias from panel where site = :site and fecha = :fecha', ['site' => $site, 'fecha' => $current]);
        $results = DB::select('select sum(beneficio) as ganancias from panel where site = :site', ['site' => $site]);
        $facturasc = DB::select('select sum(monto) as totalc from facturas where idusuario = :site and estado = 1', ['site' => $site]);
        $facturasp = DB::select('select sum(monto) as totalc from facturas where idusuario = :site and estado = 0', ['site' => $site]);

        $conversiones = $resultshoy[0]->conversiones; //Total Coversiones hoy
        $gananciashoy = $resultshoy[0]->ganancias; //Total Ganancias hoy
        $gananciashoy = round($gananciashoy, 2, PHP_ROUND_HALF_DOWN); //Total Ganancias hoy
        

        $object = array_shift($results);
        $ganancias = $object->ganancias;
        $ganancias = round($ganancias, 2, PHP_ROUND_HALF_DOWN); //Total Ganancias
        
        $cobrado = $facturasc[0]->totalc;
        $cobrado = round($cobrado, 2, PHP_ROUND_HALF_DOWN); //Total Cobrado

        $pendiente = $facturasp[0]->totalc;
        $pendiente = round($pendiente, 2, PHP_ROUND_HALF_DOWN); //Total pendiente

        $porcobrar = $ganancias - $cobrado - $pendiente;
        $porcobrar = round($porcobrar, 2, PHP_ROUND_HALF_DOWN); //Total por cobrar

        $clicks = 65431;

        $valores = array('clicks' => $clicks, 'conversiones' => $conversiones, 'ganancias'    => $ganancias, 'cobrado'      => $cobrado, 'pendiente'    => $pendiente, 'porcobrar'    => $porcobrar, 'gananciashoy' => $gananciashoy);

        return $valores;        

    }
}
