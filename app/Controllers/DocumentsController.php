<?php
require_once('../Models/DocumentsModel.php');
class DocumentsController
{

    private $DocumentsModel;
    public function __construct()
    {
        $this->DocumentsModel = new DocumentsModel();
    }



    /**
     * Obtiene y devuelve la lista de documentos.
     */
    public function read()
    {
        $data = $this->DocumentsModel->read();
        echo json_encode($data);
    }




    /**
     * Crea un nuevo documento en base a los datos proporcionados.
     *
     * @param array $param - Datos del nuevo documento.
     */
    public function create($param)
    {
        $nombreTip = '';
        $nombreProc = '';
        $numCons = 0;

        $Tip = $this->DocumentsModel->consultartiposId($param['DOC_ID_TIPO']);
        if ($Tip != null) {
            $nombreTip = $Tip->TIP_PREFIJO;
        }
        $Proc = $this->DocumentsModel->consultarprocesosId($param['DOC_ID_PROCESO']);
        if ($Proc != null) {
            $nombreProc = $Proc->PRO_PREFIJO;
        }
        $Cons = $this->DocumentsModel->consultarConsecutivo();
        if ($Cons != null) {
            $NomCodi = $Cons->DOC_CODIGO;
            $numCons = $NomCodi;
        }
        $CodDocu = $nombreTip . '-' . $nombreProc . '-' . strval($numCons + 1);
        $data = $this->DocumentsModel->create($param, $CodDocu);
        // Lógica para generar un código de documento y crearlo.

        echo json_encode($data); // Luego, se devuelve la respuesta en formato JSON.
    }


    /**
     * Actualiza un documento existente con los datos proporcionados.
     *
     * @param int $id - ID del documento a actualizar.
     * @param array $param - Nuevos datos del documento.
     */
    public function update($id, $param)
    {
        $nombreTip = '';
        $nombreProc = '';
        $numCons = 0;

        $Tip = $this->DocumentsModel->consultartiposId($param['DOC_ID_TIPO']);
        if ($Tip != null) {
            $nombreTip = $Tip->TIP_PREFIJO;
        }
        $Proc = $this->DocumentsModel->consultarprocesosId($param['DOC_ID_PROCESO']);
        if ($Proc != null) {
            $nombreProc = $Proc->PRO_PREFIJO;
        }
        $Cons = $this->DocumentsModel->consultarConsecutivo();
        if ($Cons != null) {
            $NomCodi = $Cons->DOC_CODIGO;
            $numCons = $NomCodi;
        }
        $CodDocu = $nombreTip . '-' . $nombreProc . '-' . strval($numCons + 1);

        $data = $this->DocumentsModel->update($id, $param, $CodDocu);
        echo json_encode($data);
    }


    /**
     * Elimina un documento según su ID.
     *
     * @param int $id - ID del documento a eliminar.
     */
    public function delete($id)
    {
        $data = $this->DocumentsModel->delete($id);
        echo json_encode($data);
    }


    /**
     * Realiza la autenticación del usuario y devuelve true si es válido, false en caso contrario.
     *
     * @param string $user - Nombre de usuario.
     * @param string $password - Contraseña del usuario.
     */
    public function login($user, $password)
    {
        $data = $this->DocumentsModel->consultarUsuario($user);
        if ($data != null && $data->PASSWORD == $password) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }


    /**
     * Consulta y devuelve la lista de tipos de documentos.
     */
    public function consultartipos()
    {
        $data = $this->DocumentsModel->consultartipos();
        echo json_encode($data);
    }


    /**
     * Consulta y devuelve la lista de procesos.
     */
    public function consultarprocesos()
    {
        $data = $this->DocumentsModel->consultarprocesos();
        echo json_encode($data);
    }
}