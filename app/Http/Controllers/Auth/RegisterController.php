<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Model\UserDetails;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
      // dd(date('d-m-Y'));exit;
      // echo 'kkkkkkkkk';exit;
      $otp =  rand(10000,99999);
         $result = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        UserDetails::create([
          'user_id' => $result->id,
          'city' => $data['city'],
          'otp' =>$otp,
          'dob' => date('Y-m-d')]);

// send mail
          	if(Request::isMethod('post')) {
        			require '../vendor/autoload.php';													// load Composer's autoloader

        			$mail = new PHPMailer(true);                            // Passing `true` enables exceptions
        			try {
        				// Server settings
        	    	$mail->SMTPDebug = 0;                                	// Enable verbose debug output
        				$mail->isSMTP();                                     	// Set mailer to use SMTP
        				$mail->Host = 'smtp.gmail.com';												// Specify main and backup SMTP servers
        				$mail->SMTPAuth = true;                              	// Enable SMTP authentication
        				$mail->Username = 'aswanthkr1997@gamil.com';             // SMTP username
        				$mail->Password = '********';              // SMTP password
        				$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        				$mail->Port = 587;
                $mail->CharSet = "UTF-8";                              // TCP port to connect to

        				//Recipients
        				$mail->setFrom('aswanthkr1997@gamil.com', 'Mailer');
        				$mail->addAddress('aswanthkr@gmail.com', 'Optional name');	// Add a recipient, Name is optional
        				$mail->addReplyTo('aswanthkr1997@gamil.com', 'Mailer');
        				$mail->addCC('aswanthkr@gmail.com');
        				$mail->addBCC('aswanthkr@gmail.com');

        				//Attachments (optional)
        				// $mail->addAttachment('/var/tmp/file.tar.gz');			// Add attachments
        				// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');	// Optional name

        				//Content
        				$mail->isHTML(true); 																	// Set email format to HTML
                $mail->Subject = 'OTP for user module login';
                $mail->Body    = 'Your OTP is'.$otp;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        				$mail->send();
        				echo back()->with('success','Message has been sent!');exit;
        			} catch (Exception $e) {
                echo $e->getMessage();exit;
        				echo back()->with('error','Message could not be sent.');exit;
        			}
        		}

        return $result;
    }
}
