<?php
/**
 * role table manage
 * 
 * author : blue 
 * date   : 2013-6-17
 */
class RoleModel extends Model{

	const ROLE = 'role';
	const ROLEUSER  = 'role_user';
	protected $config_table = 'role';
	protected static $roledb;
	public function  __construct(){
		parent::__construct();	
		self::$roledb = self::getinstance();
	}
	public static function getinstance(){
		if(!isset($roledb)||empty($roledb)){
			self::$roledb = new Database('***');
			self::$roledb->load('***');
			return self::$roledb;
		}
		return  self::$roledb;
	}
	public function  addrole($name,$pid,$remark){
        return $this->add(array('name'=>$name,'pid'=>$pid,'remark'=>$remark));
	}
	public function delrole(){
	
	}
	public function updaterole($id,$data){
	    return $this->save($data,array('id'=>$id));
	}
	
	//得到所有role
	public function getallroles(){
		$roledb = self::getinstance();
		$roles = $roledb->getRows("select * from ".self::ROLE);
		return $roles;
	}

	//根据uid 获得其role
	public function getrolesbyuid($uid){
		#$this->getrolemaxid();
		$roledb = self::getinstance();
		$this->allroles  = $this->getallroles();
		$this->user_roles = array();
		$roles = $roledb->getRows("select * from ".self::ROLEUSER." where `user_id` = '{$uid}'");
		foreach($this->allroles as $allroles_val){
			foreach($roles as $role){
				if($allroles_val['id']===$role['role_id']){
					$this->user_roles[] = $allroles_val;
					$this->findroleinallroles($allroles_val);
				}
			}	
		}
		return $this->user_roles;

	}
    //根据id 获取role
    public function getrolebyid($id){
        $result = $this->where(array('id'=>$id))->select();
        return $result[0];
    }
    public function deletebyid($id){
        return $this->del(array('id'=>$id));
    }
	protected function findroleinallroles($role){
		foreach($this->allroles as $allroles_val){
			if($allroles_val['pid']==$role['id']){
				$this->user_roles[] = $role;
				$this->findroleinallroles($allroles_val);
			}
		}
	}
	

}
