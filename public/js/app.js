
// Inicialización de Vue.js

var app = new Vue({

	el: "#root",
	data: {  //Variables de datos y estado de la aplicación
		showingaddModal: false, // mostrar u ocultar modales en la interfaz de usuario
		showingeditModal: false, // mostrar u ocultar modales en la interfaz de usuario
		showingdeleteModal: false, // mostrar u ocultar modales en la interfaz de usuario
		showingLoginModal: true, // mostrar u ocultar modales en la interfaz de usuario
		errorMessage: "", //Variables para mostrar mensajes de error en la interfaz de usuario.
		errorMessageLogin: "",//Variables para mostrar mensajes de error en la interfaz de usuario.
		successMessage: "",
		documents: [], //Almacena los datos de los documentos recuperados del servidor.
		newDocuments: { DOC_NOMBRE: "", DOC_CODIGO: "", DOC_CONTENIDO: "", DOC_ID_TIPO: "", DOC_ID_PROCESO: "" }, //Almacena datos para agregar un nuevo documento.
		clickedDocuments: {}, //Almacena los datos del documento seleccionado para editar o eliminar.
		tiposDocumentos: [], // Datos de los tipos de documentos
		procesos: [], // Datos de los procesos
		selectTipo: "", // Valor seleccionado para Tipo
		selectProceso: "",// Valor seleccionado para Proceso
		Logueado: false, // Indica el estado de inicio de sesión. 
		newlogin: { USUARIO: "", PASSWORD: "" }, // Almacena datos de inicio de sesión.
		limpiartext: "", //Refrescar la barra de búsqueda de documentos
	},

	// se ejecutan acciones cuando Vue.js se monta en el DOM
	mounted: function () {
		console.log("Vue.js is running...");
		this.getAlltipos();
		this.getAllprocesos();
	},


	//Métodos 

	methods: {


		getAlldocuments: function () { //Obtiene datos de documentos del servidor.
			axios.get('http://localhost/Documents/App/Routes/ApiRoutes.php?action=read')
				.then(function (response) {

					if (response.data.error) {
						console.log('error')
						app.errorMessage = response.data.message;
					} else {
						app.documents = response.data;
					}
				})
		},

		filtrarData: function () {
			// Filtrar los datos basados en el texto de búsqueda
			if (this.limpiartext.toLowerCase() == "") {
				this.getAlldocuments();
			} else {
				this.documents = this.documents.filter(document => {
					return (
						document.DOC_NOMBRE.toLowerCase().includes(this.limpiartext.toLowerCase()) ||
						document.DOC_CODIGO.toLowerCase().includes(this.limpiartext.toLowerCase()) ||
						document.DOC_CONTENIDO.toLowerCase().includes(this.limpiartext.toLowerCase())
					);
				});
			}
		},

		resetearTable: function () { //Restaura la tabla a su estado original.
			this.limpiartext = "";
			this.getAlldocuments();
		},

		login: function () { //Realiza la autenticación de usuario y muestra mensajes de éxito o error.
			var formData = app.toFormData(app.newlogin);
			axios.post('http://localhost/Documents/App/Routes/ApiRoutes.php?action=login', formData) // la ruta
				.then(response => {

					app.newlogin = { USUARIO: "", PASSWORD: "" };

					if (response.data) {
						// Si el inicio de sesión fue exitoso
						this.Logueado = true;
						this.successMessage = 'Inicio de sesión exitoso.';
						this.getAlldocuments(); // Actualizar los documentos después del inicio de sesión
					} else {
						// Si el inicio de sesión falló
						this.errorMessageLogin = 'Usuario/Contraseña incorrecta.';
						this.Logueado = false;
						app.showingLoginModal = true;
					}
				})
				.catch(error => {
					console.error('Error en  inicio de sesión', error);
				});
		},

		updateDocuments: function () { //Actualiza los datos de un documento existente.
			var formData = app.toFormData(app.clickedDocuments);
			axios.post('http://localhost/Documents/App/Routes/ApiRoutes.php?action=update', formData)
				.then(function (response) {
					app.clickedDocuments = {};
					if (response.data != null) {
						app.errorMessage = 'Error';
					} else {
						app.successMessage = 'Registro actualizado correctamente.';
						app.getAlldocuments();
						app.resetearTable();
					}
				});
		},

		deleteDocuments: function () { //Elimina un documento.
			var formData = app.toFormData(app.clickedDocuments);
			axios.post('http://localhost/Documents/App/Routes/ApiRoutes.php?action=delete', formData)
				.then(function (response) {
					app.clickedDocuments = {};
					this.limpiartext = "";
					if (response.data != null) {
						app.errorMessage = 'Error';
					} else {
						app.successMessage = 'Registro eliminado correctamente.';
						app.getAlldocuments();
						app.resetearTable();
					}
				})
		},

		addDocuments: function () { //Agrega un nuevo documento.
			var formData = app.toFormData(app.newDocuments);
			axios.post('http://localhost/Documents/App/Routes/ApiRoutes.php?action=create', formData)
				.then(function (response) {
					app.newDocuments = { DOC_NOMBRE: "", DOC_CODIGO: "", DOC_CONTENIDO: "", DOC_ID_TIPO: "", DOC_ID_PROCESO: "" };
					this.limpiartext = "";
					if (response.data != null) {
						app.errorMessage = 'Error';
					} else {
						app.successMessage = 'Registro agregado correctamente.';
						app.getAlldocuments();
						app.resetearTable();
					}
				});
		},



		getAlltipos: function () { //Obtiene datos de tipos de documentos desde el servidor.

			axios.get('http://localhost/Documents/App/Routes/ApiRoutes.php?action=consultartipos')
				.then(function (response) {


					if (response.data.error) {
						console.log('error')
						app.errorMessage = response.data.message;
					} else {
						app.tiposDocumentos = response.data;
						console.log(app.tiposDocumentos);
					}
				})
		},

		getAllprocesos: function () { //Obtiene datos de procesos de documentos desde el servidor.
			axios.get('http://localhost/Documents/App/Routes/ApiRoutes.php?action=consultarprocesos')
				.then(function (response) {

					if (response.data.error) {
						console.log('error')
						app.errorMessage = response.data.message;
					} else {
						app.procesos = response.data;
					}
				})
		},



		selectDocuments(Documents) {
			app.clickedDocuments = Documents;
			app.selectTipo = Documents.DOC_ID_TIPO;
			app.selectProceso = Documents.DOC_ID_PROCESO;
		},

		//Convierte un objeto en un formulario FormData
		toFormData: function (obj) {
			var form_data = new FormData();
			for (var key in obj) {
				form_data.append(key, obj[key]);
			}
			return form_data;
		},
		//Limpia los mensajes de error y éxito.
		clearMessage: function (argument) {
			app.errorMessage = "";
			app.successMessage = "";
		},

	}
});
