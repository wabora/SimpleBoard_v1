<?php 
class Board_m extends CI_Model{
    public function get(){
        $query = $this->db->get('board');
		return $query->result();
    }
		
	public function insert($data){
        return $this->db->insert('board', $data);
    }
	
	public function update($idx,$field){
        $this->db->where('idx', $idx);
        return $this->db->update('board', $field);
	}
	
	public function del($idx){
        return $this->db->delete('board',array('idx'=>$idx));
    }
}
?>
