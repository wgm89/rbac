<?php
class UserModel extends Model {    
    protected $_db;
    
    function __construct()
    {
        parent::__construct($logger); 

        $this->_db = new Database('***');
        $this->_db->load('**');
    }
    
    
}
