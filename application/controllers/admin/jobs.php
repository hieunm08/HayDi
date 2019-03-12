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

            } elseif ($_POST['job_search'] != null) {
                $this->isCheck = true;
                $job_search = $_POST['job_search'];
//                $this->list_suppliers($supplier_cd);
                $this->jobs_search($job_search);
            }elseif (isset($_POST['add'])) {
                $data['main_content'] = 'backend/jobs/add_job';
                $this->load->view('includes/template', $data);
             }else {
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
            $config['per_page'] = 8;
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
        function jobs_search($job_search){
            $this->load->library('pagination');
            $this->load->model('job');
            $data['Jobs'] = $this->job->jobs_search_model($job_search);
            $data['links'] = $this->pagination->create_links();
           $data['main_content'] = 'backend/jobs/jobs';
          $data['title'] = 'jobs';
            $this->load->view('includes/template', $data);
        }
    function list_jobs_by_id($id)
    {
        $this->load->library('pagination');
        $this->load->model('job');

        $data['jobs'] = $this->job->getJobById($id);

        $data['links'] = $this->pagination->create_links();
        $data['main_content'] = 'backend/jobs/job_info';
        $data['title'] = 'Jobs';
        $this->load->view('includes/template', $data);
    }  
    function edit_job()
    {
        $this->load->library('pagination');
        $this->load->model('job');
        $id = $this->uri->segment(4);
        $data = $this->input->post();
       
        $this->job->updateJob($data, $id);
        redirect('admin/jobs', 'refresh');
    }
    function add_job()
    {
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules('name', 'name', 'trim|required|alpha');

        if ($this->form_validation->run() == FALSE)
        {
            
            
            $data['main_content'] = 'backend/jobs/add_job';
            $data['title'] = 'Add job';
            $this->load->view('includes/template', $data);
        }
        else
        {
            $this->load->model('job');
            $data = $this->input->post();
            $this->job->createJob($data);
            $this->session->set_flashdata('message', 'Thêm thành công');
            redirect('admin/jobs', 'refresh');
        }
    }

   
    function delete_job($id)
    {
        $this->load->model('job');
        $this->session->set_flashdata('message', 'Xóa thành công');
        $this->job->deleteJob($id);
        redirect('admin/jobs', 'refresh');
    }
    

    private function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {

        }
    }

   

    
}


