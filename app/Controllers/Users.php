<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\User as UserModel;

class Users extends ResourceController
{
    /**
    * Return an array of resource objects, themselves in array format
    *
    * @return mixed
    */
    private $db;
    
    public function __construct()
    {
        $this->db = db_connect();
    }
    
    
    public function index()
    {
        $users = $this->db->table('users')->get()->getResult();
        
        $data['users'] = $users;
        
        return view('read_users',$data);
    }
    
    /**
    * Return the properties of a resource object
    *
    * @return mixed
    */
    public function show($id = null)
    {
        
    }
    
    /**
    * Return a new resource object, with default properties
    *
    * @return mixed
    */
    public function new()
    {
        return view('new_user');
    }
    
    /**
    * Create a new resource object, from "posted" parameters
    *
    * @return mixed
    */
    public function create()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'age' => $this->request->getPost('age')
        ];
        
        $result = $this->db->table('users')->insert($data);
        
        $status = ($result) ? 'Record has been inserted :)': 'Record has not been inserted :(';
        
        return redirect()->to(base_url('users'))->with('status', $status);
    }
    
    /**
    * Return the editable properties of a resource object
    *
    * @return mixed
    */
    public function edit($id = null)
    {
        $user = $this->db->table('users')->getWhere(['id'=>$id],1)->getRow();

        $data['user'] = $user;
        
        return view('update_form',$data);
        
    }
    
    /**
    * Add or update a model resource, from "posted" properties
    *
    * @return mixed
    */
    public function update($id = null)
    {
        $user = new UserModel();
        
        $data = [
            'name' => $this->request->getPost('name'),
            'age' => $this->request->getPost('age'),
        ];
        $result = $user->update($id, $data);

        $status = ($result) ? 'Records has been updated :)': 'Records has not been updated :(';
        
        return redirect()->to(base_url('users'))->with('status', $status);
    }
    
    /**
    * Delete the designated resource object from the model
    *
    * @return mixed
    */
    public function delete($id = null)
    {
        $result = $this->db->table('users')->where('id', $id)->delete();
        
        $status = ($this->db->affectedRows()) ? 'Records has been deleted :)': 'Records has not been deleted :(';
        
        return redirect()->to(base_url('users'))->with('status', $status);
    }
}
