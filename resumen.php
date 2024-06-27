
<body>
<?php

include_once("includes/header.php");

session_start();


// echo "<table>";

//     foreach ($_SESSION as $key => $value) {
//         echo "<tr>";
//         echo "<td>";
//         var_dump($key);
//         echo "</td>";
//         echo "<td>";
//         var_dump($value);
//         echo "</td>";
//         echo "</tr>";
//     }
//     echo "</table>";

?>
 
<body style="margin: 0 auto; padding: 0; background-color: #e1e1e1;" id="carta_print">
 <nav class="navbar bg-primary" data-bs-theme="dark">
        <div class="container">
            <h4 class="h1 my-2 text-uppercase" style="color: white; font-weight: bold; margin-left: 5rem"><i class="bi bi-airplane-engines-fill"></i> Km airlines</h4>
        </div>
    </nav>
    <main>
        <div id="card_airline" class="container card my-5 mx-auto" style="max-width: 800px">
            <div class="card-body text-center">
                <span class="ms-2 material-symbols-outlined text-success" style="font-size: 5rem;">verified</span>
                <h4 class="fs-3 text-center d-flex align-items-center justify-content-center"><span class="fs-1 material-symbols-outlined me-3">other_admission</span>Resumen de la reserva </h4> 
                <h4 class="fs-3 text-center d-flex align-items-center justify-content-center">Boleto <span class="fw-bold ms-2 text-decounderlined"> #<?=  $_SESSION["nro_boleto"] ?></span> </h4> 
                <hr class="my-2">

                <div class="p-2 mt-3 w-75 mx-auto" style="border: 1px solid #e1e1e1; border-radius: 6px">
                    <div>
                        <h4 class="fs-4 mt-3 text-primary d-flex align-items-center justify-content-center"><span class="fs-3 material-symbols-outlined me-3">airplane_ticket</span>Vuelo Destino</h4>
                        <hr class="my-2 mx-auto w-50 ">
                        <p class="mb-1">fecha: <span class="fw-bold"><?= $_SESSION["vuelo_info"]["fecha"] ?></span></p>
                        <p class="mb-1">Clase: <span class="fw-bold"><?= $_SESSION["vuelo_info"]["clase"] ?></span></p>
                        <p class="mb-1">Origen: <span class="fw-bold"><?= $_SESSION["vuelo_info"]["ruta_orig"] ?></span></p>
                        <p class="mb-1">Destino: <span class="fw-bold"><?= $_SESSION["vuelo_info"]["ruta_ret"] ?></span></p>
                        <p class="mb-1">Precio: <span class="fw-bold text-success">$<?= $_SESSION["vuelo_info"]["precio"] ?></span></p>
                    </div>
                    <?php  if(isset( $_SESSION["vuelo_info_ret"])) { ?>
                    <div>
                        <h4 class="fs-4 mt-3 text-primary d-flex align-items-center justify-content-center"><span class="fs-3 material-symbols-outlined me-3">airplane_ticket</span>Vuelo Retorno</h4>
                        <hr class="my-2 mx-auto w-50 ">
                        <p class="mb-1">fecha: <span class="fw-bold"><?= $_SESSION["vuelo_info_ret"]["fecha"] ?></span></p>
                        <p class="mb-1">Clase: <span class="fw-bold"><?= $_SESSION["vuelo_info_ret"]["clase"] ?></span></p>
                        <p class="mb-1">Origen: <span class="fw-bold"><?= $_SESSION["vuelo_info_ret"]["ruta_orig"] ?></span></p>
                        <p class="mb-1">Destino: <span class="fw-bold"><?= $_SESSION["vuelo_info_ret"]["ruta_ret"] ?></span></p>
                        <p class="mb-1">Precio: <span class="fw-bold text-success">$<?= $_SESSION["vuelo_info_ret"]["precio"] ?></span></p>
                    </div>
                    <?php } ?>
                    <div>
                        <h4 class="fs-4 mt-3 text-primary d-flex align-items-center justify-content-center"><span class="fs-3 material-symbols-outlined me-3">account_box</span>Pasajero</h4>
                        <hr class="my-2 mx-auto w-50 ">
                        <p class="mb-1">Nombre: <span class="fw-bold"><?= $_SESSION["passenger"]["nombre"] ?></span></p>
                        <p class="mb-1">Fecha de nacimiento: <span class="fw-bold"><?= $_SESSION["passenger"]["fecha_n"] ?></span></p>
                        <p class="mb-1">Correo: <span class="fw-bold"><?= $_SESSION["passenger"]["correo"] ?></span></p>
                        <p class="mb-1">Cedula: <span class="fw-bold"><?= $_SESSION["passenger"]["cedula"] ?></span></p>
                    </div>
                    <div>
                        <h4 class="fs-4 mt-3 text-primary d-flex align-items-center justify-content-center"><span class="fs-3 material-symbols-outlined me-3">payment</span>Pago</h4>
                        <hr class="my-2 mx-auto w-50 ">
                        <p class="mb-1">Tarjeta: <span class="fw-bold"><?=  $_SESSION["payment"]["tarjeta"] ?></span></p>
                        <p class="mb-1">Email: <span class="fw-bold"><?= $_SESSION["payment"]["email"] ?> </span></p>
                        <p class="mb-1">Nombre: <span class="fw-bold"><?= $_SESSION["payment"]["nombre"] ?></span></p>
                        <p class="mb-1">Monto: <span class="fw-bold text-success">$ <?= $_SESSION["payment"]["monto"] ?></span></p>
                    </div>
                </div>
                <button class="text-center fw-bold btn btn-large btn-outline-primary mt-4 me-3 mx-auto" style="width: 200px" onclick="location = 'index.php'"> Salir</button>
                <button onclick="bajarPdf()" class="text-center fw-bold btn btn-large btn-success mt-4 mx-auto" style="width: 200px" onclick="location = 'index.php'"> Descargar</button>
            </div>
        </div>

        
        <div id="boleto_info" class="p-2 mt-3 w-75 mx-auto hidden" style="border: 1px solid #e1e1e1; border-radius: 6px; text-align: center!important">
            <style> 
                .text-center {
                    text-align: center;
                }
            </style>
                    <h4 class="fs-3 text-center d-flex align-items-center justify-content-center">Resumen de la reserva </h4> 
                    <br>
                    <h4 class="fs-3 text-center d-flex align-items-center justify-content-center">Boleto <span class="fw-bold ms-2 text-decounderlined"> #<?=  $_SESSION["nro_boleto"] ?></span> </h4> 
                    <div>
                        <br>
                        <h4 class="fs-4 mt-3 text-primary d-flex align-items-center justify-content-center">Vuelo Destino</h4>
                        <hr class="my-2 mx-auto w-50 ">
                        <p class="mb-1">fecha: <span class="fw-bold"><?= $_SESSION["vuelo_info"]["fecha"] ?></span></p>
                        <p class="mb-1">Clase: <span class="fw-bold"><?= $_SESSION["vuelo_info"]["clase"] ?></span></p>
                        <p class="mb-1">Origen: <span class="fw-bold"><?= $_SESSION["vuelo_info"]["ruta_orig"] ?></span></p>
                        <p class="mb-1">Destino: <span class="fw-bold"><?= $_SESSION["vuelo_info"]["ruta_ret"] ?></span></p>
                        <p class="mb-1">Precio: <span class="fw-bold text-success">$<?= $_SESSION["vuelo_info"]["precio"] ?></span></p>
                    </div>
                    <?php  if(isset( $_SESSION["vuelo_info_ret"])) { ?>
                    <div>
                        <br>
                        <h4 class="fs-4 mt-3 text-primary d-flex align-items-center justify-content-center">Vuelo Retorno</h4>
                        <hr class="my-2 mx-auto w-50 ">
                        <p class="mb-1">fecha: <span class="fw-bold"><?= $_SESSION["vuelo_info_ret"]["fecha"] ?></span></p>
                        <p class="mb-1">Clase: <span class="fw-bold"><?= $_SESSION["vuelo_info_ret"]["clase"] ?></span></p>
                        <p class="mb-1">Origen: <span class="fw-bold"><?= $_SESSION["vuelo_info_ret"]["ruta_orig"] ?></span></p>
                        <p class="mb-1">Destino: <span class="fw-bold"><?= $_SESSION["vuelo_info_ret"]["ruta_ret"] ?></span></p>
                        <p class="mb-1">Precio: <span class="fw-bold text-success">$<?= $_SESSION["vuelo_info_ret"]["precio"] ?></span></p>
                    </div>
                    <?php } ?>
                    <div>
                        <br>
                        <h4 class="fs-4 mt-3 text-primary d-flex align-items-center justify-content-center">Pasajero</h4>
                        <hr class="my-2 mx-auto w-50 ">
                        <p class="mb-1">Nombre: <span class="fw-bold"><?= $_SESSION["passenger"]["nombre"] ?></span></p>
                        <p class="mb-1">Fecha de nacimiento: <span class="fw-bold"><?= $_SESSION["passenger"]["fecha_n"] ?></span></p>
                        <p class="mb-1">Correo: <span class="fw-bold"><?= $_SESSION["passenger"]["correo"] ?></span></p>
                        <p class="mb-1">Cedula: <span class="fw-bold"><?= $_SESSION["passenger"]["cedula"] ?></span></p>
                    </div>
                    <div>
                        <br>
                        <h4 class="fs-4 mt-3 text-primary d-flex align-items-center justify-content-center">Pago</h4>
                        <hr class="my-2 mx-auto w-50 ">
                        <p class="mb-1">Tarjeta: <span class="fw-bold"><?=  $_SESSION["payment"]["tarjeta"] ?></span></p>
                        <p class="mb-1">Email: <span class="fw-bold"><?= $_SESSION["payment"]["email"] ?> </span></p>
                        <p class="mb-1">Nombre: <span class="fw-bold"><?= $_SESSION["payment"]["nombre"] ?></span></p>
                        <p class="mb-1">Monto: <span class="fw-bold text-success">$ <?= $_SESSION["payment"]["monto"] ?></span></p>
                    </div>
                </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>

    <script>
        // import { jsPDF } from "jspdf";
        
        function bajarPdf() {
            var element = document.getElementById('boleto_info');
            var elementHandler = {
                '#boleto_info': function (element, renderer) {
                    return true;
                }
                };
            options = {};
            const doc = new jsPDF({
                
                orientation: 'p',
                unit: 'mm',
                format: 'a4',
                putOnlyUsedFonts:true
            });
            doc.fromHTML( element, { 'width': 600,'elementHandlers': elementHandler });

            // doc.text(element);
            doc.save("boleto<?= $_SESSION["nro_boleto"]?>.pdf");

        }
    </script>
</body>
</html>