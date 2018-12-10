<?php
namespace App\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Session;

class Privilege{
	//展示权限列表
	public static function getRule(){
		$result['dataList']=DB::table('back_auth')->paginate(4);
		$result['count']=count($result['dataList']);
		return $result;
	}
	//新增权限
	public static function rule_add($info){
		$rules=array(
			'auth_name'=>$info['auth_name'],
			'auth_rule'=>$info['auth_rule'],
			'create_time'=>date('Y-m-d H:i:s')
		);
		$res=DB::table('back_auth')->insert($rules);
		if($res){
			$result['status']=200;
			$result['message']='新增权限成功';
		}else{
			$result['status']=300;
			$result['message']='新增失败';
		}
		return $result;
	}
	//权限修改--查
	public static function rule_edit($id){
		$result=DB::table('back_auth')->where('auth_id',$id)->orderBy('id')->first();
		return $result;
	}
	//权限修改--改
	public static function rule_update($info){
		$rules=array(
			'auth_name'=>$info['auth_name'],
			'auth_rule'=>$info['auth_rule'],
			'update_time'=>date('Y-m-d H:i:s')
		);
		$res=DB::table('back_auth')->where('auth_id',$info['id'])->update($rules);
		if($res){
			$result['status']=200;
			$result['message']='修改权限信息成功';
		}else{
			$result['status']=300;
			$result['message']='修改权限信息失败';
		}
		return $result;
	}
	/**
	*删除权限
	*@param $id--要删除的权限id
	*@param $del--删除角色权限表中的权限信息
	*@param $res--删除权限表中的信息
	*/
	public static function rule_del($id){
		$del=DB::table('back_role_auth')->where('auth_id',$id)->delete();
		if($del){
			$res=DB::table('back_auth')->where('auth_id',$id)->delete();
			if($res){
				$result['status']=200;
				$result['message']='删除权限成功';
			}else{
				$result['status']=200;
				$result['message']='删除权限失败';
			}
		}
		return $result;
	}
	//角色列表
	public static function getRole(){
		$result['dataList']=DB::table('back_role')->paginate(3);
		$result['count']=count($result['dataList']);
		return $result;
	}
	//获取所有角色信息
	public static function getRoles(){
		$result=DB::table('back_role')->get();
		return $result;
	}
	//新增角色
	public static function role_add($info){
		$role=array('role_name'=>$info['role_name'],'create_time'=>date('Y-m-d H:i:s'));
		$res=DB::table('back_role')->insert($role);
		if($res){
			$result['status']=200;
			$result['message']='添加角色成功';
		}else{
			$result['status']=300;
			$result['message']='添加角色失败';
		}
		return $result;
	}
	//查询所有权限
	public static function set_rule(){
		$result=DB::table('back_auth')->get();
		return $result;
	}
	/**
	*为角色添加权限
	*@param $array['id']角色id
	*@param $array['auth_id']权限表中所有权限
	*/
	public static function add_role_rule($array){
		$length = count($array['auth_id']); //选择权限的个数
		for($i=0;$i<$length;$i++){
			$datas[] = array('role_id'=>$array['id'],'auth_id'=>$array['auth_id'][$i]);
		}
		DB::table('back_role_auth')->where('role_id',$array['id'])->delete();//防止数据重复
		$res = DB::table('back_role_auth')->insert($datas);
		if($res){
			$result['status']=200;
			$result['message']='设置权限成功';
		}else{
			$result['status']=300;
			$result['message']='设置权限失败';
		}
		return $result;
	}
	/**
	*删除角色
	*@param $id---要删除的角色id
	*@param $del--删除角色权限表中的信息
	*@param $res--删除用户角色表中的信息
	*@param $re---删除角色表中信息
	*/
	public static function role_del($id){
		$del=DB::table('back_role_auth')->where('role_id',$id)->delete();
		if($del){//如果成功删除角色权限表中的信息,则开始删除用户角色表中的信息
			$res=DB::table('back_user_role')->where('rid',$id)->delete();
			if($res){//如果成功删除用户角色表中信息,则删除角色中的信息
				$re=DB::table('back_role')->where('rid',$id)->delete();
				if($re){
					$result['status']=200;
					$result['message']='删除角色信息成功';
				}
			}
		}else{
			$result['status']=300;
			$result['message']='删除角色信息失败';
		}
		return $result;
	}
	//修改角色--查
	public static function role_edit($info){
		//查询要修改的角色信息
		$result=DB::table('back_role')->select('role_name')->where('rid',$info['id'])->first();
		return $result;
	}
	//修改角色--查询角色拥有的权限
	public static function get_rule($info){
		$id=$info['id'];
		$sql="select * from back_role_auth where role_id = $id order by id";
		$result=DB::select($sql);
		return $result;
	}
	//修改角色--修改
	public static function role_update($info){
		$length=count($info['auth_id']); //选择权限的个数
		for($i=0;$i<$length;$i++){
			$datas[]=array('role_id'=>$info['id'],'auth_id'=>$info['auth_id'][$i]);
		}
		//防止数据重复.删除已经存在的权限
		DB::table('back_role_auth')->where('role_id',$info['id'])->delete();
		//将权限信息入库
		DB::table('back_role_auth')->insert($datas);
		//修改角色表中数据库
		$roles=array(
			'role_name'=>$info['role_name'],
			'update_time'=>date('Y-m-d H:i:s')
		);
		$res=DB::table('back_role')->where('rid',$info['id'])->update($roles);
		if($res){
			$result['status']=200;
			$result['message']='修改角色信息成功';
		}else{
			$result['status']=300;
			$result['message']='修改角色信息失败';
		}
		return $result;
	}
}