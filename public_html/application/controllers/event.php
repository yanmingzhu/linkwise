<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . "libraries/util.php";

class Event extends CI_Controller {
	public function create()
	{
        $uid = get_uid();
        if (!$uid) {
            redirect("/user/signon");
        }

        if (array_key_exists('createvent', $_REQUEST) && $_REQUEST['createvent']) {
            $time = $_REQUEST['time'];
            $title = $_REQUEST['title'];
            $content = $_REQUEST['description'];

            $time_items = explode('/', $time);
            $entry = array(
                'owner' => $uid,
                'start' => $time_items[2] . '-' . $time_items[0] . '-' . $time_items[1],
                'title' => $title,
                'description' => $content
            );
            $event_id = $this->Event_model->insert($entry);

            redirect("/event/show/$event_id", 'refresh');
        }
        else {
            renderPage($this, 'create_event_view');
        }
	}

    public function show($event_id)
    {
        $event = $this->Event_model->get_event_by_id($event_id);
        addUserForEvent($event);

        $subscribed_events = $this->Subscription_model->subscribed_events_by_uid(get_uid());
        if (in_array($event_id, $subscribed_events)) {
            $event->subscribed = true;
        }
        else $event->subscribed = false;
        
        $data['event'] = $event;
        renderPage($this, 'single_event_view', $data);
    }

    public function mine()
    {
        $events = $this->Event_model->get_mine();
        addUserForEventList($events);
        addEnrollmentForEventList($events);
        addSubscribeForEventList($events);
        
        $data['events'] = $events;
        renderPage($this, 'event_list_view', $data);
    }

    public function all()
    {
        $events = $this->Event_model->get_all();
        addUserForEventList($events);
        addEnrollmentForEventList($events);
        addSubscribeForEventList($events);
        
        $data['events'] = $events;
        renderPage($this, 'event_list_view', $data);
    }

    public function hostby($uid)
    {
        $events = $this->Event_model->get_events_host_by($uid);
        addUserForEventList($events);
        addEnrollmentForEventList($events);
        addSubscribeForEventList($events);

        $data['events'] = $events;
        renderPage($this, 'event_list_view', $data);
    }

    public function delete($event_id)
    {
        $this->Event_model->delete($event_id);
        redirect('/');
    }

    public function ondate($date)
    {
        if (strlen($date) != 8) {
            redirect("/");
        }

        $new_date = substr($date, 0, 4) . '-' . substr($date, 4, 2) . '-' . substr($date, 6, 2);
        $events = $this->Event_model->get_event_on_date($new_date);
        addUserForEventList($events);
        addEnrollmentForEventList($events);
        addSubscribeForEventList($events);

        $data['events'] = $events;
        renderPage($this, 'event_list_view', $data);

    }
}
