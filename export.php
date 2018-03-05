    <?php
     


    require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos 
    //include 'db.php';
    $SQL = "SELECT  * from clientes";
    $header = '';
    $result ='';
    //$exportData = mysql_query ($SQL ) or die ( "Sql error : " . mysql_error( ) );



    $exportData=mysqli_query($con,"SELECT  * from clientes");
     
    $fields = mysqli_num_fields ( $exportData );
     
   /* for ( $i = 0; $i < $fields; $i++ )
    {
        $header .= mysqli_fetch_field( $exportData , $i ) . "\t";
    }
  */   
    while( $row = mysqli_fetch_row( $exportData ) )
    {
        $line = '';
        foreach( $row as $value )
        {                                            
            if ( ( !isset( $value ) ) || ( $value == "" ) )
            {
                $value = "\t";
            }
            else
            {
                $value = str_replace( '"' , '""' , $value );
                $value = '"' . $value . '"' . "\t";
            }
            $line .= $value;
        }
        $result .= trim( $line ) . "\n";
    }
    $result = str_replace( "\r" , "" , $result );
     
    if ( $result == "" )
    {
        $result = "\nNo Record(s) Found!\n";                        
    }
     
    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=export.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    print "$header\n$result";
     
    ?>