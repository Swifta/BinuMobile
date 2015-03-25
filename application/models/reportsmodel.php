<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of membermodel
 *
 * @author upperlink
 */
class reportsmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function retrieve_agentbalance($agentid){
        $agentid = strtolower($agentid);
        $this->db->select('');
    }

    function retrieve_userrolebyname($userrole_name) {
        $userrole_name = strtolower($userrole_name);
        $this->db->select('ur.id_userrole, ')
                ->from('userrole ur')
                ->where(array(
                    'lower(ur.name)' => "$userrole_name",
                        )
        );

        $query = $this->db->get();
        $result = $query->row();
        log_message('info', 'verify user roles ::::::::::===>' . $this->db->last_query());
        $query->free_result();
        return $result->id_userrole;
    }

    function retrieve_logindetails($email) {
        $this->db->select('ld.*, ')
                ->from('logindetails ld')
                ->where(array(
                    'lower(ld.username)' => "$email",
                        )
        );
        $query = $this->db->get();
        $result = $query->first_row('array');
        log_message('info', 'login details ::::::::::===>' . $this->db->last_query());
        $query->free_result();
        return $result;
    }


}

?>
