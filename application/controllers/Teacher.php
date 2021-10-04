<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*  
 *  @author     : Marcos Fermin
 *  PencilCrunch School Management System
 *  marcosdavid1794@gmail.com
 */

class Teacher extends CI_Controller
{
    
    
    function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->library('session');
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
    
    /***default functin, redirects to login page if no teacher logged in yet***/
    public function index()
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($this->session->userdata('teacher_login') == 1)
            redirect(base_url() . 'teacher/dashboard', 'refresh');
    }
    
    /***TEACHER DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('teacher_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    
    
    /*ENTRY OF A NEW STUDENT*/
    
 /****MANAGE Pengembangan DIRI*****/
    function pd($param1 = '', $param2 = '' , $param3 = '')
    {
         if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $data['nis']       = $this->input->post('nis');
            $data['section_id']   = $this->input->post('section_id');
            $data['id']   = $this->input->post('pd');
            $data['bulan']   = $this->input->post('bulan');
            $data['materi']   = $this->input->post('materi');
            $data['capaian']   = $this->input->post('capaian');
            $this->db->insert('nilai_pd', $data);;
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'teacher/pd/'.$data['section_id'], 'refresh');
        }
        if ($param1 == 'do_update') {
            // $data['nis']       = $this->input->post('nis');
            $data['section_id']   = $this->input->post('section_id');
            // $data['id']   = $this->input->post('pd');
            $data['bulan']   = $this->input->post('bulan');
            $data['materi']   = $this->input->post('materi');
            $data['capaian']   = $this->input->post('capaian');
            
            $this->db->where('pdn_id', $param2);
            $this->db->update('nilai_pd', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'teacher/pd/'.$data['section_id'], 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('pd', array(
                'pdn_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('pdn_id', $param2);
            $this->db->delete('nilai_pd');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'teacher/pd/'.$param3, 'refresh');
        }
        $this->db->where(array('section_id' => $param1));
        $r = $this->db->get('nilai_pd')->result_array();
        $page_data['section_id']   = $param1;
        $page_data['subjects']   = $r;
        $page_data['page_name']  = 'pd';
        $page_data['page_title'] = 'Pengembangan Diri';
        $this->load->view('backend/index', $page_data);
    }



    /****MANAGE STUDENTS CLASSWISE*****/
 
	
	function student_information($section_id = '')
	{
		if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
			
		$page_data['page_name']  	= 'student_information';
		$page_data['page_title'] 	=  " Informasi santri ".
											$this->crud_model->get_section_name($section_id);
		$page_data['section_id'] 	= $section_id;
		$this->load->view('backend/index', $page_data);
	}
	
	function student_marksheet($class_id = '')
	{
		if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
			
		$page_data['page_name']  = 'student_marksheet';
		$page_data['page_title'] 	= get_phrase('student_marksheet'). " - ".get_phrase('class')." : ".
											$this->crud_model->get_class_name($class_id);
		$page_data['class_id'] 	= $class_id;
		$this->load->view('backend/index', $page_data);
	}
	
    function student($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']       = $this->input->post('name');
            $data['birthday']   = $this->input->post('birthday');
            $data['sex']        = $this->input->post('sex');
            $data['address']    = $this->input->post('address');
            $data['phone']      = $this->input->post('phone');
            $data['email']      = $this->input->post('email');
            $data['password']   = $this->input->post('password');
            $data['class_id']   = $this->input->post('class_id');
            $data['section_id'] = $this->input->post('section_id');
            $data['parent_id']  = $this->input->post('parent_id');
            $data['roll']       = $this->input->post('roll');
            $this->db->insert('student', $data);
            $student_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
            $this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'teacher/student_add/' . $data['class_id'], 'refresh');
        }
        if ($param2 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['birthday']    = $this->input->post('birthday');
            $data['sex']         = $this->input->post('sex');
            $data['address']     = $this->input->post('address');
            $data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
            $data['class_id']    = $this->input->post('class_id');
            $data['section_id']  = $this->input->post('section_id');
            $data['parent_id']   = $this->input->post('parent_id');
            $data['roll']        = $this->input->post('roll');
            
            $this->db->where('student_id', $param3);
            $this->db->update('student', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param3 . '.jpg');
            $this->crud_model->clear_cache();
            
            redirect(base_url() . 'teacher/student_information/' . $param1, 'refresh');
        } 
		
        if ($param2 == 'delete') {
            $this->db->where('student_id', $param3);
            $this->db->delete('student');
            redirect(base_url() . 'teacher/student_information/' . $param1, 'refresh');
        }
    }

    function get_class_section($class_id)
    {
        $sections = $this->db->get_where('section' , array(
            'class_id' => $class_id
        ))->result_array();
        foreach ($sections as $row) {
            echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
        }
    }
    
    /****MANAGE TEACHERS*****/
    function teacher_list($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teacher';
        $page_data['page_title'] = get_phrase('teacher_list');
        $this->load->view('backend/index', $page_data);
    }
    
    
    
     
    /****MANAGE SUBJECTS*****/
    function subject($param1 = '', $param2 = '' , $param3 = '')
    {
         if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $data['name']       = $this->input->post('name');
            $data['kkm']       = $this->input->post('kkm');
            $data['section_id']   = $this->input->post('section_id');
            $data['kategori']   = $this->input->post('kategori');
            $this->db->insert('subject', $data);;
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'teacher/subject/'.$data['section_id'], 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']       = $this->input->post('name');
            
            $data['kkm']       = $this->input->post('kkm');
            $data['section_id']   = $this->input->post('section_id');
            $data['kategori']   = $this->input->post('kategori');
            
            $this->db->where('subject_id', $param2);
            $this->db->update('subject', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'teacher/subject/'.$data['section_id'], 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('subject', array(
                'subject_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('subject_id', $param2);
            $this->db->delete('subject');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'teacher/subject/'.$param3, 'refresh');
        }
         $page_data['section_id']   = $param1;
        $page_data['subjects']   = $this->db->get_where('subject' , array('section_id' => $param1))->result_array();
        $page_data['page_name']  = 'subject';
        $page_data['page_title'] = 'Kelola Mata Pelajaran';
        $this->load->view('backend/index', $page_data);
    }
    
 /****MANAGE KEGIATAN*****/
    function KEGIATAN($param1 = '', $param2 = '' , $param3 = '')
    {
         if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $data['nis']       = $this->input->post('nis');
            $data['section_id']   = $this->input->post('section_id');
            $data['isi']   = $this->input->post('kegiatan');
            $data['tgl']   = $this->input->post('tgl');
             $t= explode("/", $this->input->post('tgl'));
            $data['bulan']   = $t['1'];
            $data['tahun']   = $t['2'];
            $data['lokasi']   = $this->input->post('lokasi');
            $this->db->insert('kegiatan', $data);;
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'teacher/kegiatan/'.$data['section_id'], 'refresh');
        }
        if ($param1 == 'do_update') {
            // $data['nis']       = $this->input->post('nis');
            $data['section_id']   = $this->input->post('section_id');
            $data['isi']   = $this->input->post('kegiatan');
            $data['tgl']   = $this->input->post('tgl');
             $t= explode("/", $this->input->post('tgl'));
            $data['bulan']   = $t['1'];
            $data['tahun']   = $t['2'];
            $data['lokasi']   = $this->input->post('lokasi');
            
            $this->db->where('kegiatan_id', $param2);
            $this->db->update('kegiatan', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'teacher/kegiatan/'.$data['section_id'], 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('kegiatan', array(
                'kegiatan_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('kegiatan_id', $param2);
            $this->db->delete('kegiatan');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'teacher/kegiatan/'.$param3, 'refresh');
        }
        $this->db->where(array('section_id' => $param1));
        $this->db->order_by('tgl','desc');
        $r = $this->db->get('kegiatan')->result_array();
        $page_data['section_id']   = $param1;
        $page_data['subjects']   = $r;
        $page_data['page_name']  = 'kegiatan';
        $page_data['page_title'] = 'Kegiatan Santri';
        $this->load->view('backend/index', $page_data);
    }

     /****MANAGE ppres*****/
    function prestasi($param1 = '', $param2 = '' , $param3 = '')
    {
         if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $data['nis']       = $this->input->post('nis');
            $data['section_id']   = $this->input->post('section_id');
            $data['isi']   = $this->input->post('kegiatan');
            $data['tgl']   = $this->input->post('tgl');
            $data['tingkat']   = $this->input->post('lokasi');
             $t= explode("/", $this->input->post('tgl'));
            $data['bulan']   = $t['1'];
            $data['tahun']   = $t['2'];
            $this->db->insert('prestasi', $data);;
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'teacher/prestasi/'.$data['section_id'], 'refresh');
        }
        if ($param1 == 'do_update') {
            // $data['nis']       = $this->input->post('nis');
            $data['section_id']   = $this->input->post('section_id');
            $data['isi']   = $this->input->post('kegiatan');
            $data['tgl']   = $this->input->post('tgl');
            $data['tingkat']   = $this->input->post('lokasi');
             $t= explode("/", $this->input->post('tgl'));
            $data['bulan']   = $t['1'];
            $data['tahun']   = $t['2'];
            $this->db->where('prestasi_id', $param2);
            $this->db->update('prestasi', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'teacher/prestasi/'.$data['section_id'], 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('prestasi', array(
                'prestasi_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('prestasi_id', $param2);
            $this->db->delete('prestasi');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'teacher/prestasi/'.$param3, 'refresh');
        }
        $this->db->where(array('section_id' => $param1));
        $this->db->order_by('tgl','desc');
        $r = $this->db->get('prestasi')->result_array();
        $page_data['section_id']   = $param1;
        $page_data['subjects']   = $r;
        $page_data['page_name']  = 'prestasi';
        $page_data['page_title'] = 'Prestasi Santri';
        $this->load->view('backend/index', $page_data);
    }

   /****MANAGE pelanggaran*****/
    function pelanggaran($param1 = '', $param2 = '' , $param3 = '')
    {
         if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $data['nis']       = $this->input->post('nis');
            $data['section_id']   = $this->input->post('section_id');
            $data['isi']   = $this->input->post('kegiatan');
            $data['tgl']   = $this->input->post('tgl');
             $t= explode("/", $this->input->post('tgl'));
            $data['bulan']   = $t['1'];
            $data['tahun']   = $t['2'];
            $data['sanksi']   = $this->input->post('lokasi');
            $this->db->insert('pelanggaran', $data);;
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'teacher/pelanggaran/'.$data['section_id'], 'refresh');
        }
        if ($param1 == 'do_update') {
            // $data['nis']       = $this->input->post('nis');
            $data['section_id']   = $this->input->post('section_id');
            $data['isi']   = $this->input->post('kegiatan');
            $data['tgl']   = $this->input->post('tgl');
            $data['sanksi']   = $this->input->post('lokasi');
             $t= explode("/", $this->input->post('tgl'));
            $data['bulan']   = $t['1'];
            $data['tahun']   = $t['2'];
            
            $this->db->where('pelanggaran_id', $param2);
            $this->db->update('pelanggaran', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'teacher/pelanggaran/'.$data['section_id'], 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('pelanggaran', array(
                'pelanggaran_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('pelanggaran_id', $param2);
            $this->db->delete('pelanggaran');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'teacher/pelanggaran/'.$param3, 'refresh');
        }
        $this->db->where(array('section_id' => $param1));
        $this->db->order_by('tgl','desc');
        $r = $this->db->get('pelanggaran')->result_array();
        $page_data['section_id']   = $param1;
        $page_data['subjects']   = $r;
        $page_data['page_name']  = 'pelanggaran';
        $page_data['page_title'] = 'Pelanggaran Santri';
        $this->load->view('backend/index', $page_data);
    }
     
    /****Sakit*****/
    function sakit($param1 = '', $param2 = '' , $param3 = '')
    {
         if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $data['nis']       = $this->input->post('nis');
            $data['section_id']   = $this->input->post('section_id');
            $data['indikasi']   = $this->input->post('kegiatan');
            $data['tgl']   = $this->input->post('tgl');
            $data['ket']   = $this->input->post('lokasi');
             $t= explode("/", $this->input->post('tgl'));
            $data['bulan']   = $t['1'];
            $data['tahun']   = $t['2'];
            $this->db->insert('sakit', $data);;
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'teacher/sakit/'.$data['section_id'], 'refresh');
        }
        if ($param1 == 'do_update') {
            // $data['nis']       = $this->input->post('nis');
            $data['section_id']   = $this->input->post('section_id');
            $data['indikasi']   = $this->input->post('kegiatan');
            $data['tgl']   = $this->input->post('tgl');
            $data['ket']   = $this->input->post('lokasi');
             $t= explode("/", $this->input->post('tgl'));
            $data['bulan']   = $t['1'];
            $data['tahun']   = $t['2'];
            
            $this->db->where('sakit_id', $param2);
            $this->db->update('sakit', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'teacher/sakit/'.$data['section_id'], 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('sakit', array(
                'sakit_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('sakit_id', $param2);
            $this->db->delete('sakit');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'teacher/sakit/'.$param3, 'refresh');
        }
        $this->db->where(array('section_id' => $param1));
        $this->db->order_by('tgl','desc');
        $r = $this->db->get('sakit')->result_array();
        $page_data['section_id']   = $param1;
        $page_data['subjects']   = $r;
        $page_data['page_name']  = 'sakit';
        $page_data['page_title'] = 'Riwayat Sakit Santri';
        $this->load->view('backend/index', $page_data);
    }

     /****PERIZINAN*****/
    function perizinan($param1 = '', $param2 = '' , $param3 = '')
    {
         if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $data['nis']       = $this->input->post('nis');
            $data['section_id']   = $this->input->post('section_id');
            $data['maksud']   = $this->input->post('kegiatan');
            $data['tgl']   = $this->input->post('tgl');

            $t= explode("/", $this->input->post('tgl'));
            $data['bulan']   = $t['1'];
            $data['tahun']   = $t['2'];
            $this->db->insert('izin', $data);;
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'teacher/perizinan/'.$data['section_id'], 'refresh');
        }
        if ($param1 == 'do_update') {
            // $data['nis']       = $this->input->post('nis');
            $data['section_id']   = $this->input->post('section_id');
            $data['maksud']   = $this->input->post('kegiatan');
            $data['tgl']   = $this->input->post('tgl');
             $t= explode("/", $this->input->post('tgl'));
            $data['bulan']   = $t['1'];
            $data['tahun']   = $t['2'];
            
            $this->db->where('izin_id', $param2);
            $this->db->update('izin', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'teacher/perizinan/'.$data['section_id'], 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('izin', array(
                'izin_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('izin_id', $param2);
            $this->db->delete('izin');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'teacher/perizinan/'.$param3, 'refresh');
        }
        $this->db->where(array('section_id' => $param1));
        $this->db->order_by('tgl','desc');
        $r = $this->db->get('izin')->result_array();
        $page_data['section_id']   = $param1;
        $page_data['subjects']   = $r;
        $page_data['page_name']  = 'perizinan';
        $page_data['page_title'] = 'Riwayat Perizinan Santri';
        $this->load->view('backend/index', $page_data);
    }
     


     /****MANAGE Qur'an & hadits*****/
    function hafalan($param1 = '', $param2 = '' , $param3 = '')
    {
         if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $data['tema']       = $this->input->post('tema');
            $data['section_id']   = $this->input->post('section_id');
            $data['kategori']   = $this->input->post('kategori');
            $data['bulan']   = $this->input->post('bulan');
            $this->db->insert('hafalan', $data);;
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'teacher/hafalan/'.$data['section_id'], 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['tema']       = $this->input->post('tema');
            $data['section_id']   = $this->input->post('section_id');
            $data['kategori']   = $this->input->post('kategori');
            $data['bulan']   = $this->input->post('bulan');
            
            $this->db->where('hafalan_id', $param2);
            $this->db->update('hafalan', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'teacher/hafalan/'.$data['section_id'], 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('hafalan', array(
                'hafalan_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('hafalan_id', $param2);
            $this->db->delete('hafalan');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'teacher/hafalan/'.$param3, 'refresh');
        }
         $page_data['section_id']   = $param1;
        $page_data['subjects']   = $this->db->get_where('hafalan' , array('section_id' => $param1))->result_array();
        $page_data['page_name']  = 'hafalan';
        $page_data['page_title'] = 'Tema Hafalan';
        $this->load->view('backend/index', $page_data);
    }
     
   // Ambil Tema Hafalan
    function get_tema_hafalan($class_id,$section_id,$bulan)
    {
        $sections = $this->db->get_where('hafalan' , array(
            'kategori' => $class_id,
            'section_id' => $section_id,
            'bulan'=> $bulan
        ))->result_array();
        foreach ($sections as $row) {
            echo '<option value="' . $row['hafalan_id'] . '">' . $row['tema'] . '</option>';
        }
    }

    // Ambil Tema Hafalan
    function get_tema_vocab($class_id,$section_id,$bulan)
    {
        $sections = $this->db->get_where('vocab' , array(
            'kategori' => $class_id,
            'section_id' => $section_id,
             'bulan'=> $bulan
        ))->result_array();
        foreach ($sections as $row) {
            echo '<option value="' . $row['vocab_id'] . '">' . $row['tema'] . '</option>';
        }
    }

     /****MANAGE Qur'an & hadits*****/
    function vocab($param1 = '', $param2 = '' , $param3 = '')
    {
         if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $data['tema']       = $this->input->post('tema');
            $data['section_id']   = $this->input->post('section_id');
            $data['kategori']   = $this->input->post('kategori');
            $data['bulan']   = $this->input->post('bulan');
            $this->db->insert('vocab', $data);;
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'teacher/vocab/'.$data['section_id'], 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['tema']       = $this->input->post('tema');
            $data['section_id']   = $this->input->post('section_id');
            $data['kategori']   = $this->input->post('kategori');
            $data['bulan']   = $this->input->post('bulan');
            
            $this->db->where('vocab_id', $param2);
            $this->db->update('vocab', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'teacher/vocab/'.$data['section_id'], 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('vocab', array(
                'vocab_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('vocab_id', $param2);
            $this->db->delete('vocab');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'teacher/vocab/'.$param3, 'refresh');
        }
        $page_data['section_id']   = $param1;
        $page_data['subjects']   = $this->db->get_where('vocab' , array('section_id' => $param1))->result_array();
        $page_data['page_name']  = 'vocab';
        $page_data['page_title'] = 'Tema Hafalan';
        $this->load->view('backend/index', $page_data);
    }
     
      /****** nhafalan *****************/
    function manage_nilaiv($month='',$year='',$section_id='',$vocab_id='')
    {
        if($this->session->userdata('teacher_login')!=1)redirect('login' , 'refresh');
        
        if($_POST)
        {
            // Loop all the students of $class_id
            $students   =   $this->db->get_where('student', array('section_id' => $section_id))->result_array();
            foreach ($students as $row)
            {
                $nilai =   $this->input->post('nilai_' . $row['student_id']);
                
              
                $this->db->where('nis',$row['nis']);
                $this->db->where('bulan',$month);
                $this->db->where('tahun',$year);
                $this->db->where('vocab_id',$vocab_id);

                $this->db->update('nilai_vocab' , array('nilai' => $nilai
            ));
               
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'teacher/manage_nilaiv/'.$month.'/'.$year.'/'.$section_id.'/'.$vocab_id ,'refresh');
        }
        $page_data['section_id'] =  $section_id;
        $page_data['vocab_id'] =  $vocab_id;
        $page_data['month']    =    $month;
        $page_data['year']     =    $year;
        
        $page_data['page_name']  =  'nilaiv';
        $page_data['page_title'] =  'Penilaian Hafalan';
        $this->load->view('backend/index', $page_data);
    }
    function nvocab_selector()
    {
        redirect(base_url() . 'teacher/manage_nilaiv/'.
                    $this->input->post('bulan').'/'.
                        $this->input->post('year').'/'.
                         $this->input->post('section_id').'/'.
                             $this->input->post('vocab_id'), 'refresh');
    }


    
      /****** nbtq *****************/
    function btq($section_id='',$month='',$year='')
    {
        if($this->session->userdata('teacher_login')!=1)redirect('login' , 'refresh');
        
        if($_POST)
        {
            // Loop all the students of $class_id
            $students   =   $this->db->get_where('student', array('section_id' => $section_id))->result_array();
            foreach ($students as $row)
            {
                $huruf =   $this->input->post('huruf_' . $row['student_id']);
                $baca =   $this->input->post('baca_' . $row['student_id']);
                $tajwid =   $this->input->post('tajwid_' . $row['student_id']);
                
              
                $this->db->where('nis',$row['nis']);
                $this->db->where('bulan',$month);
                $this->db->where('tahun',$year);

                $this->db->update('btq' , array('huruf' => $huruf,
                    'baca' => $baca,
                    'tajwid' => $tajwid
            ));
               
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'teacher/btq/'.$section_id.'/'.$month.'/'.$year ,'refresh');
        }
        $page_data['section_id'] =  $section_id;        
        $page_data['month']    =    $month;
        $page_data['year']     =    $year;
        
        $page_data['page_name']  =  'btq';
        $page_data['page_title'] =  'Penilaian BTQ';
        $this->load->view('backend/index', $page_data);
    }
    function btq_selector()
    {
        redirect(base_url() . 'teacher/btq/'. $this->input->post('section_id').'/'.
                    $this->input->post('bulan').'/'.
                        $this->input->post('year'), 'refresh');
    }
    
    /*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup_restore($operation = '', $type = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($operation == 'create') {
            $this->crud_model->create_backup($type);
        }
        if ($operation == 'restore') {
            $this->crud_model->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'teacher/backup_restore/', 'refresh');
        }
        if ($operation == 'delete') {
            $this->crud_model->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(base_url() . 'teacher/backup_restore/', 'refresh');
        }
        
        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['page_title'] = get_phrase('manage_backup_restore');
        $this->load->view('backend/index', $page_data);
    }
    
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']        = $this->input->post('name');
            $data['email']       = $this->input->post('email');
             $data['nipy']       = $this->input->post('nipy');
            
            $this->db->where('teacher_id', $this->session->userdata('teacher_id'));
            $this->db->update('teacher', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $this->session->userdata('teacher_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'teacher/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = md5($this->input->post('password'));
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');
            
            $current_password = $this->db->get_where('teacher', array(
                'teacher_id' => $this->session->userdata('teacher_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('teacher_id', $this->session->userdata('teacher_id'));
                $this->db->update('teacher', array(
                    'password' => md5($data['new_password'])
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'teacher/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('teacher', array(
            'teacher_id' => $this->session->userdata('teacher_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /**********MANAGING CLASS ROUTINE******************/
    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['class_id']   = $this->input->post('class_id');
            $data['subject_id'] = $this->input->post('subject_id');
            $data['time_start'] = $this->input->post('time_start');
            $data['time_end']   = $this->input->post('time_end');
            $data['day']        = $this->input->post('day');
            $this->db->insert('class_routine', $data);
            redirect(base_url() . 'teacher/class_routine/', 'refresh');
        }
        if ($param1 == 'edit' && $param2 == 'do_update') {
            $data['class_id']   = $this->input->post('class_id');
            $data['subject_id'] = $this->input->post('subject_id');
            $data['time_start'] = $this->input->post('time_start');
            $data['time_end']   = $this->input->post('time_end');
            $data['day']        = $this->input->post('day');
            
            $this->db->where('class_routine_id', $param3);
            $this->db->update('class_routine', $data);
            redirect(base_url() . 'teacher/class_routine/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('class_routine', array(
                'class_routine_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('class_schedule_id', $param2);
            $this->db->delete('class_schedule');
            redirect(base_url() . 'teacher/class_routine/', 'refresh');
        }
        $page_data['page_name']  = 'class_routine';
        $page_data['page_title'] = get_phrase('manage_class_routine');
        $this->load->view('backend/index', $page_data);
    }
	
  /////////////////////Nilai ////////////////////


    /****** nilai *****************/
    function manage_nilai($month='',$year='',$section_id='',$subject_id='')
    {
        if($this->session->userdata('teacher_login')!=1)redirect('login' , 'refresh');
        
        if($_POST)
        {
            // Loop all the students of $class_id
            $students   =   $this->db->get_where('student', array('section_id' => $section_id))->result_array();
            foreach ($students as $row)
            {
                $nilai1 =   $this->input->post('nilai1_' . $row['student_id']);
                $nilai2 =   $this->input->post('nilai2_' . $row['student_id']);
                $nilai3 =   $this->input->post('nilai3_' . $row['student_id']);
                $nilai4 =   $this->input->post('nilai4_' . $row['student_id']);
                
              
                $this->db->where('nis',$row['nis']);
                $this->db->where('bulan',$month);
                $this->db->where('tahun',$year);
                $this->db->where('subject_id',$subject_id);

                $this->db->update('nilai' , array(
                    'nilai1' => $nilai1,
                    'nilai2' => $nilai2,
                    'nilai3' => $nilai3,
                    'nilai4' => $nilai4
            ));
                 
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'teacher/manage_nilai/'.$month.'/'.$year.'/'.$section_id.'/'.$subject_id ,'refresh');
        }
        $page_data['section_id'] =  $section_id;
        $page_data['subject_id'] =  $subject_id;
        $page_data['month']    =    $month;
        $page_data['year']     =    $year;
        
        $page_data['page_name']  =  'nilai';
        $page_data['page_title'] =  'Penilaian';
        $this->load->view('backend/index', $page_data);
    }
    function nilai_selector()
    {
        redirect(base_url() . 'teacher/manage_nilai/'.
                    $this->input->post('bulan').'/'.
                        $this->input->post('year').'/'.
                         $this->input->post('section_id').'/'.
                             $this->input->post('subject_id'), 'refresh');
    }
 /////////////////////Ujian ////////////////////


    /****** Ujian *****************/
    function manage_ujian($idu='',$year='',$section_id='',$subject_id='')
    {
        if($this->session->userdata('teacher_login')!=1)redirect('login' , 'refresh');
        
        if($_POST)
        {
            // Loop all the students of $class_id
            $students   =   $this->db->get_where('student', array('section_id' => $section_id))->result_array();
            foreach ($students as $row)
            {
                $nilai1 =   $this->input->post('nilai1_' . $row['student_id']);
                
                
              
                $this->db->where('nis',$row['nis']);
                $this->db->where('idu',$idu);
                $this->db->where('tahun',$year);
                $this->db->where('subject_id',$subject_id);

                $this->db->update('nujian' , array(
                    'nilai' => $nilai1,
                  
            ));
                 
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'teacher/manage_ujian/'.$idu.'/'.$year.'/'.$section_id.'/'.$subject_id ,'refresh');
        }
        $page_data['section_id'] =  $section_id;
        $page_data['subject_id'] =  $subject_id;
        $page_data['idu']    =    $idu;
        $page_data['year']     =    $year;
        
        $page_data['page_name']  =  'ujian';
        $page_data['page_title'] =  'Ujian';
        $this->load->view('backend/index', $page_data);
    }
    function ujian_selector()
    {
        redirect(base_url() . 'teacher/manage_ujian/'.
                    $this->input->post('idu').'/'.
                        $this->input->post('year').'/'.
                         $this->input->post('section_id').'/'.
                             $this->input->post('subject_id'), 'refresh');
    }

 /****** nhafalan *****************/
    function manage_nilaih($month='',$year='',$section_id='',$hafalan_id='')
    {
        if($this->session->userdata('teacher_login')!=1)redirect('login' , 'refresh');
        
        if($_POST)
        {
            // Loop all the students of $class_id
            $students   =   $this->db->get_where('student', array('section_id' => $section_id))->result_array();
            foreach ($students as $row)
            {
                $nilai =   $this->input->post('nilai_' . $row['student_id']);
                
              
                $this->db->where('nis',$row['nis']);
                $this->db->where('bulan',$month);
                $this->db->where('tahun',$year);
                $this->db->where('hafalan_id',$hafalan_id);

                $this->db->update('nilai_hafalan' , array('nilai' => $nilai
            ));
               
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'teacher/manage_nilaih/'.$month.'/'.$year.'/'.$section_id.'/'.$hafalan_id ,'refresh');
        }
        $page_data['section_id'] =  $section_id;
        $page_data['hafalan_id'] =  $hafalan_id;
        $page_data['month']    =    $month;
        $page_data['year']     =    $year;
        
        $page_data['page_name']  =  'nilaih';
        $page_data['page_title'] =  'Penilaian Hafalan';
        $this->load->view('backend/index', $page_data);
    }
    function nhafalan_selector()
    {
        redirect(base_url() . 'teacher/manage_nilaih/'.
                    $this->input->post('bulan').'/'.
                        $this->input->post('year').'/'.
                         $this->input->post('section_id').'/'.
                             $this->input->post('hafalan_id'), 'refresh');
    }

	/****** DAILY ATTENDANCE *****************/
    function manage_attendance($month='',$year='',$section_id='')
    {
        if($this->session->userdata('teacher_login')!=1)redirect('login' , 'refresh');
        
        if($_POST)
        {
            // Loop all the students of $class_id
            $students   =   $this->db->get_where('student', array('section_id' => $section_id))->result_array();
            foreach ($students as $row)
            {
                $hadir =   $this->input->post('hadir_' . $row['student_id']);
                $t_pondok =   $this->input->post('t_pondok_'.$row['student_id']);
                $sakit =   $this->input->post('sakit_'.$row['student_id']);
                $izin =   $this->input->post('izin_'.$row['student_id']);
                $alfa =   $this->input->post('alfa_'.$row['student_id']);

                $this->db->where('nis',$row['nis']);
                $this->db->where('bulan',$month);

                $this->db->update('attendance' , array('hadir' => $hadir,
                    't_pondok' => $t_pondok,
                    'sakit'  => $sakit,
                    'izin' => $izin,
                    'alfa' => $alfa

            ));
               
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'teacher/manage_attendance/'.$month.'/'.$year.'/'.$section_id ,'refresh');
        }
        $page_data['section_id'] =  $section_id;
        $page_data['month']    =    $month;
        $page_data['year']     =    $year;
        
        $page_data['page_name']  =  'manage_attendance';
        $page_data['page_title'] =  'Rakapitulasi Kehadiran';
        $this->load->view('backend/index', $page_data);
    }
    function attendance_selector()
    {
        redirect(base_url() . 'teacher/manage_attendance/'.
                    $this->input->post('bulan').'/'.
                        $this->input->post('year').'/'.
                             $this->input->post('section_id'), 'refresh');
    }
    
  
   
    /***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->insert('noticeboard', $data);
            redirect(base_url() . 'teacher/noticeboard/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->where('notice_id', $param2);
            $this->db->update('noticeboard', $data);
            $this->session->set_flashdata('flash_message', get_phrase('notice_updated'));
            redirect(base_url() . 'teacher/noticeboard/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                'notice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('notice_id', $param2);
            $this->db->delete('noticeboard');
            redirect(base_url() . 'teacher/noticeboard/', 'refresh');
        }
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('manage_noticeboard');
        $page_data['notices']    = $this->db->get('noticeboard')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    
 
    
   
  
}