<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Login extends Controller
{
  public function index()
  {
    return $this -> fetch();
  }
  public function login()
  {
    if (request() -> isPost()) {
        $data = [
          'admin_name' => input('admin_name'),
          'password' => input('password'),
        ];
        $sel = Db::name('admin') -> select();
        if ($data['admin_name'] == $sel['admin_name']) {
          if ($data['password'] == $sel['password']) {
            $this -> success('登陆成功，正在跳转...','index/index');
          }else{
            $this -> error('密码错误！');
          }
        }else{
          $this -> error('该用户不存在！');
        }
        return $this -> fetch('login');
      }
    }
}
