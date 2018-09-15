<?php
/**
 * Controller for the form on the main (index) page.
 * @author Charles B. Owen
 */

namespace Enigma;

/**
 * Controller for the form on the main (index) page.
 */

class IndexController extends Controller {
	/**
	 * IndexController constructor.
	 * @param System $system The System object
	 * @param array $post $_POST
	 */
	public function __construct(System $system, Site $site, array $post, array &$session) {
		parent::__construct($system, $site, $post);
        $root = $site->getRoot();

		// Default will be to return to the home page
		$this->setRedirect("$root/index.php");

		// Clear any error messages
		$system->clearMessages();

		$users = new Users($site);
		$email = strip_tags($post['name']);
		$password = strip_tags($post['password']);

		$user = $users->login($email, $password);


		$session[User::SESSION_NAME] = $user;

		if($user === null) {
			$system->setMessage(View::INDEX,"Invalid Credentials");
			$this->setRedirect("$root/index.php?e=i");
			return;
		}
		else {
            $system->setUser($user->getName());
            $this->setRedirect("$root/enigma.php");
        }
	}
}