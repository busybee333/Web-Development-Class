<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/17/2018
 * Time: 9:47 PM
 */

namespace Enigma;


class NewUserView extends View
{
    const NAME = 1;
    const EMAIL = 2;
    const EXISTS = 3;
    const NAME_ERROR = "You must supply a name.";
    const EMAIL_ERROR = "You must supply an email.";
    const EMAIL_EXISTS_ERROR = "Email already exists.";

    /**
     * IndexView constructor.
     * @param System $system The System object
     * @param $get
     */
    public function __construct(System $system, $get) {
        parent::__construct($system, View::NEWUSER);
        $this->get = $get;

        // Set errors if exist
        if (isset($get['e'])) {
            if ($get['e'] == self::NAME) {
                $this->error = self::NAME_ERROR;
            }
            else if ($get['e'] == self::EMAIL) {
                $this->error = self::EMAIL_ERROR;
            }
            else if ($get['e'] == self::EXISTS) {
                $this->error = self::EMAIL_EXISTS_ERROR;
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
        $system = $this->getSystem();

        $html = <<<HTML
<div class="body">
    <form class="dialog" method="post" action="post/newuser.php">
        <p>Creating an account on The Endless Enigma will allow you to send and receive messages.</p>
        <div class="controls">
        <p class="name"><label for="name">Name </label><br><input type="text" id="name" name="name"></p>
        <p class="name"><label for="email">Email </label><br><input type="email" id="email" name="email"></p>		<p></p>
        <p><button name="ok">Create Account</button></p>
        <p><button name="cancel">Cancel</button></p>	</div>
HTML;

        if (isset($this->get['e'])) {
            $html .= '<p class="message">' . $this->error . '</p>';
        }

        $html .= <<<HTML
        <p>By creating an account on The Endless Enigma, you are grant permission for others users of the system
        to view your name as you have provided it. You are not required to use your real name in The Endless Enigma,
        you may use a pseudonym if you wish. The email address you enter must be valid, but will not be disclosed
        to users of the system.</p>
        <p>Offensive pseudonyms or message content are strictly prohibited.</p>
    </form>
</div>
HTML;

        return $html;
    }

    private $error;
    private $get;
}