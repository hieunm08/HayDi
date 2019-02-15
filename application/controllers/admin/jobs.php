<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jobs extends CI_Controller
{
    public $isCheck = false;
    var $API = "";

    function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->API="http://api.haydi.vn:3001/";
        $this->load->library('curl');
        $this->load->helper('language');
        $this->lang->load('supplier', $this->session->userdata('language'));
    }

    function index()
    {
        if (!empty($_POST)) {

            if (isset($_POST['uploadclick'])) {
                if (isset($_FILES['file'])) {
                    $this->docFileExcel($_FILES['file']['tmp_name'], './folder/' . $_FILES['file']['name']);
                }
            } elseif (isset($_POST['userName'])) {
                $userName = $_POST['userName'];
                $password = $_POST['password'];
                $fullname = $_POST['fullname'];
                $type = $_POST['type'];
                $status = $_POST['status'];
                $this->addSupplier($userName, $password, $fullname,  $type, $status);

            } elseif ($_POST['supplier_search'] != null) {
                $this->isCheck = true;
                $supplier_cd = $_POST['supplier_search'];
//                $this->list_suppliers($supplier_cd);
                $this->list_suppliers_by_search($supplier_cd);
            }
             else {
                $this->isCheck = false;
//                $supplier_cd = $_POST['supplier_search'];
                $this->list_jobs();
            }
        } else {
            $this->isCheck = false;
            $this->list_jobs();
        }
    }
    
    function list_jobs()
        {
            $this->load->library('pagination');
            $this->load->model('job');



            $config['base_url'] = base_url() . 'admin/jobs/list_jobs';
            $config['total_rows'] = $this->job->totalJob();
            $config['per_page'] = 2;
            $config["uri_segment"] = 4;
            //pagination styling
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href"#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo;';
            $config['next_link'] = '&raquo;';

            $this->pagination->initialize($config);
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $data['jobs'] = $this->job->getAllJob($config['per_page'], $page);
            $data['links'] = $this->pagination->create_links();
            $data['main_content'] = 'backend/jobs/jobs';
            $data['title'] = 'Jobs';
            $this->load->view('includes/template', $data);
        }
    function list_jobs_by_id($id)
    {
        $this->load->library('pagination');
        $this->load->model('job');

        $data['jobs'] = $this->skill->getJobById($id);

        $data['links'] = $this->pagination->create_links();
        $data['main_content'] = 'backend/skills/skill_info';
        $data['title'] = 'Skills';
        $this->load->view('includes/template', $data);
    }  
    function edit_skill()
    {
        /*$name = $_GET['name'];
        $icon = $_GET['email'];
        $desc = $_GET['sub_phone'];
        $id = $_GET['id'];*/
        $this->load->library('pagination');
        $this->load->model('skill');
        $id = $this->uri->segment(4);
        $data = $this->input->post();
       
        $this->skill->updateSkill($data, $id);
        redirect('admin/skills', 'refresh');
    }
   
    function delete_skill($id)
    {
        $this->load->model('skill');
        $this->session->set_flashdata('message', 'Suppliers successfully deleted');
        $this->skill->deleteSkill($id);
        redirect('admin/skills', 'refresh');
    }
    

    private function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {

        }
    }

   

    
}


