<?php
/**
 * 获取菜单
 *
 * @author : blue
 * @date   : 2013-6-17
 *
 * @desc	菜单操作公共类
 *
 */


class  Menu{

	public function __construct(){
		load_model("rbac/node");
		load_model("rbac/role");
		$this->node = new NodeModel();
		$this->role = new RoleModel();
	}

	/**
	 * 获取当前用户所有权限菜单列表
	 *
	 * @return	array	权限列表
	 */
	public function get_permissions(){
		$uid = '1';
		//获取用户角色列表(支持多个角色)
		$roles = $this->role->getrolesbyuid($uid);
        
		//获取角色菜单名称
		$nodes	= array();
		foreach($roles as $role) {
			$nodes[] = $this->node->getnodesbyrid($role['id']);
		}
		$nodes	= array_unique($nodes);
		return $nodes;
	}

	/**
	 * 根据pid获取子菜单
	 *
	 * @return array()
	 */
	public function getMenuTree($pid = '') {
		$permissions	= $this->get_permissions();
		$menu	= array();
		$i	= 0;
		foreach($permissions[0] as $permission) {
			if($permission['pid'] == $pid) {
				$menu[$i++]	= $permission;
			}
			if(count($menu) == 0) continue;

			$j	= 0;
			foreach($permissions[0] as $permission) {
				if($permission['pid'] == $pid) continue;

				if($menu[$i - 1]['id'] == $permission['pid']) {
					$menu[$i - 1]['child'][$j++]	= $permission;
				}
			}
		}
        $menu = $this->sortdata($menu);
		return $menu;
	}

	//排序
	protected function sortdata($data) {
        $num = count($data);
        for($i=0;$i<$num;$i++){
            for($h=$num-1;$h>$i;$h--){
                if($data[$i]['sort']>$data[$h]['sort']){
                    $current = $data[$i];
                    $data[$i] = $data[$h];
                    $data[$h] = $current;
                }
            }
        }
        return $data;
	}






}
