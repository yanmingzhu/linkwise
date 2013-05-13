<?php

class Subscription_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert($uid, $eid) {
        $this->db->insert("Subscription", array("uid" => $uid, "eid" => $eid));

        if ($this->db->affected_rows() != 1) {
            return false;
        }
        else return true;
    }

    public function delete($uid, $eid) {
        $this->db->delete('Subscription', array('uid' => $uid, 'eid' => $eid));
        if ($this->db->affected_rows() != 1) {
            return false;
        }
        else return true;
    }

    static function subscribed_events_by_uid($uid) {
        if (!$uid)
            return array();

        $query = get_instance()->db->query("select eid from Subscription where uid = $uid");

        $events = array();
        foreach ($query->result() as $row) {
            array_push($events, $row->eid);
        }

        return $events;
    }

    static function get_enrollment($eid) {
        $query = get_instance()->db->query("select count(distinct uid) as enrollment from Subscription where eid = $eid");

        $row = $query->row();
        return $row->enrollment;
    }
}