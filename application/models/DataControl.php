<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class DataControl extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }

    public function CreateUserAccount($data) {
        
        $query = 'SELECT count(*) as cnt FROM tbl_user Where 
                    username = "'     . $data->username . 
                    '" OR email = "'  . $data->email . '"';
                    
        if ($this->db->query($query)->row()->cnt > 0) {
            return (object)array(
                'status'=>false,
                'msg'   =>'Already existed an user who has the same name, E-mail. Please Try again.'
            );
        } else {
            
            unset($data->confirm_password);
            unset($data->confirm_email);

            $this->db->insert('tbl_user', $data);
            return (object)array(
                'status'=>true,
                'msg'=>'completed!'
            );
        }
    }
}