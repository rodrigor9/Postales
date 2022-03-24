<?php if (! defined("BASEPATH")) exit('No direct script access allowed');

    class Formularios_model extends CI_Model {
        function __construct() {
            parent::__construct();
            $this->load->database();
        }

        public function registrarUsuario($data) {
            $sql = "SELECT * FROM usuario WHERE email = ?";
            $this->db->query($sql,$data['email']);
            if($this->db->affected_rows() == 1) {
                return FALSE;
            } else {

                $this->db->insert('usuario',array(
                        'nombre' => $data['nombre'],
                        'contrasena' => md5($data['contrasena']),
                        'email' => $data['email'],
                        'celular' => $data['celular'],
                        'genero' => $data['genero'],
                        'fechaNac' => $data['fecha'],
                        'privilegio' => 0
                ));
                if ($this->db->affected_rows() == 1) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }

        public function logearse($data) {
            $query = $this->db->get_where('usuario', array( # Consulta con where = SELECT * FROM usuario WHERE
                'email' => $data['email'],
                'contrasena' => md5($data['contrasena'])
            ));
            if($query->num_rows() > 0) {
                return $query->row();
            } else {
                return null;
            }
        }
    }
?>
