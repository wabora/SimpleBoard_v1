<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Board extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('board_m');
    }
	
    public function index(){
        $this->load->view('board/index');
    }
	
    public function get(){
		$result['rows'] = $this->board_m->get();
        echo json_encode($result);
    }
	
	public function insert(){
		$data = array(
            'subject'=> $this->input->post('subject'),
            'content'=> $this->input->post('content')    
            );
		if($this->board_m->insert($data) != false){
			$result['msg'] = 'success';
		}
		echo json_encode($result);
	}
	
	public function update(){
		$idx = $this->input->post('idx');
		$data = array(
            'subject'=> $this->input->post('subject'),
            'content'=> $this->input->post('content')
            );
			
        if($this->board_m->update($idx,$data) != false){
            $result['msg'] = 'success';
        }
		echo json_encode($result);
	}
	
	public function del(){
		$idx=$this->uri->segment(3);
		if($this->board_m->del($idx) != false){
			$result['msg'] = 'success';
		}		
		echo json_encode($result);
    }
}
