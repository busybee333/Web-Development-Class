<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/17/2018
 * Time: 10:18 PM
 */

namespace Enigma;


class ReceiverView extends View
{
    /**
     * IndexView constructor.
     * @param System $system The System object
     */
    public function __construct(System $system, Site $site, $post, &$session) {
        parent::__construct($system, View::RECEIVE);
        $this->site = $site;
        $this->session = $session;
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
        $enigma = $system->getEnigma();
        $user_message = new User_Message($this->site);

        $user = $this->session[User::SESSION_NAME];
        $userId = $user->getId();
        $thisUser_messages = $user_message->get($userId);

        /*$rotor1 = $enigma->getRotorSetting(1);
        $rotor2 = $enigma->getRotorSetting(2);
        $rotor3 = $enigma->getRotorSetting(3);*/

        $html = <<<HTML
<div class="body sender"><div class="body receiver"><form method="post" action="post/receiver.php">
<div class="dialog">
HTML;

        $html .= parent::presentRotor();

        $html .= <<<HTML
<p><input type="submit" name="set" value="Set"> <input type="submit" name="cancel" value="Cancel"></p>
HTML;

        $html .= '<p class = "message">' . $system->getMessage(View::RECEIVE) . '</p></div>';

        if($system->getCurrentMessage() != array()) {
            $msg = $system->getCurrentMessage();
            $msgId = $msg->getId();
            $msgCode = $msg->getCode();
            $msgEnc = $msg->getEncoded();
            $msgDec = $system->getDecoded();
            $html .= '<div class="dialog decode">
<p class="code">Code: ' . $msgCode .'</p>
<div><div class="dec" name="from">' . $msgDec . '</div> <div class="enc" name="to">' . $msgEnc . '</div></div>
</div>';
        }

        $html .= <<<HTML
<div class="dialog messages">
<table>
<tr><th>Select</th><th>Time</th><th>Sender</th></tr>
HTML;


        foreach($thisUser_messages as $message){
            $id = $message->getId();
            $time = $message->getSent();
            $sender = $message->getSender();
            $html .= '<tr><td><input value="' . $id . '" type="radio" name="message" ';
            if($system->getCurrentMessage() != array()) {
                if($id == $msgId) {
                    $html .= 'checked';
                }
            }
            $html .='></td><td>' . $time . '</td><td>' . $sender . '</td></tr>';
        }

        $html .= <<<HTML
</table>
<p><input type="submit" value="View"></p></div></form></div>
HTML;

        return $html;
    }
    private $site;
    private $session;
}