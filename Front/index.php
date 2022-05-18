<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-expand navbar-dark bg-primary">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#">Home<span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="#">Home</a>
        </div>
    </nav>
    <br>
    <div class="container">

        <div class="card">
            <div class="card-header">
                Buzón de quejas
            </div>
            <div class="card-body">
                <h4 class="card-title">Calidad del Agua en Tuxtla Gutiérrez Chiapas</h4>
                <form action="" method="post">

                    <div class="row">
                        <div class="col">

                            <div class="form-group">
                                <label for="">Colonia</label>
                                <input type="text" name="idColonia" id="idColonia" class="form-control">

                            </div>

                        </div>
                        <div class="col">

                            <div class="form-group">
                                <label for="">Tipo mensaje</label>
                                <input type="text" name="idBuzon" id="idBuzon" class="form-control">
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Mensaje</label>
                        <input type="tecxt" name="queja" id="queja" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Fecha</label>
                        <input type="date" name="fecha" id="fecha" class="form-control">
                    </div>

                    <div class="btn-group" role="group">
                        <button id="btn-guardar" class="btn btn-success" type="button" onclick="guardar();">Agregar</button>
                        <button id="btn-actualizar" class="btn btn-warning" type="button" onclick="actualizar();" style="display:none" >Actualizar</button>
                        <button class="btn btn-secondary" type="button" onclick="limpiar();">Limpiar</button>
                    </div>

                    
                    

                </form>
            </div>
              
            <div class="card-footer">
                <div class="justify-content-center table-wrapper-scroll-x my-custom-scrollbar">
                    <table class="table table-bordered table-striped table-responsive" id="tabla-buzon"cellspacing="0" width="100%">
                        <thead class="thead-inverse">
                            <tr>
                                <th>ID</th>
                                <th>Colonia</th>
                                <th>Tipo queja</th>
                                <th>Fecha</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
    
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="js/controlador.js"></script>

</body>

</html>