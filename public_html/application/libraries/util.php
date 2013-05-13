<?php

require_once 'facebook.php';

function get_uid()
{
    if (!array_key_exists('uid', $_COOKIE)) {
        return null;
    }
    
    $uid = $_COOKIE['uid'];

    if ($uid) {
        return $uid;
    }
    else return null;
}

function renderPage($controller, $view, $data = null)
{
    renderHeader($controller);
    
    $controller->load->view($view, $data);

//    $prefs = array('show_next_prev' => true);
//    $controller->load->library('calendar', $prefs);

    if (!$data) {
        $data = array();
    }
//    $data['calendar'] = $controller->calendar->generate();
//   $data['events'] = $controller->Event_model->get_recent_six();
    $data['uid'] = get_uid();
    $controller->load->view('sidebar_view', $data);

    $controller->load->view('templates/footer');

}

function renderHeader($controller)
{
    $data['user_name'] = User_model::get_name_by_id(get_uid());
    $controller->load->view('templates/header', $data);
}

function addUserForEvent($event)
{
    $event->owner_name = User_model::get_name_by_id($event->owner);
}

function addUserForEventList($events)
{
    foreach ($events as $event) {
        addUserForEvent($event);
    }
}

function addEnrollmentForEvent($event) {
    $event->enrollment = Subscription_model::get_enrollment($event->id);
}

function addEnrollmentForEventList($events)
{
    foreach ($events as $event) {
        addEnrollmentForEvent($event);
    }
}

function addSubscribeForEvent($event) {
    $subscribed_events = Subscription_model::subscribed_events_by_uid(get_uid());
    if (in_array($event->id, $subscribed_events)) {
        $event->subscribed = true;
    }
    else $event->subscribed = false;
}

function addSubscribeForEventList($events) {
    foreach ($events as $event) {
        addSubscribeForEvent($event);
    }
}