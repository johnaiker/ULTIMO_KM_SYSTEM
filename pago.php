<?php

    session_start();

    if(isset($_SESSION["vuelo_info"]["precio"])) {
        
    
        
        include 'includes/header.php'; // Incluir Archivo de PHP

        $montoTotal = floatval($_SESSION["vuelo_info"]["precio"]);

        if(isset($_SESSION["vuelo_info_ret"])) {
            $montoTotal += floatval($_SESSION["vuelo_info_ret"]["precio"]);
        }

        $numero = $_POST["tarjeta"];
        $numero = str_replace("-", "", $numero);

        $exp_date = $_POST["fecha_pago"];
        $cvc = $_POST["cvc"];

        $_SESSION["payment"] = [
            "tarjeta" => $_POST["tarjeta"],
            "email" => $_POST["email"],
            "nombre" => $_POST["nombre"],
            "monto" => $montoTotal,
        ];
        
        $sql = "SELECT fondos FROM tarjetas WHERE numero=\"$numero\" AND exp_date=\"$exp_date\" AND cvc=\"$cvc\"";
        // echo "SQL: ", $sql;
        // $sql = "SELECT fondos FROM tarjetas WHERE numero=\"4012888888881881\" AND exp_date=\"12/12\" AND cvc=\"123\"";

        $result = $conn->query($sql);


        ?>
        <body style="margin: 0 auto; padding: 0; background-color: #e1e1e1;">
            <nav class="navbar bg-primary" data-bs-theme="dark">
                <div class="container-fluid">
                    <h4 class="h1 my-2 text-uppercase" style="color: white; font-weight: bold; margin-left: 5rem"><i class="bi bi-airplane-engines-fill"></i> Km airlines</h4>
                </div>
            </nav>
        
            <div class="card my-5 w-50 mx-auto">
                
                <?php 

                       
                if ($result->num_rows > 0) { 
                    
                    
  while($row = $result->fetch_assoc()) {
                    ?>
                    
                    <div class="card-body text-center">
                        <h4 class="fs-3" id="status_message">Procesando Reserva</h4>
                        <hr class="w-75 mx-auto">
                        <div id="spinner" class="spinner-border text-primary" role="status">
                            <span class="visually-hidden ">Loading...</span>
                        </div>
                    </div>
                    <hr>

                    
                    <div id="saldo_info" class="card alert alert-warning w-75 mx-auto hidden">
                        <div class="card-body">
                            <p id="boleto" class="text-center fw-bold  fs-3 hidden">Boleto: #<span id="boleto_txt" class="text-primary"></span></p>
                            <p class="fw-bold fs-1 text-center text-success"><span class="fw-light">Saldo:</span> $<?= $row["fondos"] ?></p>
                            <h3 class="text-center">Se esta a punto de cobrar <span class="fw-bold text-success">$<?= $montoTotal ?></span>, a <b><?= $numero ?></b>.</h3>
                        </div>
                    </div>
                    <form id="loginform" method="post" class="text-center">
                        
                        <input type="text" class="hidden" name="reservar_boleto" value="1">
                        <button type="submit" style="width: 160px" class=" mb-3 mx-auto text-center btn btn-large btn-outline-primary fw-bold">Continuar</button>

                    </form>

                    
                <?php } } else { ?>
                    <div class="card alert mt-3 alert-danger w-75 mx-auto">
                        <div class="card-body">
                            <p class="fw-bold"></p>
                            <h3 class="text-center">El metodo de pago no esta asociado a ningun comercio o persona </h3>
                        </div>
                    </div>

                    <button onclick="location='index.php'" style="width: 160px" class=" mb-3 mx-auto text-center btn btn-large btn-outline-danger">Salir</button>

                <?php }

                // echo '<pre>';
                // var_dump($_POST);
                // echo '</pre>';
                ?>
            </div>

            <script>


            $('#loginform').submit(async function(e) {
                    e.preventDefault();
                    await setTimeout(reservarBoleto(this), 5000);
            });
                // var objXMLHttpRequest = new XMLHttpRequest();

                // objXMLHttpRequest.onreadystatechange = function() {
                //     if(objXMLHttpRequest.readyState === 4) {
                //         if(objXMLHttpRequest.status === 200) {
                //             alert(objXMLHttpRequest.responseText);
                //         } else {
                //             alert('Error Code: ' +  objXMLHttpRequest.status);
                //             alert('Error Message: ' + objXMLHttpRequest.statusText);
                //         }
                //     }
                // }
                function reservarBoleto (context) {
                    $.ajax({
                        type: "POST",
                        url: './helpers/reserva.php',
                        data: $(context).serialize(),
                        success: function(response)
                        {
                            var jsonData = JSON.parse(response);
                            // user is logged in successfully in the back-end 
                            // let's redirect 
                            console.log(jsonData);
                            if (jsonData.success == "true")
                            {
                                $("#status_message").text("Procesando Pago");
                                $("#spinner").removeClass("text-primary");
                                $("#spinner").addClass("text-warning");
                                $("#boleto").removeClass("hidden");
                                // console.log(jsonData)
                                $("#boleto_txt").text(`${jsonData.boleto}`);
                                $("#saldo_info").removeClass("hidden");
                                // alert("Success", jsonData);
                                // location.href = 'my_profile.php';
                                setTimeout(() => {
                                    pagarBoleto(context)
                                }, 2000);
                            }
                            else
                            {
                                alert('Error al reservar vuelo');
                            }
                    }
                });
                }
                
                function pagarBoleto (context) {
                    $.ajax({
                        type: "POST",
                        url: './helpers/pago_boleto.php',
                        data: $(context).serialize(),
                        success: function(response)
                        {
                            var jsonData = JSON.parse(response);
                            // user is logged in successfully in the back-end 
                            // let's redirect 
                            console.log(jsonData);
                            if (jsonData.success == "true")
                            {
                                $("#status_message").addClass("text-success");
                                $("#status_message").text("Pago procesado, redireccionando...");
                                $("#spinner").removeClass("text-warning");
                                $("#spinner").addClass("text-success");

                                setTimeout(() => {
                                    location = 'resumen.php'
                                }, 3000);
                                // alert("Success", jsonData);
                                // location.href = 'my_profile.php';
                            }
                            else
                            {
                                alert('Error al procesar el pago');
                            }
                    }
                });
                }
            </script>
        </body>
        <?php
        
    } else {
        include 'conection_db.php';

        ?>
        <script>
            alert("No se encontraron datos para continuar con la reserva");
        </script>
        <?php
        // if (session_status() == PHP_SESSION_ACTIVE) {
        //     session_destroy();
        // }

        
        header("Location: ./pagar_boleto.php");
        // die(header("refresh: 6; url=index.php"));
    }

    ?>