<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . 'libraries/facebook.php';


class Welcome extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        date_default_timezone_set("America/Los_Angeles");
        $this->load->view('templates/header');

        $data['events'] = $this->event_model->get_all();
        $this->load->view('main2', $data);

        $this->load->library('calendar');
        $data['calendar'] = $this->calendar->generate();
        $data['events'] = $this->event_model->get_recent_six();
		$this->load->view('sidebar', $data);
        
        $this->load->view('templates/footer');
	}

    public function fblogin()
    {
        $facebook = new Facebook(array(
                                      'appId'  => '447748618615363',
                                      'secret' => '3730fc514f13b5723c186152acdc1ef0',
                                 ));

        $fbuid = $facebook->getUser();
        if ($fbuid) {
            if (!$this->user_model->is_fb_user_exist($fbuid)) {
               $userInfo = $facebook->api('/' . $fbuid);
               $this->user_model->create(1, $fbuid, $userInfo['name']);
            }

            $uid = $this->user_model->get_uid_for_fb('$fbuid');
            $this->session->set_userdata('uid', $uid);
            $this->session->set_userdata('username', $name);
        }
        $this->index();
    }

    public function signout()
    {
        $this->session->sess_destroy();
        redirect('http://www.linkwise.org/');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */