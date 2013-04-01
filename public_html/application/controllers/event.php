<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends CI_Controller {


	public function create()
	{
        if (array_key_exists('createvent', $_REQUEST) && $_REQUEST['createvent']) {
            $year = $_REQUEST['year'];
            $month = $_REQUEST['month'];
            $day = $_REQUEST['day'];
            $title = $_REQUEST['title'];
            $content = $_REQUEST['description'];

            $entry = array(
                'owner' => 'unknown',
                'start' => $year . '-' . $month . '-' . $day,
                'title' => $title,
                'description' => $content
            );
            $this->eventmodel->insert($entry);

            redirect('http://www.linkwise.org/', 'refresh');
        }

        $this->load->view('templates/header');

        $this->load->view('eventcreate');

        $this->load->library('calendar');
        $data['calendar'] = $this->calendar->generate();
        $data['events'] = $this->eventmodel->get_recent_six();
		$this->load->view('sidebar', $data);

        $this->load->view('templates/footer');
	}

    public function delete($event_id)
    {
        $this->eventmodel->delete($event_id);
        redirect('/');
    }
}
