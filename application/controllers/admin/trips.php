<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Trips extends CI_Controller
{
    public $isCheck = false;

    function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->library('curl');
        $this->load->helper('language');
        $this->lang->load('vi', 'vietnamese');
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
                $data['main_content'] = 'backend/skills/add_skill';
                $this->load->view('includes/template', $data);
             }else {
                $this->isCheck = false;
//                $supplier_cd = $_POST['supplier_search'];
                $this->list_trips();
            }
        } else {
            $this->isCheck = false;
            $this->list_trips();
        }
    }
    
    function list_trips()
        {
            $this->load->library('pagination');
            $this->load->model('trip');



            $config['base_url'] = base_url() . 'admin/trips/list_trips';
            $config['total_rows'] = $this->trip->totalTrip();
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
            $data['trips'] = $this->trip->getAllTrips($config['per_page'], $page);
            $data['links'] = $this->pagination->create_links();
            $data['main_content'] = 'backend/trips/trips';
            $data['title'] = 'TRips';
            $this->load->view('includes/template', $data);
        }
    function list_skills_by_id($id)
    {
        $this->load->library('pagination');
        $this->load->model('skill');

        $data['skills'] = $this->skill->getSkillById($id);

        $data['links'] = $this->pagination->create_links();
        $data['main_content'] = 'backend/skills/skill_info';
        $data['title'] = 'Skills';
        $this->load->view('includes/template', $data);
    }  
    function edit_skill()
    {
        $this->load->library('pagination');
        $this->load->model('skill');
        $id = $this->uri->segment(4);
        $data = $this->input->post();
       
        $this->skill->updateSkill($data, $id);
        redirect('admin/skills', 'refresh');
    }
    function add_skill()
    {
        //$this->form_validation->set_message('required', $this->lang->line('required'));
 

        $this->form_validation->set_rules('name', 'lang:username', 'string|trim|required');
        $this->form_validation->set_rules('icon', 'Icon', 'trim|required');
        $this->form_validation->set_rules('desc', 'Mô tả', 'string|trim|required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->model('skill');

            $data['main_content'] = 'backend/skills/add_skill';
            $data['title'] = 'skill';
            $this->load->view('includes/template', $data);
        }else{
            $this->load->library('pagination');
            $this->load->model('skill');
            $data = $this->input->post();
           
            $this->skill->createSkill($data);
            redirect('admin/skills', 'refresh');
        }
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


