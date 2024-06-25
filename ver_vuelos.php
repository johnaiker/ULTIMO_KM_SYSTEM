
<?php

//Incluir un archivo de PHP (archivo de base de datos); 

include 'includes/header.php'; // Incluir Archivo de PHP
// $servername = "localhost";
// $username = "root";
// $password = "246678";

session_start();

$ruta = ''; // Ruta de ida 
$rutaRet = ''; // Ruta de ida 
$oneway = true; // Variable que se usa para saber si es solo ida o ida y vuelta

// Concatenar la ruta de ida con la ruta de destino, para comprobar si hay vuelos en esa ruta
if(!empty($_GET['ruta_ida']) && !empty($_GET['ruta_ret'])) {
    $ruta = $_GET['ruta_ida'] . $_GET['ruta_ret'];
    $rutaRet = $_GET['ruta_ret'] . $_GET['ruta_ida'] ;
}

// Conectar con la Base de Datos
$sql = "SELECT * FROM itinerario_vuelos WHERE ruta='". $ruta ."'"; // Query de Consulta donde se trae data cuando la ruta coincide

$result = $conn->query($sql);
// $destinos = [];

//Ver si el viaje es ida y vuelta
if(!empty($_GET['flight_type'])) { 
    if ($_GET['flight_type'] == "fullway") { 
        $oneway = false;
        
        $sql = "SELECT * FROM itinerario_vuelos WHERE ruta='". $rutaRet ."'"; // Query de Consulta donde se trae data cuando la ruta coincide

        // echo $sql;
        $resultRet = $conn->query($sql);

        // $row;

    }
}

// if ($result->num_rows > 0) {
//   // output data of each row
//   while($row = $result->fetch_assoc()) {
//     echo "Clase: " . $row["clase"]. " - dias de vuelo: " . $row["fecha"]."<br>";
//     // print_r(explode(',',$row['destinos']));
//   }
// } else {
//   echo "0 results";
// }

// // Create connection
// $conn = new mysqli($servername, $username, $password);

// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";
?>

<body style="margin: 0 auto; padding: 0; background-color: #e1e1e1;">
    <style>
        .selected, .selected_ret {
            background-color: #d4ffbb80!important;
        }
    </style>
<?php

    if (!empty($_GET['flight_type']) && !empty($_GET['ruta_ida']) && !empty($_GET['ruta_ret']) && !empty($_GET['fecha_ida']) && !empty($_GET['fecha_ret'])) { 
        $flighttype = $_GET['flight_type'];
        $ruta_ida = $_GET['ruta_ida'];
        $ruta_ret = $_GET['ruta_ret'];
        $fecha_ida = $_GET['fecha_ida'];
        $fecha_ret = $_GET['fecha_ret'];
    } else {
        $flighttype = $_GET['flight_type'];
        $ruta_ida = $_GET['ruta_ida'];
        $ruta_ret = $_GET['ruta_ret'];
        $fecha_ida = $_GET['fecha_ida'];
        $fecha_ret = "";
    }

    

    // echo '<pre>';
    // var_dump($_SESSION);
    // echo '</pre>';


?>
    <nav class="navbar bg-primary" data-bs-theme="dark">
        <div class="container">
            <h4 class="h1 my-2 text-uppercase" style="color: white; font-weight: bold; margin-left: 5rem"><i class="bi bi-airplane-engines-fill"></i> Km airlines</h4>
        </div>
    </nav>
    <div class="container py-5">
        <div class="card py-4 mt-6 mx-auto text-center" >
            <h4 class="fs-3 fw-bold text-uppercase text-center mb-3">Seleccionar vuelo</h4>
            <hr class="my-2 mx-3 text-black">

            <form id="form_reservar" action="reservar_vuelo.php" method="POST" >
                <!-- reservar_vuelo.php -->
                <div class="card-body ">
                    <h3 class="fs-3 text-left"> <span class="fs-1 material-symbols-outlined me-2"> flight_takeoff </span> Vuelos de Ida: <span style="font-size: 0.8rem; font-weight: light!important;"><?= $fecha_ida ?></span></h3>
                    <div class="row mt-4">
                        <?php if ($result->num_rows > 0) {
                            $i = 0;
                            while ($row = $result->fetch_assoc()) {

                        ?> 
                        
                        <div class="col">
                            <div onclick="Cotizar(<?= $row['fecha'] == $_GET['fecha_ida'] ? '\''.$row['fecha'].'\',\''.$row['clase'].'\',\'ida\',\''.$row['precio'].'\',\''.$row['asientos'].'\'' : ''?>)"
                             class="card mx-auto  p-3 <?= $row['fecha'] != $_GET['fecha_ida'] ? 'bg-black-50 text-body-tertiary' : 'card_select_vuelo' ?>" style="<?= $row['fecha'] != $_GET['fecha_ida'] ? '' : 'cursor: pointer' ?>" id="card_ida_<?= $row['clase']?>">
                                <?php if($row['fecha'] != $_GET['fecha_ida'] ) {
                                ?>
                                    <div class="fw-bold text-danger">Fuera de la fecha seleccionada</div>
                                <?php } ?>
                                <div class="card-body">
                                    <h3 class="fs-5 text-primary">CLASE <?= $row['clase']?></h3>
                                    <h3 class="h6">FECHA: <?= $row['fecha']; ?></h3>
                                    <h3 class="h6">Hora: <?= $row['hora']; ?></h3>
                                    <h3 class="fs-5 text-success">$<?= $row['precio']; ?></h3>
                                    <p>Asientos disponibles: <?= $row['asientos']; ?></p>
                                </div>
                            </div>
                        </div>
                            <?php
                                $i++;
                                }
                                } else { ?>
                            <div class="card mx-auto">
                                <div class="card-body alert alert-danger">
                                    <h4 class="h4" >NO HAY VUELOS DISPONIBLES PARA LA FECHA SELECCIONADA</h4>
                                </div>
                            </div>
                            <?php } ?>
                    </div>

                    <?php if(!$oneway) {
                    ?>
                            
                    <hr class="my-4">
                            <!-- <div class="mt-6">_</div> -->
                    <h3 class="mb-4 h3 text-left" style="color: black"> <span class="fs-1 material-symbols-outlined me-2"> flight_land </span> Vuelos de Retorno: <span style="font-size: 0.9rem; font-weight: light!important;"><?= $fecha_ret ?></span></h3>

                    <?php if ($resultRet->num_rows > 0) { ?>
                        <?php
                            while ($row = $resultRet->fetch_assoc()) {

                        ?> 
                        <div onclick="CotizarRet(<?= $row['fecha'] == $_GET['fecha_ret'] ? '\''.$row['fecha'].'\',\''.$row['clase'].'\',\'ret\',\''.$row['precio'].'\',\''.$row['asientos'].'\'' : ''?>)"

                        class="p-3 card d-inline-block mx-auto  <?= $row['fecha'] != $_GET['fecha_ret'] ? 'bg-black-50 text-body-tertiary' : 'card_select_vuelo' ?>" style="<?= $row['fecha'] != $_GET['fecha_ret'] ? '' : 'cursor: pointer' ?>" id="card_ret_<?= $row['clase']?>">
                        
                            <?php if($row['fecha'] != $_GET['fecha_ret'] ) {

                            ?>
                                <div class="" style="font-weight: bold; color: red">Fuera de la fecha seleccionada</div>
                            <?php } ?>
                            <div class="card-body">
                                
                            <h3 class="fs-2 text-primary">CLASE <?= $row['clase']; ?></h3>
                            <h3 class="h6">FECHA: <?= $row['fecha']; ?></h3>
                            <h3 class="h6">Hora: <?= $row['hora']; ?></h3>
                            <h3 class="fs-5 text-success">$<?= $row['precio']; ?></h3>
                            <p>Asientos disponibles: <?= $row['asientos']; ?></p>
                            </div>
                        </div>
                        <?php
                            } ?>

                            <input type="text" class="d-none" id="active_return_class" name="active_return_class" value="">

                        <?php } else { ?>
                        <div class="card mx-auto">
                            <div class="card-body alert alert-danger">
                                <h4 class="h4">NO HAY VUELOS DISPONIBLES PARA LA FECHA SELECCIONADA</h4>
                            </div>
                        </div>
                        <?php } } ?>
                    <div class="col mt-4">
                        <button class="btn btn-outline-secondary me-4  btn-lg" onclick="location = './index.php'"> Volver</button>
                        <button type="submit"  class="btn btn-primary  btn-lg"> Continuar</button>
                    </div>
                </div>
                <input required id="fecha" name="fecha" value="" type="text" class="hidden"></input>
                <input required id="clase" name="clase" value="" type="text" class="hidden"></input>
                <input required id="tipo" name="tipo" value="" type="text" class="hidden"></input>
                <input required id="precio" name="precio" value="" type="text" class="hidden"></input>
                <input required id="asientos" name="asientos" value="" type="text" class="hidden"></input>
                
                <input id="fecha_r" name="fecha_r" value="" type="text" class="hidden"></input>
                <input id="clase_r" name="clase_r" value="" type="text" class="hidden"></input>
                <input id="tipo_r" name="tipo_r" value="" type="text" class="hidden"></input>
                <input id="precio_r" name="precio_r" value="" type="text" class="hidden"></input>
                <input id="asientos_r" name="asientos_r" value="" type="text" class="hidden"></input>

                <input required id="ruta_orig" name="ruta_orig" value="<?= $ruta_ida ?>" type="text" class="hidden"></input>
                <input required id="ruta_ret" name="ruta_ret" value="<?= $ruta_ret ?>" type="text" class="hidden"></input>
                <input required id="flight_type" name="flight_type" value="<?= $ruta_ida ?>" type="text" class="hidden"></input>
            </form>
        </div>
    </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>    
        function Cotizar(fecha, clase, tipo, precio, asientos) {
            // console.log("A cotizar xdxd")
                console.log("Creando reserva.... ", fecha, clase, tipo, precio, asientos);
                if (!fecha) {
                    return;
                }
                // debugger;
                $(".selected").removeClass("selected");
            try {
                $("#fecha").val(fecha);
                $("#clase").val(clase);
                $("#tipo").val(tipo);
                $("#precio").val(precio);
                $("#asientos").val(asientos);

                $(`#card_ida_${clase}`).addClass("selected");

                active_class = $("#active_return_class");
                if (active_class) {
                    active_class.val(clase);
                }
                
                active_r_class = $("#active_return_class");
                if (active_r_class) {
                    active_r_class.val(clase);
                }
                console.log("Creando reserva.... ");

                
                // if(active_r_class && ) {

                // }
                // $("#form_reservar").submit();
            } catch (error) {
                console.log("Error en el POST: ", error);
            }
        }
        
        function CotizarRet(fecha, clase, tipo, precio, asientos) {
                console.log("Creando reserva.... ", fecha, clase, tipo, precio, asientos);
                if (!fecha) {
                    return;
                }
                $(".selected_ret").removeClass("selected_ret");
            try {
                $("#fecha_r").val(fecha);
                $("#clase_r").val(clase);
                $("#tipo_r").val(tipo);
                $("#precio_r").val(precio);
                $("#asientos_r").val(asientos);

                $(`#card_ret_${clase}`).addClass("selected_ret");

                // active_class = $("#active_class");
                // if (active_class) {
                //     active_class.val(clase);
                // }
                
                active_r_class = $("#active_return_class");
                if (active_r_class) {
                    active_r_class.val(clase);
                }
                console.log("Creando reserva.... ");

                
                // if(active_r_class && ) {

                // }
                // $("#form_reservar").submit();
            } catch (error) {
                console.log("Error en el POST: ", error);
            }
        }
    </script>


</body>

</html>

<?php 

//$conn = null; //Cierra la conexion con la base de datos ?>
