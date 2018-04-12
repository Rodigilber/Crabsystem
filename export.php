    <?php

    require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos 


  // Codigo Jodido del RODI
  //  
  // include 'db.php';
  //   $SQL = "SELECT  * from clientes";
  //   $header = '';
  //   $result ='';
  //   //$exportData = mysql_query ($SQL ) or die ( "Sql error : " . mysql_error( ) );


  //   $exportData=mysqli_query($con,"SELECT  * from clientes");
     
  //   $fields = mysqli_num_fields ( $exportData );
     
  //  /* for ( $i = 0; $i < $fields; $i++ )
  //   {
  //       $header .= mysqli_fetch_field( $exportData , $i ) . "\t";
  //   }
  // */   

  //   // Agregamos la cabecera del archivo en excel

  //   while( $row = mysqli_fetch_row( $exportData ) )
  //   {
  //       $line = '';
  //       foreach( $row as $value )
  //       {                                            
  //           if ( ( !isset( $value ) ) || ( $value == "" ) )
  //           {
  //               $value = "\t";
  //           }
  //           else
  //           {
  //               $value = str_replace( '"' , '""' , $value );
  //               $value = '"' . $value . '"' . "\t";
  //           }
  //           $line .= $value;
  //       }
  //       $result .= trim( $line ) . "\n";
  //   }
  //   $result = str_replace( "\r" , "" , $result );
     
  //   if ( $result == "" )
  //   {
  //       $result = "\nNo Record(s) Found!\n";                        
  //   }
     
  //   header("Content-type: application/octet-stream");
  //   header("Content-Disposition: attachment; filename=export.xls");
  //   header("Pragma: no-cache");
  //   header("Expires: 0");
  //   print "$header\n$result";
  

    // Exportando la informacion a un archivo de Excel
    function cleanData(&$str)
      {

        // escape tab characters
        $str = preg_replace("/\t/", "\\t", $str);

        // escape new lines
        $str = preg_replace("/\r?\n/", "\\n", $str);


        // Formatos de Fechas a Strings
        if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
            $str = "'$str";
        }

        // escape fields that include double quotes
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';

      }

      // Nomnbre del archivo a bajar
      $filename = "clientes_" . date('Ymd') . ".xlsx";

      header("Content-Disposition: attachment; filename=\"$filename\"");
      header('Content-Type: application/vnd.ms-excel; charset=utf-8');


      $flag   = false;
      $result = mysqli_query($con, "SELECT nombre_cliente as Nombre, telefono_cliente as Telefono, email_cliente as Email, direccion_cliente as Direccion, date_added as Agregado  FROM clientes ORDER BY nombre_cliente") or die('Query failed!');

      while( $row = mysqli_fetch_assoc($result))  {

        // Mostramos los encabezados en la primer fila
        if(!$flag) {
          echo implode("\t", array_keys($row)) . "\r\n";
          $flag = true;
        }

        // Creamos los rows de informacion
        array_walk($row, __NAMESPACE__ . '\cleanData');
        echo implode("\t", array_values($row)) . "\r\n";

      }

      exit;    
     
    ?>