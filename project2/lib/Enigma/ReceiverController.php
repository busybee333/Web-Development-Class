<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/20/2018
 * Time: 10:05 PM
 */

namespace Enigma;


class ReceiverController extends Controller
{
    public function __construct(System $system, Site $site, $post)
    {
        parent::__construct($system, $site, $post);
        $root = $site->getRoot();
        $this->setRedirect("$root/receiver.php");

        if (!empty($post['set'])) {
            $controller = new SettingsController($system, $site, $post);
            return;
        }
        elseif (isset($post['message'])){
            $messageId = trim(strip_tags($post['message']));
            $messages = new Messages($site);
            $message = $messages->get($messageId);
            $system->setCurrentMessage($message);
            $msg = $system->getCurrentMessage();
            $e = $msg->getEncoded();

            $code = $system->getCode();
            $enigma = $system->getEnigma();

            $c1 = $enigma->pressed(substr($code, 0, 1));
            $c2 = $enigma->pressed(substr($code, 1, 1));
            $c3 = $enigma->pressed(substr($code, 2, 1));

            $enigma->setRotorSetting(1, $c1);
            $enigma->setRotorSetting(2, $c2);
            $enigma->setRotorSetting(3, $c3);

            $bController = new BatchController($system, $site, $_POST);
            $decoded = $bController->decode($e);
            $system->setDecoded($decoded);
            /*$system->reset();*/
        }
    }
}