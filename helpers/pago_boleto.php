<?php
    include_once("../conection_db.php");

    session_start();

    if(isset($_POST["reservar_boleto"]) && isset($_SESSION["nro_boleto"])) {
        if ($_POST["reservar_boleto"] == "1" ) {
            
            
            $montoTotal = floatval($_SESSION["vuelo_info"]["precio"]);
            if(isset($_SESSION["vuelo_info_ret"])) {
                $montoTotal += floatval($_SESSION["vuelo_info_ret"]["precio"]);
            }

            $tarjeta = $_SESSION["payment"]["tarjeta"];
            
            $nroBoleto = $_SESSION["nro_boleto"];
            $clase = $_SESSION["vuelo_info"]["clase"];
            $fecha = $_SESSION["vuelo_info"]["fecha"];
            $ruta = $_SESSION["vuelo_info"]["ruta_orig"].$_SESSION["vuelo_info"]["ruta_ret"];

            if(isset($_SESSION["vuelo_info_ret"])) {
                
                $clase_ret = $_SESSION["vuelo_info_ret"]["clase"];
                $fecha_ret = $_SESSION["vuelo_info_ret"]["fecha"];
                $ruta_ret = $_SESSION["vuelo_info"]["ruta_ret"].$_SESSION["vuelo_info"]["ruta_orig"];
            }

            // Step 2: Prepare and execute the update query
            // Cobrarr a la tarjeta
            $sql = "UPDATE `tarjetas` SET fondos = fondos - $montoTotal WHERE numero = '$tarjeta'";
            
            if ($conn->query($sql) === TRUE) {
                
                $sql = "UPDATE `boletos` SET `pagado` = '1' WHERE `boletos`.`Boleto` = '$nroBoleto'";

                if ($conn->query($sql) === TRUE) {

                    $sql = "UPDATE `itinerario_vuelos` SET asientos = asientos - 1 WHERE clase='$clase' AND fecha='$fecha' AND ruta='$ruta'";
                    
                    if ($conn->query($sql) === TRUE) {
                        if(isset($_SESSION["vuelo_info_ret"])) {
                            $sql = "UPDATE `itinerario_vuelos` SET asientos = asientos - 1 WHERE clase='$clase_ret' AND fecha='$fecha_ret' AND ruta='$ruta_ret'";
                            $conn->query($sql);
                        }
                        
                        $sql = "UPDATE `pasajeros` SET `pagado` = '1' WHERE `pasajeros`.`boleto` = '$nroBoleto'";
                        
                        if ($conn->query($sql) === TRUE) {
                            echo json_encode(array('success' => "true", "boleto" => $nroBoleto));
                        } else {
                            echo json_encode(array('success' => "false", 'error' => "Error al insertar en la db, pasajeros"));

                        }
                    } else {
                        echo json_encode(array('success' => "false", 'error' => "Error al insertar en la db, itinerario_vuelos"));

                    }
                } else {
                    echo json_encode(array('success' => "false", 'error' => "Error al insertar en la db"));
                    // echo "Error updating record: " . $conn->error;
                }
            
            }else {
                echo json_encode(array('success' => "false", 'error' => "Error al cobrar pago"));
            }


        }
    } else {
        echo json_encode(array('success' => "Boleto Inexistente, no se cobraran los cargos"));
    }
