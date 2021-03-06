<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Host_services extends CI_Controller
{
    public $isCheck = false;

    function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
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
                $this->list_suppliers_by_search($supplier_cd);
            }elseif (isset($_POST['add'])) {
                $data['main_content'] = 'backend/service/add_service';
                $this->load->view('includes/template', $data);
             }else {
                $this->isCheck = false;
                $this->list_host_service();
            }
        } else {
            $this->isCheck = false;
            $this->list_host_service();
        }
    }
    
    function list_host_service()
        {
            $this->load->library('pagination');
            $this->load->model('host_service');
            $this->load->model('service');
         	$this->load->model('host');



            $config['base_url'] = base_url() . 'admin/host_services/list_host_service';
            $config['total_rows'] = $this->host_service->totalHostService();
            $config['per_page'] = 20;
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
            $data['host_service'] = $this->host_service->getAllHostService($config['per_page'], $page);
            $data['links'] = $this->pagination->create_links();
            $data['main_content'] = 'backend/host_services/host_service';
            $data['title'] = 'host_service';
            $this->load->view('includes/template', $data);
        }
    function list_host_service_by_id($id)
    {
        $this->load->library('pagination');
        $this->load->model('host_service');

        $data['host_service'] = $this->host_service->getHostServiceById($id);

        $data['links'] = $this->pagination->create_links();
        $data['main_content'] = 'backend/host_services/host_service_info';
        $data['title'] = 'host_service_info';
        $this->load->view('includes/template', $data);
    }  
    function edit_host_service()
    {
       
        $this->load->library('pagination');
        $this->load->model('service');
        $id = $this->uri->segment(4);
        $data = $this->input->post();
       
        $this->service->updateService($data, $id);
        redirect('admin/services', 'refresh');
    }
    function add_host_service()
    {
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules('host_id', 'Host name', 'trim|required|string');
        $this->form_validation->set_rules('service_id', 'Service name', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->model('host_service');
            $this->load->model('service');
            $this->load->model('host');
            $data['host_name'] = $this->host->getAllHostName();
            $data['service_name'] = $this->service->getService();
            $data['main_content'] = 'backend/host_services/add_host_service';
            $data['title'] = 'Add host service';
            $this->load->view('includes/template', $data);

        }else{
            $this->load->model('host_service');
            $this->load->model('service');
            $data = $this->input->post();
            $this->session->set_flashdata('message', ' Thêm thành công ');
            $this->host_service->createHostService($data);
            redirect('admin/host_services/add_host_service', 'refresh');
        }
    }
   
    function delete_host_service($id)
    {
        $this->load->model('host_service');
        $this->session->set_flashdata('message', ' successfully deleted');
        $this->host_service->deleteHostService($id);
        redirect('admin/host_services', 'refresh');
    }
    

    private function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {

        }
    }

   

    
}


