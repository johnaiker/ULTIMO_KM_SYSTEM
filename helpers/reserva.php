<?php
    include_once("../conection_db.php");

    session_start();

    function random_digits($length) {
        $result = '';
    
        for ($i = 0; $i < $length; $i++) {
            $result .= random_int(0, 9);
        }
    
        return $result;
    }

    if(isset($_POST["reservar_boleto"]) && isset($_SESSION["passenger"])) {
        if ($_POST["reservar_boleto"] == "1" ) {
            $nombre = $_SESSION["passenger"]["nombre"];
            $cedula = $_SESSION["passenger"]["cedula"];
            $correo = $_SESSION["passenger"]["correo"];
            $fecha_n = $_SESSION["passenger"]["fecha_n"];

            $fecha = $_SESSION["vuelo_info"]["fecha"];
            $ruta = $_SESSION["vuelo_info"]["ruta_orig"].$_SESSION["vuelo_info"]["ruta_ret"];
            // $ruta_ret = $_SESSION["vuelo_info"]["ruta_ret"];

            // $_SESSION["vuelo_info"] = [
            //     "fecha" => $fecha,
            //     "clase" => $clase,
            //     "ruta_orig" => $ruta_orig,
            //     "ruta_ret" => $ruta_ret,
            //     "precio" => $precio,
            // ];

            $boleto = random_digits(12);
            
            if(isset($_SESSION["vuelo_info_ret"])) {
                $ruta = $ruta."_". $_SESSION["vuelo_info"]["ruta_ret"].$_SESSION["vuelo_info"]["ruta_orig"];
            }

            // Step 2: Prepare and execute the update query
            $sql = "INSERT INTO `boletos` (`Id`, `Cedula`, `Boleto`, `Email`, `Scope`, `Fecha_b`, `Ruta`, `pagado`) VALUES (NULL, '$cedula', '$boleto', '$correo', 'VES', '$fecha', '$ruta', '0')";

            if ($conn->query($sql) === TRUE) {

                 $sql = "INSERT INTO `pasajeros` (`id`, `nombre`, `cedula`, `boleto`, `correo`, `fecha_n`, `pagado`) VALUES (NULL, '$nombre', '$cedula', '$boleto', '$correo', '$fecha_n', '0')";
                

                 $_SESSION["nro_boleto"] = $boleto;
                 
                if ($conn->query($sql) === TRUE) {
                    echo json_encode(array('success' => "true", "boleto" => $boleto));
                }
            } else {
                echo json_encode(array('success' => "false", 'error' => "Error al insertar en la db"));
                // echo "Error updating record: " . $conn->error;
            }

        }
    } else {
        echo json_encode(array('success' => "me chupa tres pingos"));
    }
