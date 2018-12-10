<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Privilege;

class PrivilegeController extends Controller{
	//权限列表
	public function ruleList(){
		if(Request()->isMethod('get')){
			$info=Privilege::getRule();
			return view('Privilege/admin-rule',['info'=>$info]);
		}
	}
	//权限新增
	public function ruleAdd(){
		if(Request()->isMethod('get')){
			return view('Privilege/rule-add');
		}elseif(Request()->isMethod('post')){
			$result=Privilege::rule_add(Request()->only('auth_name','auth_rule'));
			if($result['status']==200){
				return redirect('ruleList')->with('msg',$result['message']);
			}else{
				return redirect('ruleList')->with('msg',$result['message']);
			}
		}
	}
	//权限修改
	public function ruleEdit(){
		if(Request()->isMethod('get')){
			$info=Privilege::rule_edit(Request()->only('id'));
			return view('Privilege/rule-add',['info'=>$info]);
		}elseif(Request()->isMethod('post')){
			$result=Privilege::rule_update(Request()->only('id','auth_rule','auth_name'));
			if($result['status']=200){
				return redirect('ruleList')->with('msg',$result['message']);
			}else{
				return redirect('ruleList')->with('msg',$result['message']);
			}
		}
	}
	//删除权限
	public function ruleDel(){
		$result=Privilege::rule_del(Request()->only('id'));
		if($result['status']==200){
			return redirect('ruleList')->with('msg',$result['message']);
		}else{
			return redirect('ruleList')->with('msg',$result['message']);
		}
	}

	//角色列表
	public function roleList(){
		if(Request()->isMethod('get')){
			$info=Privilege::getRole();
			return view('Privilege/admin-role',['info'=>$info]);
		}
	}
	//新增角色
	public function roleAdd(){
		if(Request()->isMethod('get')){
			$rule=Privilege::getRule();//获取权限信息
			return view('Privilege/role-add',['rule'=>$rule]);
		}elseif(Request()->isMethod('post')){
			$result=Privilege::role_add(Request()->only('role_name'));
			if($result['status']=200){
				return redirect('roleList')->with('msg',$result['message']);
			}else{
				return redirect('roleList')->with('msg',$result['message']);
			}
		}
	}
	//为角色设置权限
	public function setRule(){
		if(Request()->isMethod('get')){
			$rule=Privilege::set_rule();//展示所有的权限信息
			$rid=Request()->only('id');
			return view('Privilege/setRule',['rule'=>$rule,'rid'=>$rid]);//将信息返回
		}elseif(Request()->isMethod('post')){
			$result=Privilege::add_role_rule(Request()->only('auth_id','id'));//调用添加权限方法
			if($result['status']==200){
				return redirect('roleList')->with('msg',$result['message']);
			}else{
				return redirect('roleList')->with('msg',$result['message']);
			}
		}
	}
	//角色删除
	public function roleDel(){
		$result=Privilege::role_del(Request()->only('id'));
		if($result['status']==200){
			return redirect('roleList')->with('msg',$result['message']);
		}else{
			return redirect('roleList')->with('msg',$result['message']);
		}
	}
	//角色修改
	public function roleEdit(){
		if(Request()->isMethod('get')){
			$id=Request()->only('id');//角色id
			$info=Privilege::role_edit(Request()->only('id'));//查询要修改的信息
			$auth=Privilege::set_rule();//查询所有权限信息
		/*	$ids="";
			for ($i=0; $i <count($auth); $i++) { 
				$array[]=array('auth_id'=>$auth[$i]->auth_id);
				$ids.=$array[$i]['auth_id'].',';
			}
			$ids=explode(',',rtrim($ids,','));//所有权限id*/
			$rule=Privilege::get_rule(Request()->only('id'));//查询该角色拥有的权限
			return view('Privilege/role-edit',['auth'=>$auth,'info'=>$info,'rule'=>$rule,'id'=>$id]);
		}elseif(Request()->isMethod('post')){
			$result=Privilege::role_update(Request()->only('auth_id','role_name','id'));
			if($result['status']==200){
				return redirect('roleList')->with('msg',$result['message']);
			}else{
				return redirect('roleList')->with('msg',$result['message']);
			}
		}
	}
}