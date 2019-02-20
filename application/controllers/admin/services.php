<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Services extends CI_Controller
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
            }elseif (isset($_POST['add'])) {
                $data['main_content'] = 'backend/service/add_service';
                $this->load->view('includes/template', $data);
             }else {
                $this->isCheck = false;
//                $supplier_cd = $_POST['supplier_search'];
                $this->list_service();
            }
        } else {
            $this->isCheck = false;
            $this->list_service();
        }
    }
    
    function list_service()
        {
            $this->load->library('pagination');
            $this->load->model('service');



            $config['base_url'] = base_url() . 'admin/services/list_service';
            $config['total_rows'] = $this->service->totalService();
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
            $data['service'] = $this->service->getAllService($config['per_page'], $page);
            $data['links'] = $this->pagination->create_links();
            $data['main_content'] = 'backend/service/service';
            $data['title'] = 'Service';
            $this->load->view('includes/template', $data);
        }
    function list_service_by_id($id)
    {
        $this->load->library('pagination');
        $this->load->model('service');

        $data['service'] = $this->service->getServiceById($id);

        $data['links'] = $this->pagination->create_links();
        $data['main_content'] = 'backend/service/service_info';
        $data['title'] = 'Service';
        $this->load->view('includes/template', $data);
    }  
    function edit_service()
    {
       
        $this->load->library('pagination');
        $this->load->model('service');
        $id = $this->uri->segment(4);
        $data = $this->input->post();
       
        $this->service->updateService($data, $id);
        redirect('admin/services', 'refresh');
    }
    function add_service()
    {
        $this->load->library('pagination');
        $this->load->model('service');
        $data = $this->input->post();
       
        $this->service->createService($data);
        redirect('admin/services', 'refresh');
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


