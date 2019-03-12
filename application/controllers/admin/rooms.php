<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rooms extends CI_Controller
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
//                $this->list_suppliers($supplier_cd);
                $this->list_suppliers_by_search($supplier_cd);
            }elseif (isset($_POST['add'])) {
                $data['main_content'] = 'backend/service/add_service';
                $this->load->view('includes/template', $data);
             }else {
                $this->isCheck = false;
//                $supplier_cd = $_POST['supplier_search'];
                $this->list_room();
            }
        } else {
            $this->isCheck = false;
            $this->list_room();
        }
    }
    
    function list_room()
        {
            $this->load->library('pagination');
            $this->load->model('room');
            $this->load->model('host');

            $config['base_url'] = base_url() . 'admin/rooms/list_room';
            $config['total_rows'] = $this->room->totalRoom();
            $config['per_page'] = 10;
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
            $data['rooms'] = $this->room->getAllRoom($config['per_page'], $page);
            $data['links'] = $this->pagination->create_links();
            $data['main_content'] = 'backend/rooms/rooms';
            $data['title'] = 'Rooms';
            $this->load->view('includes/template', $data);
        }
    function list_room_by_id($id)
    {
        $this->load->library('pagination');
        $this->load->model('room');
        $this->load->model('host');

        $data['room'] = $this->room->getRoomById($id);
        $data['links'] = $this->pagination->create_links();
        $data['main_content'] = 'backend/rooms/room_info';
        $data['title'] = 'Room';
        $this->load->view('includes/template', $data);
    }  


     function add_room()
    {
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules('host_id', 'Hotel name', 'trim|required');
        $this->form_validation->set_rules('name', ' name', 'trim|required');
        $this->form_validation->set_rules('bed_number', 'Bed number', 'trim|required');
        $this->form_validation->set_rules('bed_type', 'Bed type', 'trim|required');
        $this->form_validation->set_rules('price', 'price', 'trim|required');
        $this->form_validation->set_rules('unit', 'unit', 'trim|required');
        $this->form_validation->set_rules('is_breakfast', 'Breakfast', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->model('room');
            $this->load->model('host');
            $data['hotel_name'] = $this->host->getHotel();
            $data['main_content'] = 'backend/rooms/add_room';
            $data['title'] = 'Add Room';
            $this->load->view('includes/template', $data);
        }else{
            $this->load->model('room');
            $data = array(
            "host_id" => $this->input->post('host_id'),
            "name" => $this->input->post('name'),
            "images" => $this->input->post('images'),
            "bed_number" => $this->input->post('bed_number'),
            "bed_type" => $this->input->post('bed_type'),
            "price" => $this->input->post('price'),
            "unit" => $this->input->post('unit'),
            "is_breakfast" => $this->input->post('is_breakfast'),
            "updated_at" => mdate('%Y-%m-%d %H:%i:%s', now())
            );

            $this->session->set_flashdata('message', 'Thêm thành công');
            $this->room->createRoom($data);
            redirect('admin/rooms/add_room', 'refresh');
        }
    }

        function edit_room(){
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
            $this->form_validation->set_rules('bed_number', 'Bed number', 'trim|required');
            $this->form_validation->set_rules('bed_type', 'Bed type', 'trim|required');
            $this->form_validation->set_rules('price', 'price', 'trim|required');
            $this->form_validation->set_rules('unit', 'unit', 'trim|required');
            $this->form_validation->set_rules('is_breakfast', 'Breakfast', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->model('room');
            $this->load->model('host');
            $data['hotel_name'] = $this->host->getHotel();
            $data['main_content'] = 'backend/rooms/room_info';
            $data['title'] = 'Edit Room';
            $this->load->view('includes/template', $data);
        }else{
            $this->load->model('room');
            $data = array(
            "images" => $this->input->post('images'),
            "bed_number" => $this->input->post('bed_number'),
            "bed_type" => $this->input->post('bed_type'),
            "price" => $this->input->post('price'),
            "unit" => $this->input->post('unit'),
            "is_breakfast" => $this->input->post('is_breakfast'),
            "updated_at" => mdate('%Y-%m-%d %H:%i:%s', now())
            );

            $this->session->set_flashdata('message', ' thành công');
            $this->room->updateRoom($data);
            redirect('admin/rooms', 'refresh');
        }
        }
   

   
    function delete_room($id)
    {
        $this->load->model('room');
        $this->session->set_flashdata('message', 'successfully deleted');
        $this->room->deleteRoom($id);
        redirect('admin/rooms', 'refresh');
    }
    

    private function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {

        }
    }

   

    
}


