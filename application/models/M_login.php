<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

	public function login($username, $password)
	{
		
		$query = $this->db->where('username',$username)
		->where('password',$password)
		->where('user.status_user=', 1)
		->from('user')
		->join('user_level','user_level.level_id=user.level_id')
		->limit(1)
		->get();
        return $query;
	}
}