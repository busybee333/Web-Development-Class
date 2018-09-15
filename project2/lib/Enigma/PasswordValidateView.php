<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/17/2018
 * Time: 11:00 PM
 */

namespace Enigma;


class PasswordValidateView extends View
{

    /**
     * IndexView constructor.
     * @param System $system The System object
     */
    public function __construct(System $system, Site $site, $get) {
        parent::__construct($system, View::NEWUSER);
        $this->get = $get;
        $this->validator = strip_tags($get['v']);
        //$system->clear();

        if(isset($get['e'])){
            if($get['e'] == self::VALIDATOR){
                $this->error = self::VALIDATOR_ERROR;
            } elseif($get['e'] == self::INVALID_USER){
                $this->error = self::INVALID_USER_ERROR;
            } elseif($get['e'] == self::EMAIL){
                $this->error = self::EMAIL_ERROR;
            } elseif($get['e'] == self::PASSWORDS){
                $this->error = self::PASSWORDS_ERROR;
            } elseif($get['e'] == self::PASSWORD_TOO_SHORT){
                $this->error = self::PASSWORD_TOO_SHORT_ERROR;
            } elseif($get['e'] > self::PASSWORD_TOO_SHORT) {
                $this->error = self::UNSPECIFIED_ERROR;
            }
        }
    }

    /**
     * Present the page header
     * @return string HTML
     */
    public function presentHeader() {
        $html = parent::presentHeader();
        return $html;
    }

    /**
     * Present the page body
     * @return string HTML
     */
    public function presentBody() {
        $html = <<<HTML
<div class="body">
<form class="newgame" action="post/password-validate.php" method="post">
<input type="hidden" name="validator" value="$this->validator">
<div class="dialog">
<div class="controls">
		<p>
			<label for="email">Email</label><br>
			<input type="email" id="email" name="email" placeholder="Email">
		</p>
		<p>
			<label for="password">Password:</label><br>
			<input type="password" id="password" name="password" placeholder="password">
		</p>
		<p>
			<label for="password2">Password (again):</label><br>
			<input type="password" id="password2" name="password2" placeholder="password">
		</p>
HTML;
        if(isset($this->get['e'])) {
            $html .= '<p class="message">' . $this->error . '</p>';
        }

        $html .= <<<HTML
		<p><button name="ok" id ="ok" value = "ok">Create Account</button></p>
	    <p><button name="cancel" id="cancel" value = "cancel">Cancel</button></p>
		
		</div>
		</div>
</form>

</div>
HTML;

        return $html;
    }

    CONST VALIDATOR = 1;
    CONST INVALID_USER = 2;
    CONST EMAIL = 3;
    CONST PASSWORDS = 4;
    CONST PASSWORD_TOO_SHORT = 5;

    CONST VALIDATOR_ERROR = "Invalid or unavailable validator";
    CONST INVALID_USER_ERROR = "Email address is not for a valid user";
    CONST EMAIL_ERROR = "Email address does not match validator";
    CONST PASSWORDS_ERROR = "Passwords did not match";
    CONST PASSWORD_TOO_SHORT_ERROR = "Password too short";
    CONST UNSPECIFIED_ERROR = "Unspecified error";

    private $error;
    private $get;
    private $validator;
}