<?php

require_once('../db/Database.php');

class DocumentsModel
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = new Database();
    }


    /**
     * Consulta y devuelve un usuario basado en el nombre de usuario.
     *
     * @param string $username - Nombre de usuario a consultar.
     * @return mixed - Datos del usuario o null si no se encuentra.
     */
    public function consultarUsuario($username)
    {
        // consultar usuario
        try {
            $this->conexion->query("SELECT * FROM `usuarios` WHERE `usuario` = ?");
            $this->conexion->bindP(1, $username, PDO::PARAM_STR);
            $this->conexion->execute();
            return $this->conexion->show();
        } catch (Exception $e) {
            die($e);
        }
    }


    /**
     * Obtiene y devuelve la lista de documentos.
     *
     * @return array - Lista de documentos.
     */
    public function read()
    {
        try {
            $this->conexion->query("SELECT A.DOC_ID, A.DOC_NOMBRE, B.TIP_NOMBRE, A.DOC_ID_TIPO, C.PRO_NOMBRE, A.DOC_ID_PROCESO, A.DOC_CODIGO, A.DOC_CONTENIDO 
                                      FROM DOC_DOCUMENTO A, TIP_TIPO_DOC B, PRO_PROCESO C 
                                     WHERE A.DOC_ID_TIPO = B.TIP_ID 
                                       AND A.DOC_ID_PROCESO = C.PRO_ID ");

            $this->conexion->execute();

            return $this->conexion->showAll();
        } catch (\Throwable $e) {
            die($e);
        }
    }




    /**
     * Crea un nuevo documento con los datos proporcionados.
     *
     * @param array $param - Datos del nuevo documento.
     * @param string $CodDocu - Código de documento generado.
     * @return bool - true si la creación es exitosa, false en caso contrario.
     */
    public function create($param, $CodDocu)
    {
        try {
            $this->conexion->query("INSERT INTO `doc_documento` (`DOC_ID`, `DOC_NOMBRE`, `DOC_CODIGO`, `DOC_CONTENIDO`, `DOC_ID_TIPO`, `DOC_ID_PROCESO`)
                                                         VALUES (?,?,?,?,?,?)");
            $this->conexion->bindP(1, null);
            $this->conexion->bindP(2, $param['DOC_NOMBRE'], PDO::PARAM_STR);
            $this->conexion->bindP(3, $CodDocu, PDO::PARAM_STR);
            $this->conexion->bindP(4, $param['DOC_CONTENIDO'], PDO::PARAM_STR);
            $this->conexion->bindP(5, $param['DOC_ID_TIPO'], PDO::PARAM_INT);
            $this->conexion->bindP(6, $param['DOC_ID_PROCESO'], PDO::PARAM_INT);

            return $this->conexion->execute();
        } catch (\Throwable $e) {
            die($e);
        }
    }



    /**
     * Actualiza un documento existente con los datos proporcionados.
     *
     * @param int $id - ID del documento a actualizar.
     * @param array $param - Nuevos datos del documento.
     * @param string $CodDocu - Código de documento generado.
     * @return bool - true si la actualización es exitosa, false en caso contrario.
     */
    public function update($id, $param, $CodDocu)
    {
        try {
            $this->conexion->query("UPDATE `doc_documento` SET `DOC_NOMBRE`= ?, `DOC_CODIGO`= ?, `DOC_CONTENIDO`= ?, `DOC_ID_TIPO`= ?, `DOC_ID_PROCESO`= ? WHERE DOC_ID = ?");
            $this->conexion->bindP(1, $param['DOC_NOMBRE'], PDO::PARAM_STR);
            $this->conexion->bindP(2, $CodDocu, PDO::PARAM_STR);
            $this->conexion->bindP(3, $param['DOC_CONTENIDO'], PDO::PARAM_STR);
            $this->conexion->bindP(4, $param['DOC_ID_TIPO'], PDO::PARAM_STR);
            $this->conexion->bindP(5, $param['DOC_ID_PROCESO'], PDO::PARAM_INT);
            $this->conexion->bindP(6, $id, PDO::PARAM_INT);

            return $this->conexion->execute();
        } catch (\Throwable $e) {
            die($e);
        }
    }




    /**
     * Elimina un documento según su ID.
     *
     * @param int $id - ID del documento a eliminar.
     * @return bool - true si la eliminación es exitosa, false en caso contrario.
     */
    public function delete($id)
    {
        try {
            $this->conexion->query("DELETE FROM `doc_documento` WHERE DOC_ID = ?");
            $this->conexion->bindP(1, $id, PDO::PARAM_INT);
            return $this->conexion->execute();

        } catch (\Throwable $e) {
            die($e);
        }
    }


    /**
     * Consulta y devuelve la lista de tipos de documentos.
     *
     * @return array - Lista de tipos de documentos.
     */
    public function consultartipos()
    {
        try {
            $this->conexion->query("SELECT * FROM `tip_tipo_doc` ");
            $this->conexion->execute();

            return $this->conexion->showAll();
        } catch (\Throwable $e) {
            die($e);
        }
    }

    /**
     * Consulta y devuelve un tipo de documento basado en su ID.
     *
     * @param int $id - ID del tipo de documento a consultar.
     * @return mixed - Datos del tipo de documento o null si no se encuentra.
     */
    public function consultartiposId($id)
    {
        try {
            $this->conexion->query("SELECT `TIP_ID`, `TIP_NOMBRE`, `TIP_PREFIJO` FROM `tip_tipo_doc` WHERE TIP_ID = ? ");
            $this->conexion->bindP(1, $id, PDO::PARAM_INT);
            $this->conexion->execute();

            return $this->conexion->show();
        } catch (\Throwable $e) {
            die($e);
        }
    }



    /**
     * Consulta y devuelve la lista de procesos.
     *
     * @return array - Lista de procesos.
     */
    public function consultarprocesos()
    {
        try {
            $this->conexion->query("SELECT * FROM `pro_proceso` ");
            $this->conexion->execute();

            return $this->conexion->showAll();
        } catch (\Throwable $e) {
            die($e);
        }
    }


    /**
     * Consulta y devuelve un proceso basado en su ID.
     *
     * @param int $id - ID del proceso a consultar.
     * @return mixed - Datos del proceso o null si no se encuentra.
     */
    public function consultarprocesosId($id)
    {
        try {
            $this->conexion->query("SELECT `PRO_ID`, `PRO_PREFIJO`, `PRO_NOMBRE` FROM `pro_proceso` WHERE PRO_ID = ? ");
            $this->conexion->bindP(1, $id, PDO::PARAM_INT);

            $this->conexion->execute();

            return $this->conexion->show();
        } catch (\Throwable $e) {
            die($e);
        }
    }



    /**
     * Consulta y devuelve el consecutivo de códigos de documentos.
     *
     * @return mixed - Consecutivo de códigos de documentos.
     */
    public function consultarConsecutivo()
    {
        try {
            $this->conexion->query("SELECT Max(SUBSTRING_INDEX(DOC_CODIGO, '-', -1)) AS DOC_CODIGO FROM `doc_documento`");
            $this->conexion->execute();

            return $this->conexion->show();
        } catch (\Throwable $e) {
            die($e);
        }
    }

}