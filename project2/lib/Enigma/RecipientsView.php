<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/18/2018
 * Time: 5:00 PM
 */

namespace Enigma;


class RecipientsView extends View
{
    public function __construct(System $system, Site $site, array $get) {
        parent::__construct($system, View::RECIPIENTS);
        $this->site = $site;
        $this->search = strip_tags($get['q']);
    }

    public function presentBody()
    {
        $html = <<<HTML
        <div class="body"><form method="post" action="post/recipients.php">
<input type="hidden" name="search" value="$this->search">
<div class="dialog recipients">
HTML;
        $users = new Users($this->site);
        $all = $users->search($this->search);
        if ($all === null) {
            $html .= <<<HTML
<p>Query returned no results!</p>
<p><input type="submit" name="cancel" value="Ok"></p>
HTML;

        }
        else {
            $html.= '<p>Select a user to add to the list of recipients.</p>
<table>';
            foreach($all as $user){
                $name = $user->getName();
                $id = $user->getId();
                $html .= '<tr><td><input type="radio" name="recipient" value="' . $id . '"</td><td>' . $name . '</td></tr>';
            }
            $html .= '</table>';
        }


        $html .=<<<HTML
<p><input type="submit" name="add" value="Add"> <input type="submit" name="cancel" value="Cancel"></p></div></div></form></div>
HTML;
        return $html;
    }

    private $site;
    private $get;
    private $search;
}