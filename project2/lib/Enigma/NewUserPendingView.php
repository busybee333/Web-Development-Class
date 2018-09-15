<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/17/2018
 * Time: 10:02 PM
 */

namespace Enigma;


class NewUserPendingView extends View
{
    /**
     * IndexView constructor.
     * @param System $system The System object
     */
    public function __construct(System $system) {
        parent::__construct($system, View::NEWUSER);
        //$system->clear();
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
        <p></p>
<form class="newgame" method="get" action="post/index-post.php">
    <div class="controls dialog">
        <p>An email message has been sent to your address. When it arrives, select the
        validate link in the email to validate your account.</p>
        <p><button name="home">Home</button></p>
    </div>
</form>
<p></p>
HTML;

        return $html;
    }
}