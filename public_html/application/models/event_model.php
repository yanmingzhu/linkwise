<?php

class Event_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_all()
    {
        $query = $this->db->get('Event');
        return $query->result();
    }

    function get_events_host_by($uid)
    {
        $query = $this->db->query("select * from Event where owner = $uid");
        return $query->result();
    }

    function get_recent_six()
    {
        $query = $this->db->get('Event', 6);
        return $query->result();
    }

    function insert($entry)
    {
     //   $entry["title"] = $this->db->escape($entry["title"]);
 //       $entry["description"] = mysqli_real_escape_string($entry["description"]);
        error_log(print_r($entry["description"], true));

        $this->db->insert("Event", $entry);
        
        return $this->db->insert_id();
    }

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['description'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }

    function get_event_by_id($event_id)
    {
        $query = $this->db->query("select * from Event where id = '$event_id' ");

        return $query->row();
    }

    function delete($event_id)
    {
        $this->db->query('delete from Event where ID = ' . $event_id);
    }


    function get_mine()
    {
        $uid = get_uid();
        if (!$uid) return get_all();

        $query = $this->db->query("select * from Event where id in (select eid from Subscription where uid = $uid)");
        return $query->result();
    }

    function get_event_on_date($date)
    {
        $query = $this->db->query("select * from Event where DATE(start) = '$date'");
        return $query->result();
    }
}