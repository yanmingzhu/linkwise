<?php

class User_model extends CI_Model {

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

    function is_fb_user_exist($fbuid)
    {
        $query = $this->db->query("select * from FBUser where id = $fbuid");
        if ($query->num_rows() > 0) {
            return true;
        }
        else return false;
    }

    function get_info_for_fb($fbuid)
    {
        $query = $this
    }
}