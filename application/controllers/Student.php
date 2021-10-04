<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*  
 *  @author     : Marcos Fermin
 *  PencilCrunch School Management System
 *  marcosdavid1794@gmail.com
 */

class Student extends CI_Controller
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
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($this->session->userdata('student_login') == 1)
            redirect(base_url() . 'student/dashboard', 'refresh');
    }
    
    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = 'Dashboard';
        $this->load->view('backend/index', $page_data);
    }
    
    
    /****MANAGE TEACHERS*****/
    function nilai_akademik($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
     
    
        

       $page_data['bulan']  = $param1;
       $page_data['tahun']  = $param2;
        // $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'akademik';
        $page_data['page_title'] = 'Nilai Akademik';
        $this->load->view('backend/index', $page_data);
    }

     /****MANAGE TEACHERS*****/
    function tampil($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
     
      
        $bulan = $this->input->post('bulan');
        $tahun =$this->input->post('tahun');
        

        
        $nilai = $this->db->get_where('nilai',array(
            'bulan' => $bulan,
            'tahun' => $tahun,
            'nis' => $this->session->userdata('nis')
        ))->result_array();
  
       

       $page_data['bulan']  = $bulan;
       $page_data['tahun']  = $tahun;
       $page_data['nilai']  = $nilai;
        // $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'akademik';
        $page_data['page_title'] = 'Nilai Akademik';
        $this->load->view('backend/index', $page_data);
    }

     function nilai_ujian($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
     
    
        

       $page_data['idu']  = $param1;
       $page_data['tahun']  = $param2;
        // $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'ujian';
        $page_data['page_title'] = 'Nilai Ujian (UTS/UAS)';
        $this->load->view('backend/index', $page_data);
    }

     /****MANAGE TEACHERS*****/
    function tampilun($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
     
      
        $idu = $this->input->post('idu');
        $tahun =$this->input->post('tahun');
        

        
        $nilai = $this->db->get_where('nujian',array(
            'idu' => $idu,
            'tahun' => $tahun,
            'nis' => $this->session->userdata('nis')
        ))->result_array();
  
       

       $page_data['idu']  = $idu;
       $page_data['tahun']  = $tahun;
       $page_data['nilai']  = $nilai;
        // $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'ujian';
        $page_data['page_title'] = 'Nilai Ujian (UTS/UAS)';
        $this->load->view('backend/index', $page_data);
    }


 // Absensi

      /****MANAGE TEACHERS*****/
    function absensi($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
     
    
        

       $page_data['bulan']  = $param1;
       $page_data['tahun']  = $param2;
        // $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'absensi';
        $page_data['page_title'] = 'Rekapitulasi Kehadiran';
        $this->load->view('backend/index', $page_data);
    }

     /****MANAGE TEACHERS*****/
    function tampila($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
     
      
        $bulan = $this->input->post('bulan');
        $tahun =$this->input->post('tahun');
        

        
        $nilai = $this->db->get_where('attendance',array(
            'bulan' => $bulan,
            'nis' => $this->session->userdata('nis')
        ))->result_array();
  
       

       $page_data['bulan']  = $bulan;
       $page_data['tahun']  = $tahun;
       $page_data['nilai']  = $nilai;
        // $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'absensi';
        $page_data['page_title'] = 'Rekapitulasi Kehadiran';
        $this->load->view('backend/index', $page_data);
    }
    




    
         /****MANAGE TEACHERS*****/
    function laporan($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');

        $bulan = $param1-1;
        $tahun = $param2;
     
        $santri = $this->crud_model->get_student_info($this->session->userdata('student_id'));

        $page_data['santri']  = $santri;
        $page_data['bulan']  = $bulan;
        $page_data['tahun']  = $param2;

         $nilai = $this->db->get_where('nilai',array(
            'bulan' => $bulan,
            'tahun' => $param2,
            'nis' => $this->session->userdata('nis')
        ))->result_array();


        $nilai1 = $this->db->get_where('nilai_hafalan',array(
            'bulan' => $bulan,
            'tahun' => $param2,
            'nis' => $this->session->userdata('nis')
        ))->result_array();

         $nilai2 = $this->db->get_where('nilai_vocab',array(
            'bulan' => $bulan,
            'tahun' => $param2,
            'nis' => $this->session->userdata('nis')
        ))->result_array();

          $nilai3 = $this->db->get_where('btq',array(
            'bulan' => $bulan,
            'tahun' => $param2,
            'nis' => $this->session->userdata('nis')
        ))->result_array();


           $keg = $this->db->get_where('kegiatan',array(
            'bulan' => $bulan,
            'tahun' => $tahun,
            'nis' => $this->session->userdata('nis')
        ))->result_array();

         $pres = $this->db->get_where('prestasi',array(
            'bulan' => $bulan,
            'tahun' => $tahun,
            'nis' => $this->session->userdata('nis')
        ))->result_array();
        
        $izin = $this->db->get_where('izin',array(
            'bulan' => $bulan,
            // 'tahun' => $tahun,
            'nis' => $this->session->userdata('nis')
        ))->result_array();

        $sakit = $this->db->get_where('sakit',array(
       'bulan' => $bulan,
            'tahun' => $tahun,
            'nis' => $this->session->userdata('nis')
        ))->result_array();
        
         $pd = $this->db->get_where('nilai_pd',array(
            'bulan' => $bulan,
            'nis' => $this->session->userdata('nis')
        ))->result_array();
       
       $pelanggaran = $this->db->get_where('pelanggaran',array(
            'bulan' => $bulan,
            'tahun' => $tahun,
            'nis' => $this->session->userdata('nis')
        ))->result_array();

        $absen = $this->db->get_where('attendance',array(
            'bulan' => $bulan,
            'nis' => $this->session->userdata('nis')
        ))->result_array();

       $page_data['absen']  = $absen;

       $page_data['bulan']  = $bulan;
       $page_data['tahun']  = $tahun;
       $page_data['keg']  = $keg;
       $page_data['pd']  = $pd;
        $page_data['pres']  = $pres;
        $page_data['izin']  = $izin;
         $page_data['sakit']  = $sakit;
          $page_data['pelanggaran']  = $pelanggaran;
        
        $page_data['nilai']  = $nilai;
        $page_data['nilai1']  = $nilai1;
        $page_data['nilai2']  = $nilai2;
        $page_data['nilai3']  = $nilai3;
        $page_data['page_name']  = 'laporan';
        $page_data['page_title'] = 'Laporan Bulananan Hasil Belajar Santri';
        $this->load->view('backend/index', $page_data);
    }


      /****MANAGE TEACHERS*****/
    function tahfidz($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
     
    
        

       $page_data['bulan']  = $param1;
       $page_data['tahun']  = $param2;
        // $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'tahfidz';
        $page_data['page_title'] = 'Nilai Hafalan & BTQ';
        $this->load->view('backend/index', $page_data);
    }


     /****MANAGE TEACHERS*****/
    function tampilh($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
     
      
        $bulan = $this->input->post('bulan');
        $tahun =$this->input->post('tahun');
        

        
        $nilai = $this->db->get_where('nilai_hafalan',array(
            'bulan' => $bulan,
            'tahun' => $tahun,
            'nis' => $this->session->userdata('nis')
        ))->result_array();

         $nilai2 = $this->db->get_where('nilai_vocab',array(
            'bulan' => $bulan,
            'tahun' => $tahun,
            'nis' => $this->session->userdata('nis')
        ))->result_array();

          $nilai3 = $this->db->get_where('btq',array(
            'bulan' => $bulan,
            'tahun' => $tahun,
            'nis' => $this->session->userdata('nis')
        ))->result_array();
  
       

       $page_data['bulan']  = $bulan;
       $page_data['tahun']  = $tahun;
       $page_data['nilai']  = $nilai;
        $page_data['nilai2']  = $nilai2;
        $page_data['nilai3']  = $nilai3;
        // $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'tahfidz';
        $page_data['page_title'] = 'Nilai Hafalan & BTQ';
        $this->load->view('backend/index', $page_data);
    }
    /***********************************************************************************************************/
    
    function kesantrian($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
     
    
        

       $page_data['bulan']  = $param1;
       $page_data['tahun']  = $param2;
       $page_data['pres']  = $param3;
        // $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'kesantrian';
        $page_data['page_title'] = 'Nilai Kesantrian';
        $this->load->view('backend/index', $page_data);
    }

     /****MANAGE TEACHERS*****/
    function tampils($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
     
      
        $bulan = $this->input->post('bulan');
        $tahun =$this->input->post('tahun');
        
        
        $keg = $this->db->get_where('kegiatan',array(
            'bulan' => $bulan,
            'tahun' => $tahun,
            'nis' => $this->session->userdata('nis')
        ))->result_array();

         $pres = $this->db->get_where('prestasi',array(
            'bulan' => $bulan,
            'tahun' => $tahun,
            'nis' => $this->session->userdata('nis')
        ))->result_array();
        
        $izin = $this->db->get_where('izin',array(
            'bulan' => $bulan,
            // 'tahun' => $tahun,
            'nis' => $this->session->userdata('nis')
        ))->result_array();

        $sakit = $this->db->get_where('sakit',array(
       'bulan' => $bulan,
            'tahun' => $tahun,
            'nis' => $this->session->userdata('nis')
        ))->result_array();
       
       $pelanggaran = $this->db->get_where('pelanggaran',array(
            'bulan' => $bulan,
            'tahun' => $tahun,
            'nis' => $this->session->userdata('nis')
        ))->result_array();

       $page_data['bulan']  = $bulan;
       $page_data['tahun']  = $tahun;
       $page_data['keg']  = $keg;
        $page_data['pres']  = $pres;
        $page_data['izin']  = $izin;
         $page_data['sakit']  = $sakit;
          $page_data['pelanggaran']  = $pelanggaran;
        // $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'kesantrian';
        $page_data['page_title'] = 'Kesantrian';
        $this->load->view('backend/index', $page_data);
    }
    
    
    /****MANAGE SUBJECTS*****/
    function subject($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
        
        $student_profile         = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();
        $student_class_id        = $student_profile->class_id;
        $page_data['subjects']   = $this->db->get_where('subject', array(
            'section_id' => $student_class_id
        ))->result_array();
        $page_data['page_name']  = 'subject';
        $page_data['page_title'] = get_phrase('manage_subject');
        $this->load->view('backend/index', $page_data);
    }
    
    
    
    /****MANAGE EXAM MARKS*****/
    function marks($exam_id = '', $class_id = '', $subject_id = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
        
        $student_profile       = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();
        $page_data['class_id'] = $student_profile->class_id;
		 $page_data['student_id'] = $this->db->get_where('student', array( 'student_id' => $this->session->userdata('student_id') 
							))->row()->student_id;
        
        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id']    = $this->input->post('exam_id');
            //$page_data['class_id']	=	$this->input->post('class_id');
            $page_data['subject_id'] = $this->input->post('subject_id');
            
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0) {
                redirect(base_url() . 'student/marks/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
            } else {
                $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
                redirect(base_url() . 'student/marks/', 'refresh');
            }
        }
        $page_data['exam_id']    = $exam_id;
        //$page_data['class_id']	=	$class_id;
        $page_data['subject_id'] = $subject_id;
        
        $page_data['page_info'] = 'Exam marks';
        
        $page_data['page_name']  = 'marks';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }
    
    
    /**********MANAGING CLASS ROUTINE******************/
    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
        
        $student_profile         = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();
        $page_data['class_id']   = $student_profile->class_id;
        $page_data['page_name']  = 'class_routine';
        $page_data['page_title'] = get_phrase('manage_class_routine');
        $this->load->view('backend/index', $page_data);
    }
    
    /******MANAGE BILLING / INVOICES WITH STATUS*****/
    function invoice($param1 = '', $param2 = '', $param3 = '')
    {
        //if($this->session->userdata('student_login')!=1)redirect(base_url() , 'refresh');
        if ($param1 == 'make_payment') {
            $invoice_id      = $this->input->post('invoice_id');
            $system_settings = $this->db->get_where('settings', array(
                'type' => 'paypal_email'
            ))->row();
            $invoice_details = $this->db->get_where('invoice', array(
                'invoice_id' => $invoice_id
            ))->row();
            
            /****TRANSFERRING USER TO PAYPAL TERMINAL****/
            $this->paypal->add_field('rm', 2);
            $this->paypal->add_field('no_note', 0);
            $this->paypal->add_field('item_name', $invoice_details->title);
            $this->paypal->add_field('amount', $invoice_details->amount);
            $this->paypal->add_field('custom', $invoice_details->invoice_id);
            $this->paypal->add_field('business', $system_settings->description);
            $this->paypal->add_field('notify_url', base_url() . 'student/invoice/paypal_ipn');
            $this->paypal->add_field('cancel_return', base_url() . 'student/invoice/paypal_cancel');
            $this->paypal->add_field('return', base_url() . 'student/invoice/paypal_success');
            
            $this->paypal->submit_paypal_post();
            // submit the fields to paypal
        }
        if ($param1 == 'paypal_ipn') {
            if ($this->paypal->validate_ipn() == true) {
                $ipn_response = '';
                foreach ($_POST as $key => $value) {
                    $value = urlencode(stripslashes($value));
                    $ipn_response .= "\n$key=$value";
                }
                $data['payment_details']   = $ipn_response;
                $data['payment_timestamp'] = strtotime(date("m/d/Y"));
                $data['payment_method']    = 'paypal';
                $data['status']            = 'paid';
                $invoice_id                = $_POST['custom'];
                $this->db->where('invoice_id', $invoice_id);
                $this->db->update('invoice', $data);

                $data2['method']       =   'paypal';
                $data2['invoice_id']   =   $_POST['custom'];
                $data2['timestamp']    =   strtotime(date("m/d/Y"));
                $data2['payment_type'] =   'income';
                $data2['title']        =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->title;
                $data2['description']  =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->description;
                $data2['student_id']   =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->student_id;
                $data2['amount']       =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->amount;
                $this->db->insert('payment' , $data2);
            }
        }
        if ($param1 == 'paypal_cancel') {
            $this->session->set_flashdata('flash_message', get_phrase('payment_cancelled'));
            redirect(base_url() . 'student/invoice/', 'refresh');
        }
        if ($param1 == 'paypal_success') {
            $this->session->set_flashdata('flash_message', get_phrase('payment_successfull'));
            redirect(base_url() . 'student/invoice/', 'refresh');
        }
        $student_profile         = $this->db->get_where('student', array(
            'student_id'   => $this->session->userdata('student_id')
        ))->row();
        $student_id              = $student_profile->student_id;
        $page_data['invoices']   = $this->db->get_where('invoice', array(
            'student_id' => $student_id
        ))->result_array();
        $page_data['page_name']  = 'invoice';
        $page_data['page_title'] = get_phrase('manage_invoice/payment');
        $this->load->view('backend/index', $page_data);
    }
    
    /**********MANAGE LIBRARY / BOOKS********************/
    function book($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['books']      = $this->db->get('book')->result_array();
        $page_data['page_name']  = 'book';
        $page_data['page_title'] = get_phrase('manage_library_books');
        $this->load->view('backend/index', $page_data);
        
    }
    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/
    function transport($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['transports'] = $this->db->get('transport')->result_array();
        $page_data['page_name']  = 'transport';
        $page_data['page_title'] = get_phrase('manage_transport');
        $this->load->view('backend/index', $page_data);
        
    }
    /**********MANAGE DORMITORY / HOSTELS / ROOMS ********************/
    function dormitory($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['dormitories'] = $this->db->get('dormitory')->result_array();
        $page_data['page_name']   = 'dormitory';
        $page_data['page_title']  = get_phrase('manage_dormitory');
        $this->load->view('backend/index', $page_data);
        
    }
    
    /**********WATCH NOTICEBOARD AND EVENT ********************/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['notices']    = $this->db->get('noticeboard')->result_array();
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('noticeboard');
        $this->load->view('backend/index', $page_data);
        
    }
    
    /**********MANAGE DOCUMENT / home work FOR A SPECIFIC CLASS or ALL*******************/
    function document($do = '', $document_id = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['page_name']  = 'manage_document';
        $page_data['page_title'] = get_phrase('manage_documents');
        $page_data['documents']  = $this->db->get('document')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'student/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'student/message/message_read/' . $param2, 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
            $this->crud_model->mark_thread_messages_read($param2);
        }

        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = get_phrase('private_messaging');
        $this->load->view('backend/index', $page_data);
    }
    
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url() . 'login', 'refresh');
       
        if ($param1 == 'change_password') {
            $data['password']             = md5($this->input->post('password'));
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');
            
            $current_password = $this->db->get_where('student', array(
                'student_id' => $this->session->userdata('student_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('student_id', $this->session->userdata('student_id'));
                $this->db->update('student', array(
                    'password' => md5($data['new_password'])
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'student/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /*****************SHOW STUDY MATERIAL / for students of a specific class*******************/
    function study_material($task = "", $document_id = "")
    {
        if ($this->session->userdata('student_login') != 1)
        {
            $this->session->set_userdata('last_page' , current_url());
            redirect(base_url(), 'refresh');
        }
        
        $data['study_material_info']    = $this->crud_model->select_study_material_info_for_student();
        $data['page_name']              = 'study_material';
        $data['page_title']             = get_phrase('study_material');
        $this->load->view('backend/index', $data);
    }
}