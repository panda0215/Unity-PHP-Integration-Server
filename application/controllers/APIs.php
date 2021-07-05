<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class APIs extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        // $this->load->library('PHPMailer_Lib'); // It will be used for password recovery.(Sent email)
    }

    public function createUser() {
        
        $data = $this->input->post();
        
        if ($data == null) {
            $this->output
                        ->set_status_header(400)
                        ->set_output(json_encode(array(
                            'status'=>'Fail',
                            'message'=>'Data is empty. Fill in the blank fields.'
                        )));
        } else {
            $return = $this->DataControl->CreateUserAccount((object)$data);

            if ($return->status) {
                $this->output
                            ->set_status_header(200)
                            ->set_output(json_encode(array(
                                'status'=>'Success',
                                'message'=>'Created a new account!'
                            )));
            } else {
                // $this->output->set_header("HTTP/1.0 400 Bad Request!");
                $this->output
                            ->set_status_header(400)
                            ->set_output(json_encode(array(
                                'status'=>'Fail',
                                'message'=>$return->msg
                            )));
            }
        }
    }
}