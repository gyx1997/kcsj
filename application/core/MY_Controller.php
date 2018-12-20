<?php
/**
 * Created by PhpStorm.
 * User: 52297
 * Date: 2018/12/20
 * Time: 14:48
 */

/**
 * Class MY_Controller 所有控制器的基类
 */
class MY_Controller extends CI_Controller
{
	private $_roleAccess = array(

	);

	/**
	 * @var int 当前登录的用户id
	 */
	private $_loggedInUserId = 0;
	/**
	 * @var string 当前接收到的redirect参数
	 */
	private $_paramRedirect = '';

	/**
	 * MY_Controller constructor.
	 */
	public function __construct(){
		parent::__construct();
		//加载会话类
		$this->load->library('session');
		$this->checkLogin();
		//检查redirect参数
		$this->_paramRedirect = $this->input->get('redirect');
	}

	/**
	 * 检查是否已经登陆
	 */
	public function checkLogin() : void{
		$user_id = $this->session->userdata('logged_in_user_id');
		isset($user_id) && $this->_loggedInUserId = $user_id;
	}

	/**
	 * 登录
	 * @param array $userId	 需要设置为当前登录用户的用户id
	 */
	public function login(array $userId) : void{
		$this->session->set_userdata('logged_in_user_id', $userId);
	}

	/**
	 * 判断当前是否已经登录
	 * @return bool
	 */
	public function loggedIn() : bool{
		return $this->_loggedInUserId === 0;
	}

	/**
	 * 登出系统
	 */
	public function logout() : void {
		$this->session->sess_destroy();
		$this->redirectTo($this->_paramRedirect);
	}

	/**
	 * 跳转到指定的页面
	 * @param string $target
	 */
	public function redirectTo(string $target) : void {
		header('location:' . $target);
		exit(0);
	}

	/**
	 * 获取当前请求的完整URL
	 * @return string
	 */
	protected function _get_url(): string
	{
		$sys_protocol = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
		$php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
		$path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
		$relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self . (isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : $path_info);
		return $sys_protocol . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '') . $relate_url;
	}
}
