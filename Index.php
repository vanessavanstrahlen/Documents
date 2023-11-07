<!DOCTYPE html>
<html lang="en">

<body>

    <head>
        <meta charset="UTF-8">
        <title>DOCUMENTOS</title>
        <link rel="stylesheet" href="public/css/bootstrap.min.css">
        <link rel="stylesheet" href="public/css/style.css">
        <!--favicon-->
        <link rel="icon" src="public/images/document.png">
        <script src="public/js/axios.min.js"></script>
    </head>


    <!-- Inicio del contenido de la página-->

    <div id="root">

        <nav class="navbar navbar-expand-lg navbar-dark" v-show="Logueado">
            <a class="navbar-brand" href="#"><img src="public/images/logo.png" alt="vue.js logo"
                    class="logo-custom">ue.js</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <button class="btn btn-info" @click="showingaddModal = true;">Agregar registro</button>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="">Salir<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </nav>


        <!-- Login modal -->
        <div class="modal col-md-6" id="loginModal" v-if="showingLoginModal" style="height: 450px;">
            <div class="modal-head">
                <p class="p-left p-2">Iniciar Sesión</p>
                <hr />
                <div class="alert alert-danger alert-dismissible col-md-12 text-center" id="alertMessage" role="alert"
                    v-if="errorMessageLogin != ''">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ errorMessageLogin }}
                </div>


                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="username">Usuario</label>
                        <input type="text" id="username" class="form-control" v-model="newlogin.USUARIO" required>

                        <label for="password">Contraseña</label>
                        <input type="password" id="password" class="form-control" v-model="newlogin.PASSWORD" required>
                    </div>

                    <hr />
                    <button type="button" class="btn btn-success"
                        @click="showingLoginModal = false; login();">Ingresar</button>

                </div>
            </div>
        </div>




        <div class="container p-5">
            <div class="row">

                <div class="alert alert-danger alert-dismissible col-md-12 text-center" id="alertMessage" role="alert"
                    v-if="errorMessage != ''">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ errorMessage }}
                </div>

                <div class="alert alert-success alert-dismissible col-md-12 text-center" id="alertMessage" role="alert"
                    v-if="successMessage != ''">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ successMessage }}
                </div>
                <div class="input-group mb-3" v-show="Logueado">
                    <input type="text" v-model="limpiartext" class="form-control" placeholder="Buscar documentos"
                        aria-label="Buscar documentos" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button @click="filtrarData" class="btn btn-outline-secondary" type="button">Buscar</button>
                        <button @click="resetearTable" class="btn btn-secondary" type="button">Restaurar</button>
                    </div>
                </div>

                <!-- Tabla de registros de documentos -->
                <table id="myTable" class="table table-striped" v-show="Logueado">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre documento</th>
                            <th>Tipo</th>
                            <th>Proceso</th>
                            <th>Código documento</th>
                            <th>Contenido</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-custom">
                        <tr v-for="documentsAux in documents">
                            <td class="d-none">{{documentsAux.DOC_ID}}</td>
                            <td>{{documentsAux.DOC_NOMBRE}}</td>
                            <td class="d-none">{{documentsAux.DOC_ID_TIPO}}</td>
                            <td>{{documentsAux.TIP_NOMBRE}}</td>
                            <td class="d-none">{{documentsAux.DOC_ID_PROCESO}}</td>
                            <td>{{documentsAux.PRO_NOMBRE}}</td>
                            <td>{{documentsAux.DOC_CODIGO}}</td>
                            <td>{{documentsAux.DOC_CONTENIDO}}</td>
                            <td><button @click="showingeditModal = true; selectDocuments(documentsAux);"
                                    class="btn btn-warning">Editar</button></td>
                            <td><button @click="showingdeleteModal = true; selectDocuments(documentsAux);"
                                    class="btn btn-danger">Eliminar</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Agregar registro modal -->
        <div class="modal col-md-6" id="addmodal" v-if="showingaddModal">
            <div class="modal-head">
                <p class="p-left p-2">Agregar registro</p>
                <hr />

                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="uname">Nombre documento</label>
                        <input type="text" id="uname" class="form-control" v-model="newDocuments.DOC_NOMBRE">

                        <label for="conten">Contenido</label>
                        <input type="text" id="conten" class="form-control" v-model="newDocuments.DOC_CONTENIDO">

                        <label for="tipo">Tipo</label>
                        <select id="tipo" class="form-control" v-model="newDocuments.DOC_ID_TIPO">
                            <option value="">Selecciona un tipo</option>
                            <option v-for="tipo in tiposDocumentos" :value="tipo.TIP_ID">{{ tipo.TIP_NOMBRE }}</option>
                        </select>

                        <label for="proce">Proceso</label>
                        <select id="proce" class="form-control" v-model="newDocuments.DOC_ID_PROCESO">
                            <option value="">Selecciona un proceso</option>
                            <option v-for="proceso in procesos" :value="proceso.PRO_ID">{{ proceso.PRO_NOMBRE }}
                            </option>
                        </select>
                    </div>

                    <hr />
                    <button type="button" class="btn btn-success"
                        @click="showingaddModal = false; addDocuments();">Agregar
                    </button>
                    <button type="button" class="btn btn-danger" @click="showingaddModal = false;">Cerrar</button>
                </div>
            </div>
        </div>


        <!-- Editar registro modal -->
        <div class="modal col-md-6" id="editmodal" v-if="showingeditModal">
            <div class="modal-head">
                <p class="p-left p-2">Editar registro</p>
                <hr />

                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="uname">Nombre documento</label>
                        <input type="text" id="uname" class="form-control" v-model="clickedDocuments.DOC_NOMBRE">

                        <label for="phn">Contenido</label>
                        <input type="text" id="phn" class="form-control" v-model="clickedDocuments.DOC_CONTENIDO">

                        <label for="phn">Tipo</label>
                        <select id="tipo" class="form-control" v-model="clickedDocuments.DOC_ID_TIPO">
                            <option v-for="tipo in tiposDocumentos" :value="tipo.TIP_ID">{{ tipo.TIP_NOMBRE }}</option>
                        </select>

                        <label for="phn">Proceso</label>
                        <select id="proce" class="form-control" v-model="clickedDocuments.DOC_ID_PROCESO">
                            <option v-for="proceso in procesos" :value="proceso.PRO_ID">{{ proceso.PRO_NOMBRE }}
                            </option>
                        </select>
                    </div>

                    <hr />
                    <button type="button" class="btn btn-success"
                        @click="showingeditModal = false; updateDocuments();">Actualizar</button>
                    <button type="button" class="btn btn-danger" @click="showingeditModal = false;">Cerrar</button>
                </div>
            </div>
        </div>


        <!-- Eliminar registro data -->
        <div class="modal col-md-6" id="deletemodal" v-if="showingdeleteModal" style="height: 300px;">
            <div class="modal-head">
                <p class="p-left p-2">Eliminar registro</p>
                <hr />

                <div class="modal-body">
                    <center>
                        <p>¿Estás seguro de eliminar el registro?</p>
                        <h3>{{clickedDocuments.DOC_NOMBRE}}</h3>
                    </center>
                    <hr />
                    <button type="button" class="btn btn-danger"
                        @click="showingdeleteModal = false; deleteDocuments();">Yes</button>
                    <button type="button" class="btn btn-warning" @click="showingdeleteModal = false;">No</button>
                </div>
            </div>
        </div>

    </div>

    <!-- Scripts JavaScript -->

    <script src="public/js/jquery.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/vue.min.js"></script>
    <script src="public/js/app.js"></script>
</body>

</html>