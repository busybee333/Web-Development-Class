<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/19/2018
 * Time: 5:58 PM
 */

namespace Enigma;


class SenderController extends Controller
{
    public function __construct(System $system, Site $site, $post){
        parent::__construct($system, $site, $post);
        $root = $site->getRoot();
        $this->setRedirect("$root/sender.php");

        if(!empty($post['set'])) {
            $controller = new SettingsController($system, $site, $post);
            return;
        }
        elseif(isset($post['searcher'])){
            $search = trim(strip_tags($post['search']));
            if (strlen($search) < 3) {
                $system->setMessage(View::SEND, 'Search strings must be at least 3 letters long');
            }
            else {
                $this->setRedirect("$root/recipients.php?q=$search");
                $system->setMessage(View::SEND, '');
            }
        }
        elseif(isset($post['remove'])) {
            $system->deleteRecipient($post['remove']);
        }
        elseif(isset($post['code'])){
            $system->setMessage(View::SEND1, '');
            $preCode = trim(strip_tags($post['code']));
            if(ctype_alpha($preCode) && strlen($preCode) == 3){
                $code = strtoupper($preCode);
                $system->setCode($code);
            }
            else {
                $system->setMessage(View::SEND1, 'Code must be three alphabetic characters');
            }
        }

        if(isset($post['encode'])){
            $code = $system->getCode();
            $enigma = $system->getEnigma();

            $c1 = $enigma->pressed(substr($code, 0, 1));
            $c2 = $enigma->pressed(substr($code, 1, 1));
            $c3 = $enigma->pressed(substr($code, 2, 1));

            $enigma->setRotorSetting(1, $c1);
            $enigma->setRotorSetting(2, $c2);
            $enigma->setRotorSetting(3, $c3);

            $bController = new BatchController($system, $site, $_POST);
            $decoded = (strip_tags($post['from']));
            $bController->encode($decoded);
            $system->reset();
        }

        if(isset($post['send'])){
            //To add the message to the message table
            $encoded = $system->getEncoded();
            $code = $system->getCode();
            $name = $this->getSystem()->getUser();

            $row = array("id" => 0, "encoded" => $encoded, "code" => $code, "sent" => date("Y-m-d H:i:s"), "sender" => $name);
            $message = new Message($row);


            $messages = new Messages($site);
            $messageId = $messages->add($message);

            //To create relationship w/ userId & messageId
            $selectedUsers = $system->getRecipients();                  //array of integers
            $users = new Users($site);                                  //user obj
            foreach ($selectedUsers as $user) {                         //for each userId in $selectedUsers
                $id = $users->get($user)->getId();
                $user_message = new User_Message($site);
                $user_message->add($id, $messageId);
            }
            $system->clearRecipients();
        }
    }
}