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



            $config['base_url'] = base_url() . 'admin/rooms/list_room';
            $config['total_rows'] = $this->room->totalRoom();
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
            $data['rooms'] = $this->room->getAllRoom($config['per_page'], $page);
            $data['links'] = $this->pagination->create_links();
            $data['main_content'] = 'backend/rooms/rooms';
            $data['title'] = 'Rooms';
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


     function add_rooms()
    {
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        $this->form_validation->set_rules('id', 'Mã', 'trim|required');
        $this->form_validation->set_rules('host_id', 'Mã host', 'trim|required');
                $this->form_validation->set_rules('name', ' Tên phòng', 'trim');
        $this->form_validation->set_rules('bed_number', 'Số giường ngủ', 'trim');
        $this->form_validation->set_rules('bed_type', 'Kiểu giường', 'trim');
        $this->form_validation->set_rules('price', 'Giá', 'trim');
        $this->form_validation->set_rules('unit', 'Đơn vị', 'trim');
                $this->form_validation->set_rules('is_breakfast', 'Phục vụ kết thúc', 'trim');

        $this->form_validation->set_rules('update_at', 'Thời gian cập nhật', 'trim');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->model('room');
            $data['main_content'] = 'backend/rooms/add_rooms';
            $data['title'] = 'Add Room';
            $this->load->view('includes/template', $data);
        }else{
            $this->load->library('pagination');
            $this->load->model('room');
            $data = $this->input->post();
             $this->room->addroom($data);
            redirect('admin/rooms', 'refresh');
        }
    }

     function list_room_byID($room_id)
        {
            $this->load->library('pagination');
            $this->load->model('room');
            $data['rooms'] = $this->room->show_room_byID($room_id);
            $data['links'] = $this->pagination->create_links();
            $data['main_content'] = 'backend/rooms/rooms_info';
            $data['title'] = 'Rooms';
            $this->load->view('includes/template',$data);
        }

        function update_room(){
            $data['host_id']=$this->input->post('host_id');
            $data['name']=$this->input->post('name');

            $data['bed_number']=$this->input->post('bed_number');

            $data['bed_type']=$this->input->post('bed_type');

            $data['price']=$this->input->post('price');
             $data['unit']=$this->input->post('unit');


            $data['is_breakfast']=$this->input->post('is_breakfast');

            $data['update_at']=$this->input->post('update_at');
           $data['id']  =$this->input->post('id');
            $this->load->library('pagination');
            $this->load->model('room');
            $id = $this->uri->segment(4);
            $this->room->updateroom($data,$id);
            redirect('admin/rooms', 'refresh');

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


