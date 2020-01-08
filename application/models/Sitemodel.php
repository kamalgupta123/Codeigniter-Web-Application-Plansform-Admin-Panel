<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemodel extends CI_Model{
 
    public function insertData($data){
            $this->db->insert("plansform_video",$data);
        }
    public function insertBlogData($data){
            $this->db->insert("plansform_article",$data);
        }
    public function viewBlogData($d,$k){
        $this->db->order_by('1','desc');
        $q=$this->db->get("plansform_article",$d,$k);
        if($q->num_rows()>0){
            foreach($q->result() as $row){
                $data[]=$row;
            }
            return $data;
        }
    }
    public function viewData($d,$k){
            $this->db->order_by('1','desc');
            $q=$this->db->get("plansform_video",$d,$k);
            if($q->num_rows()>0){
                foreach($q->result() as $row){
                    $data[]=$row;
                }
                return $data;
            }
        }
    public function getEditingDetails(){
        $this->db->where('id',$this->uri->segment(3)) ;
        return $this->db->get("plansform_video")->result();
    }

    public function insertBlogUpdateData($data){
        $this->db->insert("plansform_article",$data);
    }

    public function getBlogEditingDetails(){
        $id=$this->uri->segment(3);
        $this->db->where('id',$id) ;
        return $this->db->get("plansform_article")->result();
    }
    public function getBlogPreviewDetails(){
        $id=$this->input->get("id");
        $this->db->where('id',$id) ;
        return $this->db->get("plansform_article")->result();
    }

    public function updateData($data){
        $id=$this->uri->segment(3);
        $this->db->where('id',$id);
        $this->db->update('plansform_video',$data);
    }

    public function delete(){
        $id=$this->uri->segment(3);
        $this->db->where('id',$id);
        $this->db->delete('plansform_video');
        return true;
    }
    public function deleteBlog(){
        $id=$this->uri->segment(3);
        $this->db->where('id',$id);
        $this->db->delete('plansform_article');
        return true;
    }

}
?>