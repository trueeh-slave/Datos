
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Recaudo</title>
    <!-- Bootstrap-->
    <link rel="stylesheet" href="css/login.css">  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
<form action="util/validar.php" method="post">
  <section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">

                  <div class="text-center">
                    <img src="images/logo.png" style="width: 185px;" alt="logo">
                    <h4 class="mt-1 mb-5 pb-1">We are Constructor Part Habilities</h4>
                  </div>

                  <form>
                    <p>Please login to your account</p>

                    <div class="form-outline mb-4">
                      <input  type="text" name="username" id="form2Example11" class="form-control" required placeholder="Ingresa el nombre de usuario" />
                      <label class="form-label" for="form2Example11">Username</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" name="password" id="form2Example22" class="form-control" required/>
                      <label class="form-label" for="form2Example22">Password</label>
                    </div>

                    <div class="text-center pt-1 mb-5 pb-1">
                      <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3 border-0" type="submit">Log in</button>
                    </div>

                  </form>

                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                  <h4 class="mb-4">Somos más que una Empresa.</h4>
                  <p class="small mb-0" style="text-align: justify;">¡Bienvenido a nuestra constructora de confianza! En Constructor Part Habilities, nos enorgullece ofrecer servicios de construcción de alta calidad y 
                    soluciones a medida para satisfacer las necesidades de nuestros clientes. Contamos con un equipo de profesionales altamente capacitados y comprometidos con la excelencia en cada etapa del proceso. Trabajamos estrechamente con nuestros clientes, 
                    convirtiendo sus visiones en realidad. ¡Contacta con nosotros para hacer realidad tus proyectos de construcción!</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>