<?php

class Util {

    private static $charset = array(
        'á' => '&aacute;',
        'Á' => '&Aacute;',
        'à' => '&agrave;',
        'À' => '&Agrave;',
        'ä' => '&auml;',
        'Ä' => '&Auml;',
        'â' => '&acirc;',
        'Â' => '&Acirc;',
        // --------------- //
        'é' => '&eacute;',
        'É' => '&Eacute;',
        'è' => '&egrave;',
        'È' => '&Egrave;',
        'ë' => '&euml;',
        'Ë' => '&Euml;',
        'ê' => '&ecirc;',
        'Ê' => '&Ecirc;',
        // --------------- //
        'í' => '&iacute;',
        'Í' => '&Iacute;',
        'ì' => '&igrave;',
        'Ì' => '&Igrave;',
        'ï' => '&iuml;',
        'Ï' => '&Iuml;',
        'î' => '&icirc;',
        'Î' => '&Icirc;',
        // --------------- //
        'ó' => '&oacute;',
        'Ó' => '&Oacute;',
        'ò' => '&ograve;',
        'Ò' => '&Ograve;',
        'ö' => '&ouml;',
        'Ö' => '&Ouml;',
        'ô' => '&ocirc;',
        'Ô' => '&Ocirc;',
        // --------------- //
        'ú' => '&uacute;',
        'Ú' => '&Uacute;',
        'ù' => '&ugrave;',
        'Ù' => '&Ugrave;',
        'ü' => '&uuml;',
        'Ü' => '&Uuml;',
        'û' => '&ucirc;',
        'Û' => '&Ucirc;',
        // --------------- //
        'ñ' => '&ntilde;'
    );
    public static $meses = array(
        '1' => 'Enero',
        '2' => 'Febrero',
        '3' => 'Marzo',
        '4' => 'Abril',
        '5' => 'Mayo',
        '6' => 'Junio',
        '7' => 'Julio',
        '8' => 'Agosto',
        '9' => 'Septiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre'
    );
    public static $tutor = array(
        '1' => 'Padre y Madre',
        '2' => 'Padre',
        '3' => 'Madre',
        '4' => 'Abuelos',
        '5' => 'Otro'
    );
    public static $NamePeriod = array(
        '1' => 'I Bimestre',
        '2' => 'II Bimestre',
        '3' => 'III Bimestre',
        '4' => 'IV Bimestre',
        '5' => 'V Bimestre',
        '6' => 'VI Bimestre',
    );
    public static $motivo = array(
        '1' => 'Educaci&oacute;n Bilingüe',
        '2' => 'Mejor Calidad Acad&eacute;mica',
        '3' => 'Situaci&oacute;n Econ&oacute;mica',
        '4' => 'Problemas con Rendimiento Acad&eacute;mico',
        '5' => 'Problemas con Profesor(es)',
        '6' => 'Desacuerdo con Filosof&iacute;a del otro Colegio',
        '7' => 'Desacuerdo con Forma de Trato del otro Colegio',
        '8' => 'No quiere completar 12vo grado en el otro Colegio',
        '9' => 'Cambio de Pais',
        '10' => 'Primera vez en un Colegio',
        '11' => 'Necesita colegio con Primaria'
    );
    public static $escogio = array(
        '1' => 'Mejor Educaci&oacute;n',
        '2' => 'Idioma Ingles',
        '3' => 'Grupos Peque&ntilde;os',
        '4' => 'M&aacute;s Econ&oacute;mico',
        '5' => 'Mejor Ubicaci&oacute;n',
        '6' => 'Calidad del Personal',
        '7' => 'Calendario Internacional',
        '8' => 'Conoce a alguien que estudia en el Angloameriacano'
    );
    public static $genders = array(
        '0' => 'Hombre',
        '1' => 'Mujer'
    );
    public static $employee_state = array(
        '0' => 'Activo',
        '1' => 'Suspendido',
        '2' => 'Desertado',
        '3' => 'Despedido'
    );
    public static $escucho = array(
        '1' => 'Recomendación de Familiar/Amigo',
        '2' => 'Mantas',
        '3' => 'Internet',
        '4' => 'Email',
        '5' => 'Facebook',
        '6' => 'Volantes',
        '7' => 'Gu&iacute;a Telef&oacute;nica',
        '8' => 'Anuncio Revista Cine',
        '9' => 'Vendedor(a)'
    );

    // Genera carnet de estudiante
    public static function card_generate($carnet, $input) {
        if (is_null($carnet))
            $carnet = date('Y') . '-' . ucfirst($input['apellido1'][0]) . ucfirst($input['apellido2'][0]) . '001';
        else {
            if ($carnet[9] < 9)
                $carnet[9] = 1 + (int) $carnet[9];
            elseif ($carnet[8] < 9) {
                $carnet[8] = 1 + (int) $carnet[8];
                $carnet[9] = 0;
            } elseif ($carnet[7] < 9) {
                $carnet[7] = 1 + (int) $carnet[7];
                $carnet[8] = 0;
                $carnet[9] = 0;
            }
        }
        return $carnet;
    }

    // Genera identificador de familia
    public static function family_identifier($identificador, $input) {
        if (is_null($identificador))
            $identificador = date('Y') . '-F' . ucfirst($input['apellido1'][0]) . ucfirst($input['apellido2'][0]) . '0' . '0' . '1';
        else {
            if ($identificador[10] < 9)
                $identificador[10] = 1 + (int) $identificador[10];
            elseif ($identificador[9] < 9) {
                $identificador[9] = 1 + (int) $identificador[9];
                $identificador[10] = 0;
            } elseif ($identificador[8] < 9) {
                $identificador[8] = 1 + (int) $identificador[8];
                $identificador[9] = 0;
                $identificador[10] = 0;
            }
        }
        return $identificador;
    }

    // Genera contaseña
    public static function passwd_generate($clave) {
        if (is_null($clave))
            $clave = Hash::make(str_random(5));
        else
            $clave = Hash::make($clave);
        return $clave;
    }

    public static function RandomString($length, $uc, $n, $sc) {
        $source = "";
        if ($uc == 1)
            $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($n == 1)
            $source .= '1234567890';
        if ($sc == 1)
            $source .= '|@#~$%()=^*+[]{}-_';
        if ($length > 0) {
            $rstr = "";
            $source = str_split($source, 1);
            for ($i = 1; $i <= $length; $i++) {
                mt_srand((double) microtime() * 1000000);
                $num = mt_rand(1, count($source));
                $rstr .= $source[$num - 1];
            }
            return $rstr;
        }
    }

    // Genera fecha/tiempo en segundo estadar UNIX
    public static function time_generate($dia, $mes, $anyo) {
        return time($anyo . '/' . ($mes < 9 ? '0' . $mes : $mes) . '/' . ($dia < 9 ? '0' . $dia : $dia));
    }

    // Cambia las vocales con acento y las ñ's por caracteres ascii
    public static function ascii_transponse($cadena) {
        if (!is_null($cadena)) {
            foreach (self::$charset as $indice => $valor) {
                $cadena = str_replace($indice, $valor, trim($cadena));
            }
            return $cadena;
        } else
            return $cadena;
    }

    // Arreglo a String
    public static function strtoarr($str) {
        return explode(",", $str);
    }

    public static function arrtostr($arreglo) {
        if (!is_null($arreglo)) {
            $cadena = '';
            foreach ($arreglo as $key => $value) {
                if ($key > 0)
                    $cadena = $cadena . ',';
                $cadena = $cadena . trim($value);
            }
            return $cadena;
        } else
            return $arreglo;
    }

    // Regrasa todos lo contenidos de objeto json binario
    public static function all() {
        $archivo = fopen('/var/www/html/sidma/public/estudiante/adds.json', 'r');
        $datos = '';
        while (!feof($archivo)) {
            $datos = $datos . fgets($archivo);
        }
        fclose($archivo);
        return json_decode($datos);
    }

    // Encuentra una cadena de texto en un fiechero
    public static function find($cadena) {
        $archivo = fopen('/var/www/html/sidma/public/estudiante/adds.json', 'r');
        $datos = '';
        while (!feof($archivo)) {
            $datos = $datos . fgets($archivo);
        }
        fclose($archivo);
        $objeto = json_decode($datos);
        foreach ($objeto as $indice => $contenido) {
            if ($indice == $cadena) {
                return $contenido;
                break;
            }
        }
    }

    // Guarda en una cadena de texto en un fichero
    public static function save($indice, $contenido) {
        $archivo = fopen('/var/www/html/sidma/public/estudiante/adds.json', 'r');
        $datos = array();
        $i = 0;
        while (!feof($archivo)) {
            $datos[$i] = fgets($archivo);
            $i++;
        }
        fclose($archivo);

        for ($i = 0; $i < count($datos); $i++) {
            $cadena = trim($datos[$i]);
            if (count($datos) >= 3) {
                if ($i > 0 AND $i < (count($datos) - 1))
                    if (strpos($cadena, ',') === false)
                        $coma = $cadena . ',';
                    else
                        $coma = $cadena;
                else
                    $coma = $cadena;
                $datos[$i] = $coma;
            } else
                $datos[$i] = $cadena;
        }
        $datos[count($datos) - 1] = '"' . $indice . '":"' . $contenido . '"';
        $datos[count($datos)] = '}';

        $nuevos_datos = '';
        foreach ($datos as $i => $c) {
            if ((count($datos) - 1) == $i)
                $nuevos_datos = $nuevos_datos . $c;
            else
                $nuevos_datos = $nuevos_datos . $c . PHP_EOL;
        }
        $archivo = fopen('/var/www/html/sidma/public/estudiante/adds.json', 'w+');
        fwrite($archivo, $nuevos_datos);
        fclose($archivo);
        return 1;
    }

    // Verifica si la variable esta vacia
    public static function fill($cadena) {
        if (empty($cadena) OR is_null($cadena) OR ! isset($cadena))
            return NULL;
        else
            return $cadena;
    }

    public static function FormatDate($date) {
        $date = explode(' ', $date);
        $hms = '';
        if (count($date) > 1)
            $hms = $date[1];
        if (!empty($date[0])) {
            $dat = explode('-', $date[0]);
            $date_day = $dat[2];
            $date_month = $dat[1];
            $date_year = $dat[0];
            return $date_day . "/" . $date_month . "/" . $date_year . ' ' . $hms;
        }
    }

   

    public static function FormatDateMysql($date) {
        $dat = explode('/', trim($date));
        $date_day = $dat[0];
        $date_month = $dat[1];
        $date_year = $dat[2];
        return $date_year . "-" . $date_month . "-" . $date_day;
    }

}
