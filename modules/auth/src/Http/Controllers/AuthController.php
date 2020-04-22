<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/30/2017
 * Time: 11:57 PM
 */

namespace Auth\Http\Controllers;

use Base\Supports\FlashMessage;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;
use Auth\Http\Requests\ValidateSecretRequest;
use Auth\Http\Requests\AuthRequest;
use Barryvdh\Debugbar\Controllers\BaseController;
use Auth\Supports\Traits\Auth;
use Illuminate\Support\Facades\Log;
use Mail\Repositories\MailRepository;
use Users\Http\Requests\UserChangePassRequest;
use Users\Repositories\ResetPassRepositories;
use Users\Repositories\UsersRepository;

class AuthController extends BaseController
{
	use Auth;
	
	/**
	 * AuthController constructor.
	 */
	protected $reset;
    protected $mail;
    protected $user;

	public function __construct(ResetPassRepositories $resetPassRepositories, MailRepository $mailRepository, UsersRepository $userRepository)
	{
		$this->middleware('guest', ['except' => ['getLogout']]);
		$this->reset = $resetPassRepositories;
		$this->mail = $mailRepository;
		$this->user = $userRepository;
		$this->redirectTo = route('lito::dashboard.index.get');
		$this->redirectPath = route('lito::dashboard.index.get');
		$this->redirectToLoginPage = route('lito::auth.login.get');
	}
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getForgot()
    {
	    return view('lito-auth::forgot');
    }

    public function postForgot(Request $request)
    {
	    $email = $request->get('email');
	    $username = $this->user->findWhere(['email'=>$email])->first();
       // dd($username);
	    $token = md5($email);
	    $data = [
	        'email' => $email,
            'token' => $token
        ];
	    try{
	        if(!empty($username)){
                $this->reset->create($data);
                $this->mail->sendMail('forgot_pass',$email,['email'=>$email,'token'=>$token]);
                return redirect()->route('lito::auth.login.get')->with(['message'=>'Một email được gửi tới '.$email.' chứa thông tin lấy lại mật khẩu, vui lòng kiểm tra email']);
            }else{
	            return redirect()->back()->with(['message'=>'Không tồn tại email trong hệ thống !']);
            }

        }catch (\Exception $e){
            Log::error($e->getMessage());
	        return redirect()->back()->with(FlashMessage::returnMessage($e->getMessage()));
        }
    }

    public function resetPass(Request $request)
    {
	    $token = $request->get('token');
	    $email = $request->get('email');
        $token_user = $this->reset->findWhere(['token'=>$token,'email'=>$email]);
	    if(!empty($token_user)){
	        $userFind = $this->user->findWhere(['email'=>$email])->first();
            return view('lito-auth::reset',['user_change'=>$userFind]);
        }else{
	        return redirect()->route('lito::auth.login.get')->with(['message' => 'Lỗi']);
        }
    }

    public function postResetPass(UserChangePassRequest $request){
	    $id = $request->get('id');
	    $password = $request->get('password');
        $data = [
            'password' => $password
        ];
        try{
            $this->user->update($data,$id);
            return redirect()->route('lito::auth.login.get')->with(['message'=>'Đổi mật khẩu thành công !']);
        }catch (\Exception $e){
            return redirect()->back()->with(FlashMessage::returnMessage($e->getMessage()));
        }
    }

	public function getLogin()
	{
		return view('lito-auth::login');
	}
	
	/**
	 * @param \Auth\Http\Requests\AuthRequest $request
	 *
	 * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
	 */
	public function postLogin(AuthRequest $request)
	{
		return $this->login(request());
	}
	
	/**
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getLogout()
	{
        do_action('lito_before_user_logged_out','','Đăng xuất','Quản trị');

		$this->guard()->logout();
		
		session()->flush();
		
		session()->regenerate();
		
		return redirect()->to($this->redirectToLoginPage);
	}
	
	/**
	 * Overwrite authenticated method
	 * First logout user and store user to session
	 * Then update secret key
	 *
	 * @param \Illuminate\Http\Request                   $request
	 * @param \Illuminate\Contracts\Auth\Authenticatable $user
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	private function authenticated(Request $request, Authenticatable $user)
	{
		if ($user->google2fa_secret) {
			$this->guard()->logout();

			$request->session()->put('2fa:user:id', $user->id);
			return redirect()->route('lito::2fa.validate.get');
		}
		
		return redirect()->intended($this->redirectTo);
	}
	
	public function getValidateToken()
	{
		if (session('2fa:user:id')) {
			return view('lito-auth::validate');
		}

		return redirect()->to($this->redirectToLoginPage);
	}
	
	public function postValidateToken(ValidateSecretRequest $request)
	{
		//get user id and create cache key
		$userId = $request->session()->pull('2fa:user:id');
		$key    = $userId . ':' . $request->totp;
		
		//use cache to store token to blacklist
		Cache::add($key, true, 4);
		
		//login and redirect user
		$this->guard()->loginUsingId($userId);
		
		return redirect()->intended($this->redirectTo);
	}
}
