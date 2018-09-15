<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/17/2018
 * Time: 10:18 PM
 */

namespace Enigma;


class SenderView extends View
{
    /**
     * IndexView constructor.
     * @param System $system The System object
     */
    public function __construct(System $system, Site $site, $get) {
        parent::__construct($system, View::SEND);
        $this->get = $get;
        $this->root = $site->getRoot();
        $this->site = $site;

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
<div class="body sender"><form method="post" action="post/sender.php"><div class="dialog recipients">
<p><label for="search">Find Recipients: </label><input type="search" name="search" id="search" placeholder="Search...">
<input type="submit" value="Search" name="searcher"></p>
HTML;
        if($system->getMessage(View::SEND) !== NULL) {
            $html .= '<p class = "message">' . $system->getMessage(View::SEND) . '</p>';
        }

        $selectedUsers = $system->getRecipients();
        $users = new Users($this->site);
        if($selectedUsers != array()) {
            $html .= '<table>';
            foreach ($selectedUsers as $user) {
                $name = $users->get($user)->getName();
                $id = $users->get($user)->getId();
                $html .= '<tr><td><button name="remove" id="remove" value="' . $id . '">Remove</button></td><td>' . $name . '</td></tr>';
            }
            $html .= '</table>';
        }
        else {
            $html .= '<p>Use search to find recipients for a message to send.</p>';
        }

        $html .= '</div><div class="dialog">';

        $html .= parent::presentRotor();

        $html .= <<<HTML
<p><input type="submit" name="set" value="Set"> <input type="submit" name="cancel" value="Cancel"></p>
HTML;

        $html .= '<p>' . $system->getMessage(View::SETTINGS) . '</p>';

        $code = $system->getCode();
        $decoded = $system->getDecoded();
        $encoded = $system->getEncoded();

        $html .= <<<HTML
</div>
<div class="dialog encode">
<p class="code"><label for="code">Code: </label><input type="text" name="code" id="code" value="$code"></p>
<div><textarea name="from">$decoded</textarea> <div name = "to" class="enc">$encoded</div></div>
HTML;
        $html .= '<p>' . $system->getMessage(View::SEND1) . '</p>';
        $html .= <<<HTML
<p><input type="submit" name="encode" value="Encode ->">
 <input type="submit" name="send" value="Send"></p>
</div></form></div>
HTML;
        return $html;
    }
    private $site;
    private $get;
    private $root;
}