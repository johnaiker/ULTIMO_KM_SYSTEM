
<body>
<?php

include_once("includes/header.php");

session_start();
?>
 
<body style="margin: 0 auto; padding: 0; background-color: #e1e1e1;">
 <nav class="navbar bg-primary" data-bs-theme="dark">
        <div class="container">
            <h4 class="h1 my-2 text-uppercase" style="color: white; font-weight: bold; margin-left: 5rem"><i class="bi bi-airplane-engines-fill"></i> Km airlines</h4>
        </div>
    </nav>
    <main>
        <div class="container card my-5 mx-auto" style="max-width: 800px">
            <div class="card-body text-center">
                <span class="ms-2 material-symbols-outlined text-success" style="font-size: 5rem;">verified</span>
                <h4 class="fs-3 text-center d-flex align-items-center justify-content-center"><span class="fs-1 material-symbols-outlined me-3">other_admission</span>Resumen de la reserva </h4> 
                <hr class="my-2">

                <div class="p-2 mt-3 w-75 mx-auto" style="border: 1px solid #e1e1e1; border-radius: 6px">
                    <div>
                        <h4 class="fs-4 mt-3 d-flex align-items-center justify-content-center"><span class="fs-3 material-symbols-outlined me-3">airplane_ticket</span>Vuelo</h4>
                        <hr class="my-2 mx-auto w-50 ">
                        <p class="mb-1">Nombre: <span class="fw-bold"><?= "Juan peña" ?></span></p>
                        <p class="mb-1">Fecha de nacimiento: <span class="fw-bold"><?= "Juan peña" ?></span></p>
                        <p class="mb-1">Correo: <span class="fw-bold"><?= "Juan peña" ?></span></p>
                        <p class="mb-1">Cedula: <span class="fw-bold"><?= "Juan peña" ?></span></p>
                        <p class="mb-1">Telefono: <span class="fw-bold"><?= "Juan peña" ?></span></p>
                    </div>
                    <div>
                        <h4 class="fs-4 mt-3 d-flex align-items-center justify-content-center"><span class="fs-3 material-symbols-outlined me-3">account_box</span>Pasajero</h4>
                        <hr class="my-2 mx-auto w-50 ">
                        <p class="mb-1">Nombre: <span class="fw-bold"><?= "Juan peña" ?></span></p>
                        <p class="mb-1">Fecha de nacimiento: <span class="fw-bold"><?= "Juan peña" ?></span></p>
                        <p class="mb-1">Correo: <span class="fw-bold"><?= "Juan peña" ?></span></p>
                        <p class="mb-1">Cedula: <span class="fw-bold"><?= "Juan peña" ?></span></p>
                        <p class="mb-1">Telefono: <span class="fw-bold"><?= "Juan peña" ?></span></p>
                    </div>
                    <div>
                        <h4 class="fs-4 mt-3 d-flex align-items-center justify-content-center"><span class="fs-3 material-symbols-outlined me-3">payment</span>Pago</h4>
                        <hr class="my-2 mx-auto w-50 ">
                        <p class="mb-1">Tarjeta: <span class="fw-bold"><?= "Juan peña" ?></span></p>
                        <p class="mb-1">Fecha de Vencimiento: <span class="fw-bold"><?= $_SESSION["vuelo_info"]["precio"] ?> </span></p>
                        <p class="mb-1">Monto: <span class="fw-bold">$ <?= $_SESSION["vuelo_info"]["precio"] ?></span></p>
                    </div>
                </div>
                <button class="text-center fw-bold btn btn-large btn-outline-primary mt-4 mx-auto" style="width: 200px" onclick="location = 'index.php'"> Salir</button>
            </div>
        </div>
    </main>
</body>
</html>