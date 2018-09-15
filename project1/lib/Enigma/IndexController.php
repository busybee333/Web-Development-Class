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
	public function __construct(System $system, array $post) {
		parent::__construct($system);

		// Default will be to return to the home page
		$this->setRedirect("../");

		// Clear any error messages
		$system->clearMessages();

		if(!isset($post['name'])) {
			return;
		}

		$name = trim(strip_tags($post['name']));
		if($name === '') {
			$system->setMessage(View::INDEX,"You must enter a name!");
			return;
		}

		$system->setUser($name);

		$this->setRedirect("../enigma.php");
	}
}