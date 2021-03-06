<?php 
	// expresiones regulares para Script listado_pasajeros
    $InitVuelos = "#(\{)(\"lista\_vuelos\")(\:\{)#";
    $aerolinea = "#(\"aerolinea\":\")([A-Z]+)(\")(,)#";
    $vuelos = "#(\"vuelos\":)(\[)#";
    $numero = "#(\{)(\"numero\":\")([0-9]+)(\")(,)#";
    $fecha = "#(\"fecha\":\")(2014[0-1]([0-9]|[0-2])[0-3][0-9])(\")(,)#";
    $origen = "#(\"origen\":\")([A-Z]{3})(\")(,)#";
    $destino = "#(\"destino\":\")([A-Z]{3})(\")(,)#";
    $hora = "#(\"hora\":\")([0-2][0-9]:[0-5][0-9])(\")(,)#";
    $precio = "#(\"precio\":\")([0-9]+)(\")(,)#";
    $status = "#(\"status\":\")([1-3])(\")(\})(,)?#";
    $FinVuelos = "#(\])#";
    $FinListV = "#(\})(\})#";

	
	//Arreglo de expresiones regulares
	$expresion = array(0 => $InitVuelos,	
					1 =>$aerolinea,
					2 =>$vuelos,
					3 =>$numero,
					4 =>$fecha,
					5 =>$origen,
					6 =>$destino,
					7 =>$hora,
					8 =>$precio,
					9 =>$status,
					10 =>$FinVuelos,
					11 =>$FinListV
		);


	//Se empieaza a leer el archivo
	$handle = fopen("C:\wamp\www\aeropuerto\pruebaJ.txt", "r");
	$cont = 0;

	if ($handle) {
	    while (($line = fgets($handle)) !== false) {
	        for ($i=0; $i < 12; $i++) {
	        	$pattern = $expresion[$i];
	        	if (preg_match($pattern, $line, $matches) === 1) {
	        		switch ($i) {
		        		case '0':
		        			//contruir la linked list
		        			$FlightList = new SplDoublyLinkedList();
		        			break;       		
		        		case '1':
		        			$Flight = array(0 => $matches[2]);
		        			break; 
		        		case '3':
		        			$Flight[1] = $matches[3];
		        			if ($matches[1] == "{") {
		        				$cont += 1;
		        			}
		        			break; 		        		
		        		case '4':
		        			$Flight[2] = $matches[2];
		        			break;
		        		case '5':
		        			$Flight[3] = $matches[2];	        					        			
		        			break;       		
		        		case '6':
		        			$Flight[4] = $matches[2];
		        			break; 
		        		case '7':
		        			$Flight[5] = $matches[2];	        			
		        			break; 
		        		case '8':
		        			$Flight[6] = $matches[2];		        			
		        			break;
		        		case '9':
		        			$Flight[7] = $matches[2];
		        			if ($matches[4] == "}") {
		        				$cont += 1;
		        				$doPush = ($cont % 2);
		        				if ($doPush == 0)
		        					$FlightList->push($Flight);
		        			}
		        			break;		 
		        	}
		        }       	
	    	}
	    }
	} else {
	    // error opening the file.
	} 

	fclose($handle);
?>