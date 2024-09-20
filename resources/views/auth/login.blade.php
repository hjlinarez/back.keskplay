<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>KeskPlay - Login</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header text-center">
                                        <img class="img img-fluid" src="https://keskplay.com/assets/img/logo_keskplay.png?1" alt="" style="height: 12em">
                                        </div>
                                    <div class="card-body">
                                        <form action="login" method="POST" name="formLogin" id="formLogin">
                                            @csrf
                                            
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="email" name="email" type="text" placeholder="Email" />
                                                <label for="usuario">Email</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password" name="password" type="password" placeholder="Clave" />
                                                <label for="clave">Clave</label>
                                            </div>

                                            
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Recordar</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                
                                                <button id="btnVerifyUser" type="button" class="btn btn-primary" onclick="existeUser();">Ingresar</button>
                                                
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; KeskPlay.com 2024</div>
                            <div>
                                <a href="#">Politicas de privacidad</a>
                                &middot;
                                <a href="#">Terminos y Condiciones</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>


        <script>
            function existeUser()
            {
                let email = document.querySelector("#email").value;
                let password = document.querySelector("#password").value;
                

                document.querySelector("#btnVerifyUser").disabled=true;
                
                //var token = document.querySelector("input[name='_token']").value;
                
                

                var url = "verificarUsuario";
                var data = { 
                                email: email, 
                                password: password 
                            };

                fetch(url, {
                    headers:{
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            method:'POST',
                            body: JSON.stringify(data)
                            }
                        )
                    .then(response => response.json())
                    .then(function(result){
                            if (result.cod == 200)
                            {
                                document.querySelector("#formLogin").submit();
                            }
                            else{
                                
                                swal("Lo siento!", "Estos datos no han sido encontrados!", "error")
                                    .then((value) => {
                                                    document.querySelector("#btnVerifyUser").disabled=false;
                                                }
                                    );

                                //swal("Lo siento!", "Estos datos no han sido encontrados!", "error");
                                //document.querySelector("#btnVerifyUser").disabled=false;
                            }
                            
                        })
                    .catch(function (error) {
                            document.querySelector("#btnVerifyUser").disabled=false;
                            console.log(error);
                    });

                
                //alert(user);
                //document.querySelector("#formLogin").submit();
            }
        </script>
    </body>
</html>
