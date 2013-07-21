<?php
/**
 * access model
 *
 * author : blue 
 * date   : 2013-6-19
 */
class AccessModel extends Model{
    public function __construct(){
        parent::__construct();
    }
    protected $config_func = 'bbs_get_db_config';
    protected $config_table = 'access';

    //添加 role,node 关联
    public function addaccess($data){
        return $this->add($data);
        
    }
    //获取所有数据
    public function getall(){
        return $this->select();
    }
}

