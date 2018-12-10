<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin;
use App\Model\Privilege;
use Session;
class AdminController extends Controller{
	//登陆
	public function login(){
		if(Request()->isMethod('get')){
			return view('Admin/login');
		}elseif(Request()->isMethod('post')){
			$result = Admin::admin_login(Request()->only('username','password'));
			if($result['status']==200){
				return redirect('index');
			}else{
				return redirect('login')->with('msg',$result['message']);
			}
		}
	}
	//退出
	public function login_out(){
		$result = Admin::loginout();
		if($result['status']==200){	
			return redirect('login');
		}
	}
	//主页--欢迎
	public function welcome(){
		return view('Admin/welcome');
	}
	//后台管理员列表
	public function adminList(){
		$result=Admin::admin_list();
		return view('Admin/adminList',['info'=>$result]);
	}
	//首页
	public function index(){
		if(Request()->isMethod('get')){
			return view('Admin/index');
		}
	}
	//添加管理员
	public function addAdmin(){
		if(Request()->isMethod('get')){
			$role=Privilege::getRoles();//获取所有角色
			return view('Admin/admin-add',['role'=>$role]);
		}elseif(Request()->isMethod('post')){
			$result=Admin::admin_add(Request()->only('username','password','repass','role'));
			if($result['status']==200){
				return redirect('adminList')->with('msg',$result['message']);
			}else{
				return redirect('adminList')->with('msg',$result['message']);
			}
		}
	}
	//管理员删除---但是不能删除超级管理员
	public function delAdmin(){
		$result=Admin::admin_delete(Request()->only('id'));
		if($result['status']==200){
			return redirect('adminList')->with('msg',$result['message']);
		}else{
			return redirect('adminList')->with('msg',$result['message']);
		}
	}
	//管理员修改
	public function adminEdit(){
		if(Request()->isMethod('get')){
			$info=Admin::getAdmin(Request()->only('id'));//要修的管理员的信息
			$role=Privilege::getRole();//获取所有的角色信息
			return view('Admin/admin-edit',['info'=>$info,'role'=>$role]);
		}elseif(Request()->isMethod('post')){
			$result=Admin::admin_edit(Request()->only('id','username','password','repass','role_name'));
			if($result['status']==200){
				return redirect('adminList')->with('msg',$result['message']);
			}else{
				return redirect('adminList')->with('msg',$result['message']);
			}
		}
	}
}