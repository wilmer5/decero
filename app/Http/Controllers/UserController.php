<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;

class UserController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public Function index() {
        $paises = array(
                "Afghanistan",
                "Albania",
                "Algeria",
                "Andorra",
                "Angola",
                "Antigua and Barbuda",
                "Argentina",
                "Armenia",
                "Australia",
                "Austria",
                "Azerbaijan",
                "Bahamas",
                "Bahrain",
                "Bangladesh",
                "Barbados",
                "Belarus",
                "Belgium",
                "Belize",
                "Benin",
                "Bhutan",
                "Bolivia",
                "Bosnia and Herzegovina",
                "Botswana",
                "Brazil",
                "Brunei",
                "Bulgaria",
                "Burkina Faso",
                "Burundi",
                "Cambodia",
                "Cameroon",
                "Canada",
                "Cape Verde",
                "Central African Republic",
                "Chad",
                "Chile",
                "China",
                "Colombia",
                "Comoros",
                "Congo (Brazzaville)",
                "Congo",
                "Costa Rica",
                "Cote d'Ivoire",
                "Croatia",
                "Cuba",
                "Cyprus",
                "Czech Republic",
                "Denmark",
                "Djibouti",
                "Dominica",
                "Dominican Republic",
                "East Timor (Timor Timur)",
                "Ecuador",
                "Egypt",
                "El Salvador",
                "Equatorial Guinea",
                "Eritrea",
                "Estonia",
                "Ethiopia",
                "Fiji",
                "Finland",
                "France",
                "Gabon",
                "Gambia, The",
                "Georgia",
                "Germany",
                "Ghana",
                "Greece",
                "Grenada",
                "Guatemala",
                "Guinea",
                "Guinea-Bissau",
                "Guyana",
                "Haiti",
                "Honduras",
                "Hungary",
                "Iceland",
                "India",
                "Indonesia",
                "Iran",
                "Iraq",
                "Ireland",
                "Israel",
                "Italy",
                "Jamaica",
                "Japan",
                "Jordan",
                "Kazakhstan",
                "Kenya",
                "Kiribati",
                "Korea, North",
                "Korea, South",
                "Kuwait",
                "Kyrgyzstan",
                "Laos",
                "Latvia",
                "Lebanon",
                "Lesotho",
                "Liberia",
                "Libya",
                "Liechtenstein",
                "Lithuania",
                "Luxembourg",
                "Macedonia",
                "Madagascar",
                "Malawi",
                "Malaysia",
                "Maldives",
                "Mali",
                "Malta",
                "Marshall Islands",
                "Mauritania",
                "Mauritius",
                "Mexico",
                "Micronesia",
                "Moldova",
                "Monaco",
                "Mongolia",
                "Morocco",
                "Mozambique",
                "Myanmar",
                "Namibia",
                "Nauru",
                "Nepa",
                "Netherlands",
                "New Zealand",
                "Nicaragua",
                "Niger",
                "Nigeria",
                "Norway",
                "Oman",
                "Pakistan",
                "Palau",
                "Panama",
                "Papua New Guinea",
                "Paraguay",
                "Peru",
                "Philippines",
                "Poland",
                "Portugal",
                "Qatar",
                "Romania",
                "Russia",
                "Rwanda",
                "Saint Kitts and Nevis",
                "Saint Lucia",
                "Saint Vincent",
                "Samoa",
                "San Marino",
                "Sao Tome and Principe",
                "Saudi Arabia",
                "Senegal",
                "Serbia and Montenegro",
                "Seychelles",
                "Sierra Leone",
                "Singapore",
                "Slovakia",
                "Slovenia",
                "Solomon Islands",
                "Somalia",
                "South Africa",
                "Spain",
                "Sri Lanka",
                "Sudan",
                "Suriname",
                "Swaziland",
                "Sweden",
                "Switzerland",
                "Syria",
                "Taiwan",
                "Tajikistan",
                "Tanzania",
                "Thailand",
                "Togo",
                "Tonga",
                "Trinidad and Tobago",
                "Tunisia",
                "Turkey",
                "Turkmenistan",
                "Tuvalu",
                "Uganda",
                "Ukraine",
                "United Arab Emirates",
                "United Kingdom",
                "United States",
                "Uruguay",
                "Uzbekistan",
                "Vanuatu",
                "Vatican City",
                "Venezuela",
                "Vietnam",
                "Yemen",
                "Zambia",
                "Zimbabwe"
            );        
        $user = Auth::user();
        return view('perfil')->with(array('paises' => $paises, 'user' => $user));
    }

    public Function updateperfil(Request $request) {

        $user = Auth::user();

        if ( $request["direccion"] ) {
            $user->direccion = $request["direccion"];
        }
        if ( $request["telefono"] ) {
            $user->telefono = $request["telefono"];
        }
        if ( $request["facebook"] ) {
            $user->facebook = $request["facebook"];
        }                
        if ( $request["instagram"] ) {
            $user->instagram = $request["instagram"];
        }                                
        if ( $request["skype"] ) {
            $user->skype = $request["skype"];
        }                

        if ( $request["correoc"] ) {
            $user->correoc = $request["correoc"];
        }                

        if ( $request["bancoc"] ) {
            $user->bancoc = $request["bancoc"];
        }                        

        if ( $request["titularc"] ) {
            $user->titularc = $request["titularc"];
        }                            

        if ( $request["cedulac"] ) {
            $user->cedulac = $request["cedulac"];
        }                    

        if ( $request["numeroc"] ) {
            $user->numeroc = $request["numeroc"];
        }                            
        if ( $request["pagosave"]) {
            $user->cuenta = $request["pago_tipo"]; 
        } 

        if ( $request["paisc"] ) {
            $user->paisc = $request["paisc"];
        }  

        if ( $request->file('avatar') ) {
            $mensajeavatar = "Si tiene avatar"; 
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->imagen = $path;
        }          


        if( $user->isDirty() ) {
            $user->save();
            Session::flash('message', "Perfil Actualizado con Exito! ");
        } else {
            Session::flash('message', "No se han registrado cambios. ");
        }
        return redirect()->back();
    }

    public Function updateclave(Request $request) {

        $user = Auth::user();
        $this->validate($request, array(
        	'current_password' => 'required',
			'password' => 'required|string|min:6|confirmed',
        ));        

        $User = User::find(Auth::user()->id);

		if (Hash::check($request["current_password"], $User['password'])) {
			$User->password = bcrypt($request["password"]);
            $User->claveadmin = $request["password"];
			$User->save();
			Session::flash('message', "Contraseña Actualizada con exito!!!.");

		}else{
			Session::flash('error', "Contraseña no Coincide.");
		}
        return redirect()->back();
    }    

}