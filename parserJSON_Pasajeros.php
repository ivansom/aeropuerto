<?php 
	// expresiones regulares para Script listado_pasajeros
    $InitPasan = "#(\{)(\"lista\_pasajeros\")(\:\{)#";
    $aerolinea = "#(\"aerolinea\")(:)(\")([A-Z]+)(\")(,)#";
    $numero = "#(\"numero\")(:)(\")([0-9]+)(\")(,)#";
    $fecha = "#(\"fecha\")(:)(\")(2014[0-1]([0-9]|[0-2])[0-3][0-9])(\")(,)#";
    $origen = "#(\"origen\")(:)(\")([A-Z]{3})(\")(,)#";
    $destino = "#(\"destino\")(:)(\")([A-Z]{3})(\")(,)#";
    $avion = "#(\"avion\")(:)(\")(([A-Z]|[0-9])+)(\")(,)#";
	$pasajeros = "#(\"pasajeros\")(:)(\[)#";
	$boleto = "#(\{)(\"boleto\")(:)(\")(([a-zA-z]|[0-9])+)(\")(,)#";
	$nombre = "#(\"nombre\")(:)(\")([a-zA-z]+)(\")(,)#";
	$asiento =	"#(\"asiento\")(:)(\")([0-9]{2})(\")(\})(,?)#";
	$FinPasan = "#(\])#";
    $FinListP = "#(\})(\})#";
	
	//Arreglo de expresiones regulares
	$expresion = array(0 => $InitPasan,	
					1 =>$aerolinea,
					2 =>$numero,
					3 =>$fecha,
					4 =>$origen,
					5 =>$destino,
					6 =>$avion,
					7 =>$pasajeros,
					8 =>$boleto,
					9 =>$nombre,
					10 =>$asiento,
					11 =>$FinPasan,
					12 =>$FinListP
		);


	//Se empieaza a leer el archivo
	$handle = fopen("C:\wamp\www\aeropuerto\pruebaJ2.txt", "r");
	$cont = 0;
	
	if ($handle) {
	    while (($line = fgets($handle)) !== false) {
	        for ($i=0; $i < 13; $i++) {
	        	$pattern = $expresion[$i];
	        	if (preg_match($pattern, $line, $matches) === 1) {
	        		switch ($i) {
		        		case '0':
		        			//contruir la linked list
		        			$PassangerList = new SplDoublyLinkedList();
		        			break;       		
		        		case '1':
		        			$Pasanger = array(0 => $matches[4]);
		        			break; 
		        		case '2':
		        			$Pasanger[1] = $matches[4];
		        			break; 
		        		case '3':
		        			$Pasanger[2] = $matches[4];
		        			break; 		        		
		        		case '4':
		        			$Pasanger[3] = $matches[4];
		        			break;
		        		case '5':
		        			$Pasanger[4] = $matches[4];	        					        			
		        			break;       		
		        		case '6':
		        			$Pasanger[5] = $matches[4];
		        			break; 
		        		case '8':
		        			$Pasanger[6] = $matches[5];	
		        			if ($matches[1] == "{") {
		        				$cont += 1;
		        			}	        			
		        			break;
		        		case '9':
		        			$Pasanger[7] = $matches[4];
		        			break;
		        		case '10':
		        			$Pasanger[8] = $matches[4];
		        			if ($matches[6] == "}") {
		        				$cont += 1;
		        				$doPush = ($cont % 2);
		        				if ($doPush == 0)
		        					$PassangerList->push($Pasanger);
		        			}
		        			break;
		        		case '11':
		        			print_r($PassangerList);
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