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
        $current = date("Y-m-d"); //fecha de hoy
        //$current = '2017-06-25';
        $site = Auth::user()->id; //Id usuario Autenticado
        
        $valores = $this->consultarvalores($site, $current);
        $datosgrafica = $this->listagrafica($site, $current);

        return view('home')->with(array('valores' => $valores, 'datosgrafica' => $datosgrafica));
        
    }

    public function logout(Request $request) {
      Auth::logout();
      return redirect('/login');
    }    

    function consultarvalores($site, $current){
        //$resultshoy = DB::select('select count(id) as conversiones, sum(beneficio) as ganancias from panel where site = :site and fecha = :fecha', ['site' => $site, 'fecha' => $current]);
        $results = DB::select('select sum(beneficio) as ganancias from panel where site = :site', ['site' => $site]);
        $facturasc = DB::select('select sum(monto) as totalc from facturas where idusuario = :site and estado = 1', ['site' => $site]);
        $facturasp = DB::select('select sum(monto) as totalc from facturas where idusuario = :site and estado = 0', ['site' => $site]);

        //$conversiones = $resultshoy[0]->conversiones; //Total Coversiones hoy
        //$gananciashoy = $resultshoy[0]->ganancias; //Total Ganancias hoy
        //$gananciashoy = round($gananciashoy, 2, PHP_ROUND_HALF_DOWN); //Total Ganancias hoy
        
        $object = array_shift($results);
        $ganancias = $object->ganancias;
        $cobrado = $facturasc[0]->totalc;
        $pendiente = $facturasp[0]->totalc;
        $porcobrar = $ganancias - $cobrado - $pendiente;

        $ganancias = round($ganancias, 2, PHP_ROUND_HALF_DOWN); //Total Ganancias
        $cobrado = round($cobrado, 2, PHP_ROUND_HALF_DOWN); //Total Cobrado
        $pendiente = round($pendiente, 2, PHP_ROUND_HALF_DOWN); //Total pendiente
        $porcobrar = round($porcobrar, 2, PHP_ROUND_HALF_DOWN); //Total por cobrar

        $clicks = 65431;

        $valores = array('clicks' => $clicks, 'ganancias' => $ganancias, 'cobrado' => $cobrado, 'pendiente' => $pendiente, 'porcobrar' => $porcobrar);
        
        //$valores = array('clicks' => $clicks, 'conversiones' => $conversiones, 'ganancias'    => $ganancias, 'cobrado'      => $cobrado, 'pendiente'    => $pendiente, 'porcobrar'    => $porcobrar, 'gananciashoy' => $gananciashoy);

        return $valores;        

    }

    function listagrafica($site, $current){
        $step = '-7 day';
        $format = 'Y-m-d';
        $current1 = strtotime($current);
        $current2 = strtotime( $step, $current1 );
        $first = date( $format, $current2 );        
        $last = date( $format, $current1 );
        $datosgrafica = DB::select('select count(id) as registros, fecha, SUM(beneficio) as total from panel where site = :site and fecha >= :fecha1 and fecha <= :fecha2  GROUP BY fecha', ['site' => $site, 'fecha1' => $first, 'fecha2' => $last]);   

        return $datosgrafica;     
    }
}
