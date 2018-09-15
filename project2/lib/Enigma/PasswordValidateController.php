<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/18/2018
 * Time: 5:53 PM
 */

namespace Enigma;


class PasswordValidateController extends Controller
{
    public function __construct(System $system, Site $site, $post)
    {
        parent::__construct($system, $site, $post);
        $root = $site->getRoot();
        $this->setRedirect("$root/");

        if (isset($post['ok'])) {


            //
            // 1. Ensure the validator is correct! Use it to get the user ID.
            //
            //If no email entered
            //Email address does not match validator
            $validators = new Validators($site);
            $validator = strip_tags($post['validator']);
            $userid = $validators->get($validator);
            if ($userid === null) {
                $this->setRedirect("$root/password-validate.php?v=$validator&e=" .
                PasswordValidateView::VALIDATOR);
                return;
            }


            //
            // 2. Ensure the email matches the user.
            //
            $users = new Users($site);
            $editUser = $users->get($userid);
            if ($editUser === null) {
                // User does not exist!
                $this->setRedirect("$root/password-validate.php?v=$validator&e=" .
                    PasswordValidateView::INVALID_USER);
                return;
            }
            $email = trim(strip_tags($post['email']));
            if ($email !== $editUser->getEmail()) {
                // Email entered is invalid
                //Email address does not match validator
                $this->setRedirect("$root/password-validate.php?v=$validator&e=" .
                    PasswordValidateView::EMAIL);
                return;
            }

            //
            // 3. Ensure the passwords match each other
            //
            $password1 = trim(strip_tags($post['password']));
            $password2 = trim(strip_tags($post['password2']));
            if ($password1 !== $password2) {
                // Passwords did not match
                $this->setRedirect("$root/password-validate.php?v=$validator&e=" .
                    PasswordValidateView::PASSWORDS);
                return;
            }

            if (strlen($password1) < 8) {
                // Works if empty too
                // Password too short
                $this->setRedirect("$root/password-validate.php?v=$validator&e=" .
                    PasswordValidateView::PASSWORD_TOO_SHORT);
                return;
            }

            $users->setPassword($userid, $password1);
            $validators->remove($userid);
        }
    }
}