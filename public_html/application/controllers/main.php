<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . 'libraries/facebook.php';
require_once APPPATH . 'libraries/util.php';


class Main extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        $this->allEvents();
	}

    public function allEvents()
    {
        $events = $this->Event_model->get_all();
        addUserForEventList($events);
        addEnrollmentForEventList($events);
        addSubscribeForEventList($events);
        
        $data['events'] = $events;
        renderPage($this, 'event_list_view', $data);
        //phpinfo();
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
        }
        $this->index();
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */