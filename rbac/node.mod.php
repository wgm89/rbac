<?php
/**
 * node table manage 
 *
 * author : blue 
 * date   : 2013-6-17
 */
class NodeModel extends Model{
	const NODE = 'node';
	const NODEROLE = 'access';
	protected $config_func = 'bbs_get_db_config';
	protected $config_table = 'node';
	protected static $nodedb;
	public function  __construct(){
		parent::__construct();	
		self::$nodedb = self::getinstance();
	}
	public static function getinstance(){
		if(!isset($nodedb)||empty($nodedb)){
			self::$nodedb = new Database('bbs_get_db_config');
			self::$nodedb->load('xy');
			return self::$nodedb;
		}
		return  self::$nodedb;
	}
	//得到所有node
	public function getallnodes(){
		$nodedb = self::getinstance();
		$nodes = $nodedb->getRows("select * from ".self::NODE);
		return $nodes;
	}
	//根据nid 得到所有controller 
	public function getnodesbyrid($rid){
		$nodedb = self::getinstance();
		$this->allnodes = $this->getallnodes();
		$this->role_nodes = array();
		$nodes = $nodedb->getRows("select * from ".self::NODEROLE." where `role_id` = '{$rid}'");
		foreach($this->allnodes as $allnodes_val){
			foreach($nodes as $node){
				if($allnodes_val['id']==$node['node_id']){
					$this->role_nodes[$allnodes_val['id']] = $allnodes_val;
					$this->findnodesinallnodes($allnodes_val);
				}
			}
		}
		return $this->role_nodes;
	}

	protected function findnodesinallnodes($node){
		foreach($this->allnodes as $allnodes_val){
			if($allnodes_val['pid']==$node['id']){
				$this->role_nodes[$allnodes_val['id']] = $allnodes_val;
				$this->findnodesinallnodes($allnodes_val);
			}
		}
	}
    public function addnode($data){
        return $this->add($data);
    }

    public function getnodebyid($id){
        $result = $this->where(array('id'=>$id))->select();
        return $result[0];
    }
    public function updatebyid($id,$data){
        return $this->save($data,array('id'=>$id));
    }

    public function getnodelistbypid($id){
        $result = $this->where(array('pid'=>$id))->select();
        return $result;
    }


}
