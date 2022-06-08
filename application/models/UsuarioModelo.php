<?php

class UsuarioModelo extends CI_Model
{
    public $ID;
    public $correo;
    public $password;

    function __construct()
    {
        parent::__construct();
        $this->load->model('CRUD_Modelo','crudm');
        $this->load->model('AlumnoModelo','alumm');
    }

    public function inicio_sesion($correo_user)
    {
        $this->db->select('correo, password');
        $this->db->from('usuario');
        $this->db->where('correo', $correo_user);
        $consulta = $this->db->get();
        $result = $consulta->result();
        return $result;
    }

    public function registrar_usuario($correo,$password)
    {
        $userxacceso = $this->inicio_sesion($correo);
        if (count($userxacceso) == 0) { //SI EL CORREO NO EXISTE
            $DATA_USUARIO = array(
                'correo' => $correo,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            );
            $INSERT_USUARIO = $this->db->insert('usuario', $DATA_USUARIO);
            if ($INSERT_USUARIO) {                
                //ID DE USUARIO REGISTRADO
                $userid = $this->crudm->listar_maxID_tabla('usuario');

                //REGISTRO DE DATOS DEL ALUMNO                
                //$registro_alumno = $this->alumm->registrar_alumno($userid,$nombres,$apellidos,$carrera,$codigo,$celular,$fecnac);
                
                return "OK";
            } else {
                return "ERROR";
            }
        } else {
            return "EXIST";
        }
    }
}
?>