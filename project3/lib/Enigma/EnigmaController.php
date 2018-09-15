<?php
/**
 * Main Enigma controller. Handles post from the Enigma simulation.
 * @author Charles B. Owen
 */

namespace Enigma;

/**
 * Main Enigma controller. Handles post from the Enigma simulation.
 */
class EnigmaController extends Controller {
	/**
	 * EnigmaController constructor.
	 * @param System $system System object
	 * @param array $post $_POST
	 */
	public function __construct(System $system, array $post) {
		parent::__construct($system);

		// Default will be to return to the enigma page
		//$this->setRedirect("../enigma.php#enigma");

		if(!empty($post['key'])) {
		    $system->press(strip_tags($post['key']));
		    $light = $system->getLighted();
            $this->enigma = $system->getEnigma();
            $one = $this->enigma->getRotorSetting(1);
            $two = $this->enigma->getRotorSetting(2);
            $three = $this->enigma->getRotorSetting(3);
            $this->result = json_encode(array('light' => $light, 'one' => $one, 'two' => $two,
                'three' => $three));
            return;
		}

        if(!empty($post['reset'])) {
		    $system->reset();
            $this->enigma = $system->getEnigma();
            $one = $this->enigma->getRotorSetting(1);
            $two = $this->enigma->getRotorSetting(2);
            $three = $this->enigma->getRotorSetting(3);

		    $this->result = json_encode(array('reset' => 'ok', 'one' => $one, 'two' => $two,
                'three' => $three));
		    return;
        }
	}

    /**
     * Get any ajax response
     * @return JSON result for AJAX
     */
    public function getResult() {
        return $this->result;
    }

    private $result = null;
    private $enigma;
}