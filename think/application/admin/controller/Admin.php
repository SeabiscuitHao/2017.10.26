<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Admin extends Controller
{
  public function index()
  {
    return $this -> fetch();
  }

  public function lst()
  {
    $list = Db::name('admin') -> paginate(3);
    $this -> assign('list',$list);
    return $this -> fetch('lst');
  }

  public function add()
  {
    $data=[
      'admin_name' => input('admin_name'),
      'password' => input('password'),
    ];
    if (request() -> isPost()) {
      $save = Db::name('admin') -> insert($data);
      if ($save) {
        $this -> success('添加管理员成功！','lst');
      }else{
        $this -> error('添加管理员失败！');
      }
    }
    return $this -> fetch('add');
  }

  public function edit()
  {
    $id = input('id');
    $admin = Db::name('admin') -> find($id);
    $this -> assign('admin',$admin);
    if (request() -> isPost()) {
      $data = [
        'admin_name' => input('admin_name'),
        'password' => input('password'),
      ];
      $edit = Db::name('admin') -> where('id','=',$id) -> update($data);
      if ($edit) {
        $this -> success('修改管理员信息成功！','lst');
      }else{
        $this -> error('修改管理员信息失败！');
      }
    }
    return $this -> fetch('edit');
  }

  public function del()
  {
    $id = input('id');
    if ($id) {
      $del = Db::name('admin')-> where('id','=',$id) -> delete();
      $this -> success('删除管理员成功！','lst');
    }else{
      $this -> error('删除管理员失败！');
    }
    return $this -> fetch('del');
  }
}
