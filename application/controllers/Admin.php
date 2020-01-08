<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

       public function __construct(){
              parent::__construct();
              $this->load->model('Loginmodel');
              $this->load->library('session');
              $this->load->library('pagination');
              $this->load->model('Sitemodel');
       }

	public function index(){
       // echo base_url();
       // exit;
              if($this->session->userdata('id')){
                     $this->load->view("admin/header/header");
                     $this->load->view("admin/header/navbar");
                     $this->load->view('admin/header/sidebar');
                     $this->load->view("admin/home/home");
                     $this->load->view("admin/header/footer"); 
              }
                  
              else{
                     $this->session->set_flashdata('error','please log in first');
                     $this->load->view('admin/login');
              }
	}

       public function loginPage(){
              $this->load->view('admin/login');
       }
//SESSION IS GLOBAL SET A TRUE SESSION TRUE IF DB AND POST VAR CREDENTIALS MATCH AND SHOW A PG ONLY IF SESSION T LOGOUT PE SESSION FALSE //session gets stored for 6 days directly show

       public function checkDetails(){
             $data['username']=$this->input->post('email');
             $data['password']=$this->input->post('password');
             if(!empty($data['username']) && !empty($data['password'])){
               $login_data=$this->Loginmodel->areDetailsOk($data['username'],$data['password']);
               if(count($login_data)==1){
                     $session_data=array(
                            'id'=>$login_data[0]["id"],
                            'username'=>$login_data[0]["username"],
                            'password'=>$login_data[0]["password"]
                     );
                     $this->session->set_userdata($session_data);
                     if($this->session->userdata('id')){
                        redirect('Admin');//redirect works on controller links for views use this->load
                     }
               }
               else{
                     $this->session->set_flashdata('error','you have entered the wrong credentials');
                     $this->load->view('admin/login');
               }
             }
             else{
              $this->session->set_flashdata('error','please enter the necessary details');
              $this->load->view('admin/login');
             }       
       }

       public function logOut(){
              if($this->session->userdata('id')){
                     $this->session->set_userdata('id','');
                     $this->session->set_flashdata('error','please login first');
                     $this->load->view('admin/login');
              }
              else{
                     $this->session->set_flashdata('error','please login first');
                     $this->load->view('admin/login');
              }
       }

       public function articleForm(){
              $this->load->view("admin/header/header");
              $this->load->view("admin/header/navbar");
              $this->load->view('admin/header/sidebar');
              $this->load->view("admin/home/news_form",array('error' => ' ' ));
              $this->load->view("admin/header/footer");
       }

       public function newsView(){
              $config['base_url']="http://localhost/plansformadmin/Admin/newsView";
              $config['total_rows']=$this->db->get("plansform_video")->num_rows();
              $config['per_page']=3;
              $config['num_links']=3;
              $config['full_tag_open']='<div class="pagination">';
              $config['full_tag_close']="</div>";
              $this->pagination->initialize($config);
              $data['records']=$this->Sitemodel->viewData($config['per_page'],$this->uri->segment(3));
               $this->load->view("admin/header/header");
              $this->load->view("admin/header/navbar");
               $this->load->view('admin/header/sidebar');
              $this->load->view("admin/home/news_display",$data);
              $this->load->view("admin/header/footer");

       }

       

       public function doUpload()
       {
         $config['upload_path']   = './uploads/news'; 
         $config['allowed_types'] = 'gif|jpg|png'; 
         $this->load->library('upload', $config);
          if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view("admin/header/header");
            $this->load->view("admin/header/navbar");
            $this->load->view('admin/header/sidebar');
            $this->load->view('admin/home/news_form', $error);
            $this->load->view("admin/header/footer"); 
         }
         else{
              $file_name= $this->upload->data('file_name');
               $data=array(
                     "guid"=>'',
                     "youtubeurl"=>'',
                     "image"=>$file_name,
                     "title" =>$this->input->post("heading"),
                     "status"=>'published',
                     "created_on"=>'',
                     "description"=>$this->input->post("text"),
                     "source"=>'',
                     "dates"=>$this->input->post("date")
              );
                $this->Sitemodel->insertData($data);
                redirect('admin/articleForm');
            }      

}
              public function edit(){
              $data['results']=$this->Sitemodel->getEditingDetails();
              $this->load->view("admin/header/header");
              $this->load->view("admin/header/navbar");
              $this->load->view('admin/header/sidebar');
              $this->load->view("admin/home/news_edit",$data);
              $this->load->view("admin/header/footer");      
              }

              public function update(){
                    $config['upload_path']   = './uploads/news'; 
                    $config['allowed_types'] = 'gif|jpg|png'; 
                    $this->load->library('upload', $config);
                    if($this->upload->do_upload('userfile')){
                     $file_name= $this->upload->data('file_name');
                     $data=array(
                     "guid"=>'',
                     "youtubeurl"=>'',
                     "image"=>$file_name,
                     "title" =>$this->input->post("heading"),
                     "status"=>'published',
                     "created_on"=>'',
                     "description"=>$this->input->post("text"),
                     "source"=>'',
                     "dates"=>$this->input->post("date")
              );
                    $this->Sitemodel->updateData($data);
                    redirect('Admin/newsView');
             }
              }

           public function delete(){
              if($this->Sitemodel->delete()){
                     redirect('Admin/newsView');
              }
           }

           public function blogForm(){
            $this->load->view("admin/header/header");
            $this->load->view("admin/header/navbar");
            $this->load->view('admin/header/sidebar');
            $this->load->view("admin/home/blog_form",array('error' => ' ' ));
            $this->load->view("admin/header/footer");
           }

           public function blogView(){
              $config['base_url']="http://localhost/plansformadmin/Admin/blogView";
              $config['total_rows']=$this->db->get("plansform_article")->num_rows();
              $config['per_page']=3;
              $config['num_links']=3;
              $config['full_tag_open']='<div class="pagination">';
              $config['full_tag_close']="</div>";
              $this->pagination->initialize($config);
              $data['records']=$this->Sitemodel->viewBlogData($config['per_page'],$this->uri->segment(3));
              $this->load->view("admin/header/header");
              $this->load->view("admin/header/navbar");
              $this->load->view('admin/header/sidebar');
              $this->load->view("admin/home/blogs_display",$data);
              $this->load->view("admin/header/footer");
           }

           public function newBlogUpload(){
                   $is_ajax=$this->input->post("ajax");
                   if($is_ajax){
                  //   $config['upload_path']   = './uploads/blogs'; 
                  //   $config['allowed_types'] = 'gif|jpg|png'; 
                  //   $this->load->library('upload', $config);
                  //   if($this->upload->do_upload('file')){
                  //       $file_name= $this->upload->data('file_name');
                        $data=array(
                                    "guid"=>'',
                                    "title" =>$this->input->post("heading"),
                                    "surl"=>$this->input->post("heading"),
                                    "created_on"=>$this->input->post("date"),
                                    "description"=>$this->input->post("description")
                        );
                        $this->Sitemodel->insertBlogData($data);
                        $this->load->view("admin/home/blog_form",array('error' => ' ' ));
                    }
           }
           public function editBlog(){
            $data['results']=$this->Sitemodel->getBlogEditingDetails();
            $this->load->view("admin/header/header");
            $this->load->view("admin/header/navbar");
            $this->load->view('admin/header/sidebar');
            $this->load->view("admin/home/blog_edit",$data);  
            $this->load->view("admin/header/footer");     
            }
          public function deleteBlog(){
            if($this->Sitemodel->deleteBlog()){
                  redirect('Admin/blogView');
           } 
          }
         public function newBlogUpdate(){
            $is_ajax=$this->input->post("ajax");
            if($is_ajax){
           //   $config['upload_path']   = './uploads/blogs'; 
           //   $config['allowed_types'] = 'gif|jpg|png'; 
           //   $this->load->library('upload', $config);
           //   if($this->upload->do_upload('file')){
           //       $file_name= $this->upload->data('file_name');
                 $data=array(
                             "id"=>$this->input->post('id'),
                             "guid"=>'',
                             "title" =>$this->input->post("heading"),
                             "surl"=>$this->input->post("heading"),
                             "created_on"=>$this->input->post("date"),
                             "description"=>$this->input->post("description")
                 );
                 $this->Sitemodel->insertBlogUpdateData($data);
                 $config['base_url']=base_url()."Admin/blogView";
                 $config['total_rows']=$this->db->get("plansform_article")->num_rows();
                 $config['per_page']=3;
                 $config['num_links']=3;
                 $config['full_tag_open']='<div class="pagination">';
                 $config['full_tag_close']="</div>";
                 $this->pagination->initialize($config);
                 $data['records']=$this->Sitemodel->viewBlogData($config['per_page'],$this->uri->segment(3));
                 $this->load->view("admin/home/blogs_display",$data);
             }
         }

         public function previewBlog(){
           $data['results']=$this->Sitemodel->getBlogPreviewDetails();
           $this->load->view("admin/home/blog_preview",$data);
         }

}

?>