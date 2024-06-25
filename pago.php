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

        
        // $sql = "SELECT fondos FROM tarjetas WHERE numero=\"$numero\" AND exp_date=\"$exp_date\" AND cvc=\"$cvc\"";
        // echo "SQL: ", $sql;
        $sql = "SELECT fondos FROM tarjetas WHERE numero=\"4012888888881881\" AND exp_date=\"12/12\" AND cvc=\"123\"";

        $result = $conn->query($sql);


        ?>
        <body style="margin: 0 auto; padding: 0; background-color: #e1e1e1;">
            <nav class="navbar bg-primary" data-bs-theme="dark">
                <div class="container-fluid">
                    <h4 class="h1 my-2 text-uppercase" style="color: white; font-weight: bold; margin-left: 5rem"><i class="bi bi-airplane-engines-fill"></i> Km airlines</h4>
                </div>
            </nav>
        
            <div class="card my-5 w-50 mx-auto">
                <div class="card-body text-center">
                    <h4 class="fs-3">Procesando pago</h4>
                    <hr class="w-75 mx-auto">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <hr>

                
                <?php 

                       
                if ($result->num_rows > 0) { 
                    
  while($row = $result->fetch_assoc()) {
                    ?>
                    
                    <div class="card alert alert-warning w-75 mx-auto">
                        <div class="card-body">
                            <p class="fw-bold fs-1 text-center text-success"><span class="fw-light">Saldo:</span> $<?= $row["fondos"] ?></p>
                            <h3 class="text-center">Esta apunto de cobrar <span class="fw-bold text-success">$<?= $montoTotal ?></span>, a <b><?= $numero ?></b>.</h3>
                        </div>
                    </div>

                    
                <?php } } else { ?>
                    <div class="card alert alert-warning w-75 mx-auto">
                        <div class="card-body">
                            <p class="fw-bold"></p>
                            <h3 class="text-center">Esta apunto de cobrar <span class="fw-bold"><?= $montoTotal ?></span>, a <b><?= $numero ?></b>.</h3>
                        </div>
                    </div>

                <?php }

                // echo '<pre>';
                // var_dump($_POST);
                // echo '</pre>';
                ?>
            </div>

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