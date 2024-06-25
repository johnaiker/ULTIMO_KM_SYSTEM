
<?php

include 'includes/header.php'; // Incluir Archivo de PHP

$sql = "SELECT * FROM rutas";
$result = $conn->query($sql);
$destinos = [];

$results_refs =& $result; // Creacion de una referencia(similar a un puntero), 
//esto nos sera util porque podremos usar el valor de lo traido en la base de
// datos sin modificar a la variable original

// y asi poder leer sus valores

if ($result->num_rows > 0) {
  // Ciclo while para cada dato traido de la Base de datos.
  while($row = $results_refs->fetch_assoc()) {
    // echo "origen: " . $row["origen"]. " - dias de vuelo: " . $row["dias_vuelo"]."<br>";
    // print_r(explode(',',$row['destinos']));
  }
} else {
  echo "0 results";
}

session_start();

// // Create connection
// $conn = new mysqli($servername, $username, $password);

// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";

?>

<body style="margin: 0 auto; padding: 0; background-color: #e1e1e1;">
<?php
$rutas = ["Caracas" => "CCS", "Maracaibo" =>  "MCB", "Barquisimeto" =>  "BRM", "Puerto Ordaz" =>  "PZO"];

// $rutasDisponibles = array(
//     array("fecha" => "01/05/2024", "ruta" => "CCS", "asientos" => 4),
//     array("fecha" => "01/05/2024", "ruta" => "BRM", "asientos" => 0),
//     array("fecha" => "01/05/2024", "ruta" => "BAR", "asientos" => 3),
//     array("fecha" => "01/05/2024", "ruta" => "MCB", "asientos" => 6),
//     array("fecha" => "15/04/2024", "ruta" => "CCS", "asientos" => 5),
//     array("fecha" => "11/04/2024", "ruta" => "BRM", "asientos" => 7),
//     array("fecha" => "16/04/2024", "ruta" => "BAR", "asientos" => 7),
// );

$disponibles = 12;
function buscarVuelosDisp($rutaIda, $rutaVuelta, $tipoVuelo, $fechaIda, $fechaVuelta) {

    $rutasDisponibles = array(
        array("fecha" => "01/05/2024", "ruta" => "CCS", "asientos" => 4),
        array("fecha" => "01/05/2024", "ruta" => "BRM", "asientos" => 0),
        array("fecha" => "01/05/2024", "ruta" => "BAR", "asientos" => 3),
        array("fecha" => "01/05/2024", "ruta" => "MCB", "asientos" => 6),
        array("fecha" => "15/04/2024", "ruta" => "CCS", "asientos" => 5),
        array("fecha" => "11/04/2024", "ruta" => "BRM", "asientos" => 7),
        array("fecha" => "16/04/2024", "ruta" => "BAR", "asientos" => 7),
    );
    
    if($tipoVuelo == "fullway") {
        foreach ($rutasDisponibles as $ruta) {
            echo"EL pepe".$ruta["fecha"];
            # code...
        }
    } else {
        // foreach ($rutasDisponibles as list($a, $b)) {
        //     # code...
        // }
    }
    // if (filter_var($entrada, FILTER_VALIDATE_INT) !== false) {
    //     echo "Ha ingresado un valor de tipo Int\n";
    // } elseif (filter_var($entrada, FILTER_VALIDATE_BOOLEAN) !== false) {
    //     echo "Ha ingresado un valor de tipo Bool\n";
    // } else {
    //     echo "Ha ingresado un valor de tipo String\n";
    // }
}

if (!empty($_GET['flight_type']) && !empty($_GET['ruta_ida']) && !empty($_GET['ruta_ret']) && !empty($_GET['fecha_ida']) && !empty($_GET['fecha_ret'])) { 
    $flighttype = $_GET['flight_type'];
    $ruta_ida = $_GET['ruta_ida'];
    $ruta_ret = $_GET['ruta_ret'];
    $fecha_ida = $_GET['fecha_ida'];
    $fecha_ret = $_GET['fecha_ret'];
    buscarVuelosDisp($flighttype, $ruta_ida, $ruta_ret, $fecha_ida, $fecha_ret);
}
?>
    <nav class="navbar bg-primary" data-bs-theme="dark">
        <div class="container">
            <h4 class="h1 my-2 text-uppercase" style="color: white; font-weight: bold; margin-left: 5rem"><i class="bi bi-airplane-engines-fill"></i> Km airlines</h4>
        </div>
    </nav>
    
    <div class="banner d-flex align-items-center justify-content-center" style="position: relative;">
        <div class="d-flex align-items-center justify-content-center" style="width: 100%;">
            <img src="./img/airline_banner.jpg" alt="Banner_aerolinea" style="width: 100%; max-height: 600px; filter: brightness(50%);">
        </div>
        <div class="container py-5" style="position: absolute; bottom: -8rem; left: 0; right: 0">
            <div class=" py-4 mt-6 mx-auto text-center" >
                <h4 class="fs-1 mb-5 text-light text-uppercase fw-bold">Seleccionar vuelo</h4>
                <!-- <hr class="my-3 mx-3"> -->
                <div class="card" style="box-shadow: -4px 14px 75px -28px rgba(0,0,0,0.75);">
                    <form class="card-body" id="search_flights" action="./ver_vuelos.php" method="GET">
                        <div class="p-3 card mx-auto" style="max-width: 300px;">
                            <div class="row justify-content-space-between align-items-center">
                                <div class="col-6">
                                    <input class="form-check-input" type="radio" name="flight_type" id="exampleRadios1" value="fullway" checked>
                                    <label class="form-check-label" for="exampleRadios1"> Con retorno </label>
                                </div>
                                <div class="col-6">   
                                    <input class="form-check-input" type="radio" name="flight_type" id="exampleRadios2" value="oneway" >
                                    <label class="form-check-label" for="exampleRadios2"> Solo ida </label>
                                </div>
                            </div>
                        </div>
                        <div class="row m-2 align-items-center justify-content-center p-4" style="border: 1px solid #00000054; border-radius: 10px; ">
                            <div class="mt-2 col-md-2" style="text-align: left">
                                <label for="ruta_ida" class="form-check-label pb-2 pl-2"><span class="material-symbols-outlined">flight_takeoff</span> Ruta de Origen </label>

                                <select required name="ruta_ida" class="py-2 form-control form-select" aria-label="Disabled select" id="ruta_ida">
                                    
                                    <option selected value="">Seleccione</option>
                                    <?php
                                        foreach ($rutas as $ruta => $i) {
                                    ?>

                                        <option class="fw-bold text-dark" value="<?= $i ?>"><?= $ruta ?></option>
                                    <?php } ?>
                                    <!-- <option value="2">Two</option>
                                    <option value="3">Three</option> -->
                                </select>
                            </div>
                            <div class="mt-2 col-md-2" style="text-align: left" id="ruta_retorno">
                                <label for="ruta_ret" class="form-check-label pb-2 pl-2"> <span class="material-symbols-outlined">flight_land</span> Ruta Destino</label>

                                <select required class="form-control form-select" name="ruta_ret" aria-label="Disabled select" id="ruta_ret">
                                    
                                    <option selected value="">Seleccione</option>
                                    <?php
                                        foreach ($rutas as $ruta  => $i) {
                                    ?>

                                    <option class="fw-bold text-dark" value="<?= $i ?>"><?= $ruta ?></option>
                                    <?php } ?>
                                    <!-- <option value="2">Two</option>
                                    <option value="3">Three</option> -->
                                </select>
                            </div>
                            <div class="col text-start">
                                <div class="row align-items-end">
                                    <div class="col my-2">
                                        <div class="">
                                            <label for="fecha_ida" class="form-check-label pb-2 pl-2"><i class="bi bi-calendar"></i> fecha de Ida </label>
                                            <input  required name="fecha_ida" type="text" placeholder="yyyy-mm-dd" class="form-control fecha_input" id="fecha_ida" >
                                        </div>
                                    </div>
                                    <div class="col my-2" >
                                        
                                        <div class="" id="fecha_retorno">
                                            <label for="fecha_ret" class="form-check-label pb-2 pl-2"><i class="bi bi-calendar"></i> fecha retorno </label>
                                            <input required name="fecha_ret" type="text" placeholder="yyyy-mm-dd" class="form-control fecha_input" id="fecha_ret" >
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-2">
                                <button type="submit"  class="btn btn-primary mt-4 btn-lg"><i class="bi bi-search"></i> Buscar</button>
                            </div>
                        </div>
                    </form>


                <!-- <div class="form-check">

                </div> -->
                </div>
                <div class="row p-3" id="error_message" style="display: none">
                    <div class="col-12 ">
                        <div class="d-inline-block alert alert-danger fs-4 fw-bold">
                            <span id="message"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="./main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>

    <script>
        
        // $("#error_message").fadeOut()
        $("#error_message").fadeOut()
        $("#message").text("")

        $("#ruta_retorno").change((e) => {
            if (e.target.value == $("#ruta_ida").val()) {
                e.target.value = "";
                // $("#error_message").removeClass("hidden")
                $("#message").text("No puede coincidir la ruta de ida con la de retorno")
                
                $("#error_message").fadeIn().fadeOut(6000)
            } else {
                
                $("#error_message").fadeOut()
                $("#message").text("")
            }
        });

        $("#ruta_ida").change((e) => {
            if (e.target.value == $("#ruta_retorno").val()) {
                e.target.value = "";
                $("#error_message").fadeIn().fadeOut(6000)
                $("#message").text("No puede coincidir la ruta de ida con la de retorno")
            } else {
                
                $("#error_message").fadeOut()
                $("#message").text("")
            }
        })
        $('input[name="flight_type"]').change((e) => {
            // console.log(e.target)
            if(e.target.value == "oneway" ) {
                $("#fecha_retorno").addClass("hidden");
                $("#fecha_ret").removeAttr( "required" )
                $("#fecha_ret").val("")
            } else {
                $("#fecha_retorno").removeClass("hidden");
            }
        });

    </script>
</body>

</html>
