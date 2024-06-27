<?php 

include 'includes/header.php'; // Incluir Archivo de PHP

// $nombre = $_POST["nombre"];

session_start();

$fecha = $_POST["fecha"];
$clase = $_POST["clase"];
$ruta_orig = $_POST["ruta_orig"];
$ruta_ret = $_POST["ruta_ret"];
$precio = $_POST["precio"];

if (isset($_POST["clase_r"])) {
    $fecha_r = $_POST["fecha_r"];
    $clase_r = $_POST["clase_r"];
    $precio_r = $_POST["precio_r"];

    
    $_SESSION["vuelo_info_ret"] = [
        "fecha" => $fecha_r,
        "clase" => $clase_r,
        "ruta_orig" => $ruta_ret,
        "ruta_ret" => $ruta_orig,
        "precio" => $precio_r,
    ];
}

// Variable de sesion usada para obtener info del vuelo
    $_SESSION["vuelo_info"] = [
        "fecha" => $fecha,
        "clase" => $clase,
        "ruta_orig" => $ruta_orig,
        "ruta_ret" => $ruta_ret,
        "precio" => $precio,
    ];

    $montoTotal = floatval($_SESSION["vuelo_info"]["precio"]);

    if(isset($_SESSION["vuelo_info_ret"])) {
        $montoTotal += floatval($_SESSION["vuelo_info_ret"]["precio"]);
    }
?>



<body style="margin: 0 auto; padding: 0; background-color: #e1e1e1;">
    <nav class="navbar bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <h4 class="h1 my-2 text-uppercase" style="color: white; font-weight: bold; margin-left: 5rem"><i class="bi bi-airplane-engines-fill"></i> Km airlines</h4>
        </div>
    </nav>
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card py-4 mt-6 mx-auto text-center" >
                    <h4 class="fs-3 text-uppercase text-center mb-3 d-flex align-items-center justify-content-center"> <div class="fs-1 material-symbols-outlined me-2">perm_contact_calendar</div> Datos del Pasajero</h4>
                    <hr class="my-2 mx-3 text-black">
                    <div class="container mt-4">
                        <form action="pagar_boleto.php" method="post" id="form_datos_usuario" onsubmit="validar()">
                            <div class="mb-3 row">
                                <div class="col-6">
                                    <div class="form-floating mb-3" >
                                        <input required data-mask='aaaaaaaaaaaaaaaaaaaa' type="text" class="form-control" name="nombre" id="nombre" placeholder="nombre" />
                                        <label for="nombre" class="d-flex align-items-center" ><span class="material-symbols-outlined me-2"> person </span> Nombre</labellabel >
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-3" >
                                        <input required data-mask='aaaaaaaaaaaaaaaaaaaa' type="text" class="form-control" name="apellido" id="apellido" placeholder="apellido" />
                                        <label for="inputName" class="d-flex align-items-center" ><span class="material-symbols-outlined me-2"> person </span>  Apellido</labellabel >
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-3" >
                                        <input required data-mask='V-00000000' maxlength="12" type="text" class="form-control" name="cedula" id="cedula" placeholder="Name" />
                                        <label for="cedula" class="d-flex align-items-center" ><span class="material-symbols-outlined me-2"> id_card </span>  Cedula</labellabel >
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-3" >
                                        <input required type="email" class="form-control" name="correo" id="correo" placeholder="Name" type="email" />
                                        <label for="correo" class="d-flex align-items-center" ><span class="material-symbols-outlined me-2"> mail </span>  Correo electronico</labellabel >
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-3" >
                                        <input required type="text" class="form-control" name="fecha_n" id="fecha_n" placeholder="fecha_n"  />
                                        <label for="fecha_n" class="d-flex align-items-center" ><span class="material-symbols-outlined me-2"> cake </span>  Fecha de nacimiento</labellabel >
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-outline-secondary d-block btn-lg me-3" onclick="location='index.php'">  Volver </button>
                                <button type="submit" class="btn btn-primary d-block btn-lg"> Reservar </button>
                            </div>
                                        
                            <!-- Inputs comentados solo para enviar informacion -->
                            <input required id="ruta_orig" name="ruta_orig" value="<?= $_POST["ruta_orig"] ?>" type="text" class="hidden"></input>
                            <input required id="ruta_ret" name="ruta_ret" value="<?= $_POST["ruta_ret"] ?>" type="text" class="hidden"></input>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="flex: auto">
                    <div class="container pt-2">
                        <h4 class="fs-3 text-center d-flex align-items-center justify-content-center"><span class="material-symbols-outlined me-2 fs-1">airplane_ticket</span> Resumen</h4>

                        <hr class="my-2">
                        <div>
                            <table class="table table-striped">
                                <thead>
                                    <tr class="fw-bold fs-5">
                                        <th scope="col">
                                            <div class="d-flex align-items-center"><span class="material-symbols-outlined me-2"> event </span>Fecha</div>
                                        </th>
                                        <th scope="col">
                                            <div class="d-flex align-items-center"><span class="material-symbols-outlined me-2"> flight_class </span>Clase</div>
                                        </th>
                                        <!-- <th scope="col">
                                            <div class="d-flex align-items-center"><span class="material-symbols-outlined me-2"> connecting_airports </span>Tipo</div>
                                        </th> -->
                                        <th scope="col">
                                            <div class="d-flex align-items-center"><span class="material-symbols-outlined me-2"> flight </span>Ruta</div>
                                        </th>
                                        <th scope="col">
                                            <div class="d-flex align-items-center"><span class="material-symbols-outlined me-2"> attach_money </span>Precio</div>
                                        </th>
                                    </tr>
                                </thead>
                                
                                <tbody class="table-group-divider text-left">
                                    <tr>
                                        <td class="fw-bold"><?= $_POST["fecha"] ?></td>
                                        <td class="text-primary fw-bold fs-5"><?= $_POST["clase"] ?></td>
                                        <!-- <td class="text-uppercase fw-bold"><? //$_POST["tipo"] == "ida" ? "Solo Ida" : "Con retorno"  ?></td> -->
                                        <td><?= $_POST["ruta_orig"]."-".$_POST["ruta_ret"] ?></td>
                                        <td class="fw-bold text-success">$ <?= $_POST["precio"] ?></td>
                                    </tr>
                                    <?php if ($_POST["clase_r"] != "") { ?>
                                        <tr>
                                            <td class="fw-bold"><?= $_POST["fecha_r"] ?></td>
                                            <td class="text-primary fw-bold fs-5"><?= $_POST["clase_r"] ?></td>
                                            <!-- <td class="text-uppercase fw-bold"><? //$_POST["tipo"] == "ida" ? "Solo Ida" : "Con retorno"  ?></td> -->
                                            <td><?= $_POST["ruta_ret"]."-".$_POST["ruta_orig"] ?></td>
                                            <td class="fw-bold text-success">$ <?= $_POST["precio_r"] ?></td>
                                        </tr>
                                    <?php }  ?>
                                </tbody>
                            </table>
                        </div>

                        <h5 class="fw-bold text-end me-4">Monto Total: <span class="text-success">$<?= $montoTotal ?></span></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <script>
        function validar() {
            return $("#form_datos_usuario").validate();
        }
    </script>
</body>

<?php //$conn = null; //Cierra la conexion con la base de datos ?>