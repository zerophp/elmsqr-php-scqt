<?php

class Application_Model_DbTable_Users extends Zend_Db_Table_Abstract
{
    protected $_name = 'users';

    public function getUser($iduser)
    {
        $iduser = (int)$iduser;
        $row = $this->fetchRow('iduser = ' . $iduser);
        if (!$row) {
        throw new Exception("Could not find row $iduser");
        }
        return $row->toArray();
    }
    
    public function addUser($name, $email, $password, $description, $address,
                            $cities_idcity, $pets, $photo, $genders_idgender)
    {
        $data = array(
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'description' => $description,
            'address' => $address,
            'cities_idcity' => $cities_idcity,
            'pets' => implode(',',$pets),
            'photo' => $photo,
            'genders_idgender' => $genders_idgender,
        );
        $this->insert($data);
    }
    
    public function updateUser($iduser, $name, $email, $description, $address,
                            $cities_idcity, $pets, $photo, $genders_idgender)
    {
        $data = array(
            'name' => $name,
            'email' => $email,
            'description' => $description,
            'address' => $address,
            'cities_idcity' => $cities_idcity,
            'pets' => implode(',',$pets),
            'photo' => $photo,
            'genders_idgender' => $genders_idgender,
        );
        $this->update($data, 'iduser = '. (int)$iduser);
    }
    
    public function deleteUser($id)
    {
        $this->delete('iduser =' . (int)$id);
    }
}
