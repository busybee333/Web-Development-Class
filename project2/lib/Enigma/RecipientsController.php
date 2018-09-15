<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/19/2018
 * Time: 6:16 PM
 */

namespace Enigma;


class RecipientsController extends Controller
{
    public function __construct(System $system, Site $site, $post){
        parent::__construct($system, $site, $post);
        $root = $site->getRoot();
        $this->setRedirect("$root/sender.php");

        if(isset($post['add'])) {
            $userId = $post['recipient'];
            $system->addRecipient($userId);
        }
    }
}