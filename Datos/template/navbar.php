<!-- Barra navegable-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">

        <!--Logo-->
        <a class="navbar-brand" href="#">
            <img src="../images/logo.png" alt="logo" width="85px">
        </a>

        <!--Botón responsive-->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <!--Item de menú con link active-->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="cliente.php">Cliente</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="pago.php">Pago</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="inmuebles.php">Inmuebles</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="proyectos.php">Proyectos</a>
                </li>

                <!--Menú desplegable-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Reportes
                    </a>

                    <!--item del menú desplegable-->
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="reporteDeuda.php">Reporte clientes (Deuda)</a></li>
                        <li><a class="dropdown-item" href="reporteProyectoMasDeuda.php">Reporte de proyecto que más deben</a></li>
                        <li><a class="dropdown-item" href="reporteProyectoCliente.php">Reporte proyecto que más deben por cliente</a></li>
                        <li><a class="dropdown-item" href="reporteClienteInmueble.php">Reporte Deuda de cliente por inmueble</a></li>
                    </ul>
                </li>
            </ul>

            <form class="d-flex" action="logout.php" method="post">
                <button class="btn btn-outline-danger" type="button" onclick="location.href='../index.php'">Log out</button>
            </form>

        </div>
    </div>
</nav>