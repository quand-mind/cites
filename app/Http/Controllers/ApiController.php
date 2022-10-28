<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function api_cites($arraySpecies)
    {   
        $client = new Client(); //GuzzleHttp\Client
        $url = "https://api.speciesplus.net/api/v1/taxon_concepts?name=". $full_name;
        //return $url;
        $headers= [
            // 'Content-Type' => 'application/json',
            'X-Authentication-Token' => 'uD2JyZT7CvR1Snol3xKrYgtt',
        ];
        if (env('APP_ENV') === 'local') {
            $response = $client->request('GET', $url, [
                'verify'  => false,
                'headers' => $headers,
            ]);
        } else {
            $response = $client->request('GET', $url, [
                'verify'  => true,
                'headers' => $headers,
            ]);
        }


        $species = json_decode($response->getBody()->getContents());

        $especies = $species->taxon_concepts;
    
        $arraySpecies = [];

        foreach ($especies as $especie) {
            if ($especie->rank === "SPECIES" || $especie->rank === "SUBSPECIES" ){
                array_push($arraySpecies, $especie);
            }
        }
        //return $arraySpecies;
        return $species;
        // return view('species', compact('species'));
    }



    public function api_cites_filter(Request $request)
    {
        $filter  = $request->get('filter');
        $client = new Client(); //GuzzleHttp\Client
        $url = "https://speciesplus.net/api/v1/auto_complete_taxon_concepts?taxon_concept_query=".$filter;
        $headers= [
            // 'Content-Type' => 'application/json',
            'X-Authentication-Token' => 'uD2JyZT7CvR1Snol3xKrYgtt',
        ];
        if (env('APP_ENV') === 'local') {
            $response = $client->request('GET', $url, [
                'verify'  => false,
                'headers' => $headers,
            ]);
        } else {
            $response = $client->request('GET', $url, [
                'verify'  => true,
                'headers' => $headers,
            ]);
        }


        $species = json_decode($response->getBody()->getContents());
        $especies = $species->auto_complete_taxon_concepts;

        //return $especies;
    
        $arraySpecies = [];

        foreach ($especies as $especie) {
            if ($especie->rank_name === "SPECIES" || $especie->rank_name === "SUBSPECIES" ){
                array_push($arraySpecies, $especie);
            }

        }
        return $arraySpecies;
        return view('species', compact('arraySpecies'));
        // return $this->api_cites($arraySpecies);
    }

    public function json_country(){
        $countriesList ='[
            { "value": "VE", "label": "Venezuela" },
            { "value": "DO", "label": "Rep\u00FAblica Dominicana" },
            { "value": "SV", "label": "El Salvador" },
            { "value": "HN", "label": "Honduras" },
            { "value": "GT", "label": "Guatemala" },
            { "value": "MX", "label": "M\u00E9xico" },
            { "value": "ES", "label": "Espa\u00F1a" },
            { "value": "US", "label": "Estados Unidos" },
            { "value": "AF", "label": "Afganist\u00E1n" },
            { "value": "AL",  "label": "DE", "label": "Alemania" },
            { "value": "AD", "label": "Andorra" },
            { "value": "AO", "label": "Angola" },
            { "value": "AI", "label": "Anguila" },
            { "value": "AQ", "label": "Ant\u00E1rtida" },
            { "value": "AG", "label": "Antigua y Barbuda" },
            { "value": "SA", "label": "Arabia Saud\u00ED" },
            { "value": "DZ", "label": "Argelia" },
            { "value": "AR", "label": "Argentina" },
            { "value": "AM", "label": "Armenia" },
            { "value": "AW", "label": "Aruba" },
            { "value": "AU", "label": "Australia" },
            { "value": "AT", "label": "Austria" },
            { "value": "AZ", "label": "Azerbaiy\u00E1n" },
            { "value": "BS", "label": "Bahamas" },
            { "value": "BD", "label": "Banglad\u00E9s" },
            { "value": "BB", "label": "Barbados" },
            { "value": "BH", "label": "Bar\u00E9in" },
            { "value": "BE", "label": "B\u00E9lgica" },
            { "value": "BZ", "label": "Belice" },
            { "value": "BJ", "label": "Ben\u00EDn" },
            { "value": "BM", "label": "Bermudas" },
            { "value": "BY", "label": "Bielorrusia" },
            { "value": "BO", "label": "Bolivia" },
            { "value": "BA", "label": "Bosnia y Herzegovina" },
            { "value": "BW", "label": "Botsuana" },
            { "value": "BR", "label": "Brasil" },
            { "value": "BN", "label": "Brun\u00E9i" },
            { "value": "BG", "label": "Bulgaria" },
            { "value": "BF", "label": "Burkina Faso" },
            { "value": "BI", "label": "Burundi" },
            { "value": "BT", "label": "But\u00E1n" },
            { "value": "CV", "label": "Cabo Verde" },
            { "value": "KH", "label": "Camboya" },
            { "value": "CM", "label": "Camer\u00FAn" },
            { "value": "CA", "label": "Canad\u00E1" },
            { "value": "IC", "label": "Canarias" },
            { "value": "BQ", "label": "Caribe neerland\u00E9s" },
            { "value": "QA", "label": "Catar" },
            { "value": "EA", "label": "Ceuta y Melilla" },
            { "value": "TD", "label": "Chad" },
            { "value": "CZ", "label": "Chequia" },
            { "value": "CL", "label": "Chile" },
            { "value": "CN", "label": "China" },
            { "value": "CY", "label": "Chipre" },
            { "value": "VA", "label": "Ciudad del Vaticano" },
            { "value": "CO", "label": "Colombia" },
            { "value": "KM", "label": "Comoras" },
            { "value": "CG", "label": "Congo" },
            { "value": "KP", "label": "Corea del Norte" },
            { "value": "KR", "label": "Corea del Sur" },
            { "value": "CR", "label": "Costa Rica" },
            { "value": "CI", "label": "C\u00F4te d\u2019Ivoire" },
            { "value": "HR", "label": "Croacia" },
            { "value": "CU", "label": "Cuba" },
            { "value": "CW", "label": "Curazao" },
            { "value": "DG", "label": "Diego Garc\u00EDa" },
            { "value": "DK", "label": "Dinamarca" },
            { "value": "DM", "label": "Dominica" },
            { "value": "EC", "label": "Ecuador" },
            { "value": "EG", "label": "Egipto" },
            { "value": "AE", "label": "Emiratos \u00C1rabes Unidos" },
            { "value": "ER", "label": "Eritrea" },
            { "value": "SK", "label": "Eslovaquia" },
            { "value": "SI", "label": "Eslovenia" },
            { "value": "EE", "label": "Estonia" },
            { "value": "SZ", "label": "Esuatini" },
            { "value": "ET", "label": "Etiop\u00EDa" },
            { "value": "PH", "label": "Filipinas" },
            { "value": "FI", "label": "Finlandia" },
            { "value": "FJ", "label": "Fiyi" },
            { "value": "FR", "label": "Francia" },
            { "value": "GA", "label": "Gab\u00F3n" },
            { "value": "GM", "label": "Gambia" },
            { "value": "GE", "label": "Georgia" },
            { "value": "GH", "label": "Ghana" },
            { "value": "GI", "label": "Gibraltar" },
            { "value": "GD", "label": "Granada" },
            { "value": "GR", "label": "Grecia" },
            { "value": "GL", "label": "Groenlandia" },
            { "value": "GP", "label": "Guadalupe" },
            { "value": "GU", "label": "Guam" },
            { "value": "GF", "label": "Guayana Francesa" },
            { "value": "GG", "label": "Guernsey" },
            { "value": "GN", "label": "Guinea" },
            { "value": "GQ", "label": "Guinea Ecuatorial" },
            { "value": "GW", "label": "Guinea-Bis\u00E1u" },
            { "value": "GY", "label": "Guyana" },
            { "value": "HT", "label": "Hait\u00ED" },
            { "value": "HU", "label": "Hungr\u00EDa" },
            { "value": "IN", "label": "India" },
            { "value": "ID", "label": "Indonesia" },
            { "value": "IQ", "label": "Irak" },
            { "value": "IR", "label": "Ir\u00E1n" },
            { "value": "IE", "label": "Irlanda" },
            { "value": "AC", "label": "Isla de la Ascensi\u00F3n" },
            { "value": "IM", "label": "Isla de Man" },
            { "value": "CX", "label": "Isla de Navidad" },
            { "value": "NF", "label": "Isla Norfolk" },
            { "value": "IS", "label": "Islandia" },
            { "value": "AX", "label": "Islas \u00C5land" },
            { "value": "KY", "label": "Islas Caim\u00E1n" },
            { "value": "CC", "label": "Islas Cocos" },
            { "value": "CK", "label": "Islas Cook" },
            { "value": "FO", "label": "Islas Feroe" },
            { "value": "GS", "label": "Islas Georgia del Sur y Sandwich del Sur" },
            { "value": "FK", "label": "Islas Malvinas" },
            { "value": "MP", "label": "Islas Marianas del Norte" },
            { "value": "MH", "label": "Islas Marshall" },
            { "value": "UM", "label": "Islas menores alejadas de EE. UU." },
            { "value": "PN", "label": "Islas Pitcairn" },
            { "value": "SB", "label": "Islas Salom\u00F3n" },
            { "value": "TC", "label": "Islas Turcas y Caicos" },
            { "value": "VG", "label": "Islas V\u00EDrgenes Brit\u00E1nicas" },
            { "value": "VI", "label": "Islas V\u00EDrgenes de EE. UU." },
            { "value": "IL", "label": "Israel" },
            { "value": "IT", "label": "Italia" },
            { "value": "JM", "label": "Jamaica" },
            { "value": "JP", "label": "Jap\u00F3n" },
            { "value": "JE", "label": "Jersey" },
            { "value": "JO", "label": "Jordania" },
            { "value": "KZ", "label": "Kazajist\u00E1n" },
            { "value": "KE", "label": "Kenia" },
            { "value": "KG", "label": "Kirguist\u00E1n" },
            { "value": "KI", "label": "Kiribati" },
            { "value": "XK", "label": "Kosovo" },
            { "value": "KW", "label": "Kuwait" },
            { "value": "LA", "label": "Laos" },
            { "value": "LS", "label": "Lesoto" },
            { "value": "LV", "label": "Letonia" },
            { "value": "LB", "label": "L\u00EDbano" },
            { "value": "LR", "label": "Liberia" },
            { "value": "LY", "label": "Libia" },
            { "value": "LI", "label": "Liechtenstein" },
            { "value": "LT", "label": "Lituania" },
            { "value": "LU", "label": "Luxemburgo" },
            { "value": "MK", "label": "Macedonia" },
            { "value": "MG", "label": "Madagascar" },
            { "value": "MY", "label": "Malasia" },
            { "value": "MW", "label": "Malaui" },
            { "value": "MV", "label": "Maldivas" },
            { "value": "ML", "label": "Mali" },
            { "value": "MT", "label": "Malta" },
            { "value": "MA", "label": "Marruecos" },
            { "value": "MQ", "label": "Martinica" },
            { "value": "MU", "label": "Mauricio" },
            { "value": "MR", "label": "Mauritania" },
            { "value": "YT", "label": "Mayotte" },
            { "value": "FM", "label": "Micronesia" },
            { "value": "MD", "label": "Moldavia" },
            { "value": "MC", "label": "M\u00F3naco" },
            { "value": "MN", "label": "Mongolia" },
            { "value": "ME", "label": "Montenegro" },
            { "value": "MS", "label": "Montserrat" },
            { "value": "MZ", "label": "Mozambique" },
            { "value": "MM", "label": "Myanmar (Birmania)" },
            { "value": "NA", "label": "Namibia" },
            { "value": "NR", "label": "Nauru" },
            { "value": "NP", "label": "Nepal" },
            { "value": "NI", "label": "Nicaragua" },
            { "value": "NE", "label": "N\u00EDger" },
            { "value": "NG", "label": "Nigeria" },
            { "value": "NU", "label": "Niue" },
            { "value": "NO", "label": "Noruega" },
            { "value": "NC", "label": "Nueva Caledonia" },
            { "value": "NZ", "label": "Nueva Zelanda" },
            { "value": "OM", "label": "Om\u00E1n" },
            { "value": "NL", "label": "Pa\u00EDses Bajos" },
            { "value": "PK", "label": "Pakist\u00E1n" },
            { "value": "PW", "label": "Palaos" },
            { "value": "PA", "label": "Panam\u00E1" },
            { "value": "PG", "label": "Pap\u00FAa Nueva Guinea" },
            { "value": "PY", "label": "Paraguay" },
            { "value": "PE", "label": "Per\u00FA" },
            { "value": "PF", "label": "Polinesia Francesa" },
            { "value": "PL", "label": "Polonia" },
            { "value": "PT", "label": "Portugal" },
            { "value": "XA", "label": "Pseudo-Accents" },
            { "value": "XB", "label": "Pseudo-Bidi" },
            { "value": "PR", "label": "Puerto Rico" },
            { "value": "HK", "label": "RAE de Hong Kong (China)" },
            { "value": "MO", "label": "RAE de Macao (China)" },
            { "value": "GB", "label": "Reino Unido" },
            { "value": "CF", "label": "Rep\u00FAblica Centroafricana" },
            { "value": "CD", "label": "Rep\u00FAblica Democr\u00E1tica del Congo" },
            { "value": "RE", "label": "Reuni\u00F3n" },
            { "value": "RW", "label": "Ruanda" },
            { "value": "RO", "label": "Ruman\u00EDa" },
            { "value": "RU", "label": "Rusia" },
            { "value": "EH", "label": "S\u00E1hara Occidental" },
            { "value": "WS", "label": "Samoa" },
            { "value": "AS", "label": "Samoa Americana" },
            { "value": "BL", "label": "San Bartolom\u00E9" },
            { "value": "KN", "label": "San Crist\u00F3bal y Nieves" },
            { "value": "SM", "label": "San Marino" },
            { "value": "MF", "label": "San Mart\u00EDn" },
            { "value": "PM", "label": "San Pedro y Miquel\u00F3n" },
            { "value": "VC", "label": "San Vicente y las Granadinas" },
            { "value": "SH", "label": "Santa Elena" },
            { "value": "LC", "label": "Santa Luc\u00EDa" },
            { "value": "ST", "label": "Santo Tom\u00E9 y Pr\u00EDncipe" },
            { "value": "SN", "label": "Senegal" },
            { "value": "RS", "label": "Serbia" },
            { "value": "SC", "label": "Seychelles" },
            { "value": "SL", "label": "Sierra Leona" },
            { "value": "SG", "label": "Singapur" },
            { "value": "SX", "label": "Sint Maarten" },
            { "value": "SY", "label": "Siria" },
            { "value": "SO", "label": "Somalia" },
            { "value": "LK", "label": "Sri Lanka" },
            { "value": "ZA", "label": "Sud\u00E1frica" },
            { "value": "SD", "label": "Sud\u00E1n" },
            { "value": "SS", "label": "Sud\u00E1n del Sur" },
            { "value": "SE", "label": "Suecia" },
            { "value": "CH", "label": "Suiza" },
            { "value": "SR", "label": "Surinam" },
            { "value": "SJ", "label": "Svalbard y Jan Mayen" },
            { "value": "TH", "label": "Tailandia" },
            { "value": "TW", "label": "Taiw\u00E1n" },
            { "value": "TZ", "label": "Tanzania" },
            { "value": "TJ", "label": "Tayikist\u00E1n" },
            { "value": "IO", "label": "Territorio Brit\u00E1nico del Oc\u00E9ano \u00CDndico"},
            { "value": "TF", "label": "Territorios Australes Franceses" },
            { "value": "PS", "label": "Territorios Palestinos" },
            { "value": "TL", "label": "Timor-Leste" },
            { "value": "TG", "label": "Togo" },
            { "value": "TK", "label": "Tokelau" },
            { "value": "TO", "label": "Tonga" },
            { "value": "TT", "label": "Trinidad y Tobago" },
            { "value": "TA", "label": "Trist\u00E1n de Acu\u00F1a" },
            { "value": "TN", "label": "T\u00FAnez" },
            { "value": "TM", "label": "Turkmenist\u00E1n" },
            { "value": "TR", "label": "Turqu\u00EDa" },
            { "value": "TV", "label": "Tuvalu" },
            { "value": "UA", "label": "Ucrania" },
            { "value": "UG", "label": "Uganda" },
            { "value": "UY", "label": "Uruguay" },
            { "value": "UZ", "label": "Uzbekist\u00E1n" },
            { "value": "VU", "label": "Vanuatu" },
            { "value": "VN", "label": "Vietnam" },
            { "value": "WF", "label": "Wallis y Futuna" },
            { "value": "YE", "label": "Yemen" },
            { "value": "DJ", "label": "Yibuti" },
            { "value": "ZM", "label": "Zambia" },
            { "value": "ZW", "label": "Zimbabue" }  
        ]';
        return json_decode($countriesList);
    }

    public function sendTokenApiExternal(){
        
        $credentials = ["jasve504@gmail.com"];
        if ($token = $this->attempt($credentials)) {
            return $token;
        }
    }
    public function guard()
    {
        return Auth::guard('api');
    }
}

