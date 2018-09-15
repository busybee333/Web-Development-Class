<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/18/2018
 * Time: 5:08 PM
 */

namespace Enigma;


class NewUserController extends Controller
{
    public function __construct(System $system, Site $site, array $post)
    {
        parent::__construct($system, $site, $post);
        $root = $site->getRoot();
        $this->setRedirect("$root/");

        if (isset($post['ok'])) {
            $this->setRedirect("$root/newuserpending.php");

            //
            // Get all of the stuff from the from
            //
            $name = strip_tags($post['name']);
            $email = strip_tags($post['email']);

            // Check name
            if ($name == null || $name == "") {
                $this->setRedirect("$root/newuser.php?e=" . NewUserView::NAME);
                return;
            }

            // Check email
            if ($email == null || $email == "") {
                $this->setRedirect("$root/newuser.php?e=" . NewUserView::EMAIL);
                return;
            }

            // Check if email exists
            $users = new Users($site);
            if ($users->exists($email)) {
                $this->setRedirect("$root/newuser.php?e=" . NewUserView::EXISTS);
                return;
            }

            // If no errors, then create new user
            $row = array('id' => '',
                'email' => $email,
                'name' => $name,
            );
            $newUser = new User($row);
            $users = new Users($site);
            $mailer = new Email();
            $users->add($newUser, $mailer);
        }
    }
}