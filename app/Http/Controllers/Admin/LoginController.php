<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Admin\AdminServer;
use App\Http\Requests\Admin\AdminLoginRequest;

class LoginController extends Controller
{
    
    protected $AdminServer;
    
    public function __construct(AdminServer $adminServer){
        $this->AdminServer=$adminServer;
    }
    
    /**
     * 登录页面
     * method get
     * url  admin/login
     * **/
    public function index(Request $request){
        return view('admin.index.login');
    }
    
    /**
     * 登录操作
     * method post
     * url admin/login-handle
     * **/
    public function login(AdminLoginRequest $request){
        
        return $this->AdminServer->Login($request);
    }
    
    /**
     * 退出登录
     * method  GET|HEAD|POST|PUT|PATCH|DELETE|OPTIONS
     * url  admin/admin-handle
     * **/
    public function logout(Request $request){
        $this->AdminServer->logout($request);
        return redirect()->route('admin.login');
    }
    
}

