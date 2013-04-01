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

    function get_recent_six()
    {
        $query = $this->db->get('Event', 6);
        return $query->result();
    }

    function insert($entry)
    {
        $this->db->insert('Event', $entry);
    }

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['description'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }

    function delete($event_id)
    {
        $this->db->query('delete from Event where ID = ' . $event_id);
    }
}