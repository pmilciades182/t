<?php

/// incluye la conexion a la bd
include_once('mongo.php');

if(isset($_POST['coleccion'] ) or isset($_GET['coleccion']) )
{
    ///entidad

    if(isset($_POST['coleccion']))
    {
        $_COLECCION = $_POST['coleccion'];
    }

    if(isset($_GET['coleccion']))
    {
        $_COLECCION = $_GET['coleccion'];
    }

}else{
    echo 'coleccion no definida';

    return null;

    exit();
}



///crear collection
__collection($_MONGO , $_DB, $_COLECCION);

///letra e utilizado para select

/// limite standard

$_LIMIT = 10;

if(isset($_POST['e']) or isset($_GET['e']) )
{
    //// p es para la paginacion

    if(isset($_POST['p']))
    {
        $_P = $_POST['p'];
    }
    else
    {
        if(isset($_GET['p']))
        {
            $_P = $_GET['p'];
        }else
        {
            $_P = 1;
        }
    }

    $_P = intval($_P);
    
    if($_P == 1)
    {
        $_P = 0; 
    }
    else
    {
        $_P = (intval($_P) - 1) * 10;
    }

    /// limite aumentado para listas detalle en formulario

    if(isset($_POST['detail']) or isset($_GET['detail']) )
    {
        $_LIMIT = 1000;
    }
   

    ///letra w para definir un where
    if(isset($_POST['w']) or isset($_GET['w']) )
    {
        $_WH = [];

        if(isset($_POST['w']))
        {
            $_WH = $_POST['w'];
        }else
        {
            $_WH = $_GET['w'];
        }
        $_WH = json_decode($_WH);
        //var_dump($_WH);

        
       
        $_FILTRO    = [
            '$and' => [$_WH]
        ];

        $_OPCIONES   = ['sort' => ['id' => -1]];
        $_D = __select($_MONGO,$_DB, $_COLECCION, $_FILTRO , $_OPCIONES );
    }
    else
    {
       $_FILTRO    = [];
       $_OPCIONES   = [
           'sort' => ['id' => -1]  ,
           'skip' => $_P,
           'limit' => $_LIMIT
        ];
       $_D = __select($_MONGO,$_DB, $_COLECCION, $_FILTRO , $_OPCIONES );
    }

    echo $_D;
}

///letra c para definir un count
if(isset($_POST['c']) or isset($_GET['c']))
{

    /// count con where
    if(isset($_POST['w']) or isset($_GET['w']) )
    {
        $_WH = [];

        if(isset($_POST['w']))
        {
            $_WH = $_POST['w'];
        }else
        {
            $_WH = $_GET['w'];
        }
        $_WH = json_decode($_WH);
        //var_dump($_WH);
       

        $_FILTRO    = [
            '$and' => [$_WH]
        ];

       
        $_OPCIONES   = [];
        $_D = __count($_MONGO,$_DB, $_COLECCION,$_FILTRO);
        
    }
    else
    {
        $_FILTRO    = [];
        $_OPCIONES   = [];
        $_D = __count($_MONGO,$_DB, $_COLECCION,$_FILTRO);
      
    }

    echo $_D;

}

///letra i para definir un insert
if(isset($_POST['i']) or isset($_GET['i']))
{
        ////letra d para datos a insertar
        /// solo por post
        if (isset($_POST['d']))
        {
           
            $DATA =   ($_POST['d']);
            /// enumerar el id

            $_FILTRO    = [];
            $_OPCIONES   = [
                'sort' => ['id' => -1]  ,
                'skip' => 0,
                'limit' => 1
             ];

             $_D = __select($_MONGO,$_DB, $_COLECCION, $_FILTRO , $_OPCIONES );
             $N  = json_decode($_D);
             $N  = $N[0]->id;

             $N  = intval($N) +1;
             
            $DATA['id'] = $N;
            //var_dump($DATA);

            $DATA = __toarray($DATA, $_COLECCION);

            $DATA['insert_date'] = date('Y-m-d H:i:s');

            $_D = __insert($_MONGO,$_DB, $_COLECCION,$DATA);
            echo '{"ok" : "insert!"}';
        }
        else
        {
            //$DATA =   json_decode($_POST['d']);
            echo '{ "Error" : "DATA - POST"} ';
        }
      
}

///palabra del para definir un delete
if(isset($_POST['del']) or isset($_GET['del']))
{
        ////letra d para datos a insertar
        if (isset($_POST['d']) or isset($_GET['d']))
        {
           if(isset($_POST['d']))
           {
            $DATA =   ($_POST['d']);
           }
           else
           {
            $DATA =   ($_GET['d']);
           }

            $DATA = explode(",",  $DATA);

            foreach ($DATA as &$valor) {
                //var_dump( $valor);
                __delete($_MONGO,$_DB, $_COLECCION,$valor);
            }

            
            echo '{ "Ok" : "DATA - POST"} ';
            
        }
        else
        {
            //$DATA =   json_decode($_POST['d']);
            echo '{ "Error" : "DATA - POST"} ';
        }
      
}
///exp es para descargar csv
if(isset($_POST['exp']) or isset($_GET['exp']) )
{
        $NAME_CSV = 'archivo';

        if (isset($_POST['name']))
        {
            $NAME_CSV = $_POST['name'];
        }
        else
        {
            $NAME_CSV = $_GET['name'];
        }

        if( strlen(trim($NAME_CSV)) == 0)
        {
            $NAME_CSV = 'archivo';
        }
      
       $_FILTRO    = [];
       $_OPCIONES   = [
           'sort' => ['id' => -1]  ];

        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=".$NAME_CSV.".csv");
        header("Pragma: no-cache");
        header("Expires: 0");

       $_D = __select($_MONGO,$_DB, $_COLECCION, $_FILTRO , $_OPCIONES );
       $_D = json_decode($_D);

       //var_dump($_D);

       
       foreach ($_D as $key => $value)
       {


           foreach ($value as $R => $S)
           {
            //var_dump($S);
            if(is_string($R))
            {
                echo $R . ' ; ';
            }
           }
           echo  "\r\n";
           break;
      }

       foreach ($_D as $key => $value)
       {


           foreach ($value as $R => $S)
           {
            //var_dump($S);
            if(is_string($S))
            {
                echo $S . ' ; ';
            }else{
                if(is_int($S))
                {
                    echo $S . ' ; ';
                }else
                {
                    echo ' ; ';
                }
                
            }
           }
           echo  "\r\n";
      }
        
}
 

///letra u para definir un update
if(isset($_POST['u']) or isset($_GET['u']))
{
        ////letra d para datos a insertar
        /// solo por post
        if ( isset($_POST['d']) and isset($_POST['id']) )
        {
           
            $DATA =   ($_POST['d']);
            $ID   =   intval($_POST['id']);

            $DATA['id'] = $ID;

            $DATA =  __toarray($DATA, $_COLECCION);

            $_D = __update($_MONGO,$_DB, $_COLECCION,$DATA,$ID);

            echo '{"ok" : "update!"}';

        }
        else
        {
            //$DATA =   json_decode($_POST['d']);
            echo '{ "Error" : "DATA - POST"} ';
        }
      
}



//// funcion que convierte strings separados por coma a array en mongo

function __toarray($DATA, $_COLECCION)
{
    if( $_COLECCION == 'persona')
    {
        $DATA['movilidad'] = explode(",",$DATA['movilidad']);
    }

    if( $_COLECCION == 'usuario')
    {
        $DATA['grupo'] = explode(",",$DATA['grupo']);
    }

    if( $_COLECCION == 'grupo')
    {
        $DATA['aplicacion'] = explode(",",$DATA['aplicacion']);
    }

    return $DATA;
}


///funcion especial que se encarga de resumir el proceso de insertar o actualzar un turno

if(isset($_POST['turno']) or isset($_GET['turno']))
{

    /// count con where
    if(isset($_POST['w']) or isset($_GET['w']) )
    {
        $_WH = [];
        $DATA =   ($_POST['d']);

        if(isset($_POST['w']))
        {
            $_WH = $_POST['w'];
        }else
        {
            $_WH = $_GET['w'];
        }
        $_WH = json_decode($_WH);
        //var_dump($_WH);
       

        $_FILTRO    = [
            '$and' => [$_WH]
        ];

        
        $_D = __count($_MONGO,$_DB, $_COLECCION,$_FILTRO);


        if( intval($_D) == 0)
        {
            $_FILTRO    = [];
            $_OPCIONES   = [
                'sort' => ['id' => -1]  ,
                'skip' => 0,
                'limit' => 1
             ];

            $_K = __select($_MONGO,$_DB, $_COLECCION, $_FILTRO , $_OPCIONES );
            $N  = json_decode($_K);
            $N  = $N[0]->id;
            $N  = intval($N) +1;

            $DATA['id'] = $N;
            __insert($_MONGO,$_DB, $_COLECCION,$DATA);

        }
        else
        {

            $_OPCIONES   = [
                'sort' => ['id' => -1]  ,
                'skip' => 0,
                'limit' => 1
             ];

            $_K = __select($_MONGO,$_DB, $_COLECCION, $_FILTRO , $_OPCIONES );
            $N  = json_decode($_K);
            $ID  = $N[0]->id;
           
            __update($_MONGO,$_DB, $_COLECCION,$DATA,$ID);
        }





        
    }
 
    echo $_D;

}


?>