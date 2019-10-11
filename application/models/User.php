<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model
{

    function __construct()
    {
        // Set table name 
        $this->tableName = 'users';
        $this->primaryKey = 'id';
    }
    /*
     * Fetch user data from the database 
     * @param array filter data based on the passed parameters 
     */

    function getRows($params = array())
    {
        $this->db->select('*');
        $this->db->from($this->tableName);

        if (array_key_exists("conditions", $params)) {
            foreach ($params['conditions'] as $key => $val) {
                $this->db->where($key, $val);
            }
        }

        if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
            $result = $this->db->count_all_results();
        } else {
            if (array_key_exists("id", $params) || $params['returnType'] == 'single') {
                if (!empty($params['id'])) {
                    $this->db->where('id', $params['id']);
                }
                $query = $this->db->get();
                $result = $query->row_array();
            } else {
                $this->db->order_by('id', 'desc');
                if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                    $this->db->limit($params['limit'], $params['start']);
                } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                    $this->db->limit($params['limit']);
                }

                $query = $this->db->get();
                $result = ($query->num_rows() > 0) ? $query->result_array() : FALSE;
            }
        }

        // Return fetched data 
        return $result;
    }
    /*
     * Insert user data into the database 
     * @param $data data to be inserted 
     */

    public function insert($data = array())
    {
        if (!empty($data)) {
            // Add created and modified date if not included 
            if (!array_key_exists("modified", $data)) {
                $data['modified'] = date("Y-m-d H:i:s");
            }

            // Insert member data 
            $insert = $this->db->insert($this->tableName, $data);

            // Return the status 
            return $insert ? $this->db->insert_id() : false;
        }
        return false;
    }

    public function checkUser($data = array())
    {
        $this->db->select($this->primaryKey);
        $this->db->from($this->tableName);

        $con = array(
            'oauth_provider' => $data['oauth_provider'],
            'oauth_uid' => $data['oauth_uid']
        );
        $this->db->where($con);

        $query = $this->db->get();

        $check = $query->num_rows();

        if ($check > 0) {
            // Get prev user data
            $result = $query->row_array();

            // Update user data
            $data['modified'] = date("Y-m-d H:i:s");
            $update = $this->db->update($this->tableName, $data, array('id' => $result['id']));

            // user id
            $userID = $result['id'];
        } else {
            // Insert user data
            $data['modified'] = date("Y-m-d H:i:s");
            $insert = $this->db->insert($this->tableName, $data);

            // user id
            $userID = $this->db->insert_id();
        }

        // Return user id
        return $userID ? $userID : false;
    }
}
