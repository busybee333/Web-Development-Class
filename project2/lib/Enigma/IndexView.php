<?php
/**
 * View class for the Index (main) page
 * @author Charles B. Owen
 */

namespace Enigma;

/**
 * View class for the Index (main) page
 */

class IndexView extends View {

    /**
     * IndexView constructor.
     * @param System $system The System object
     */
	public function __construct(System $system, $get) {
		parent::__construct($system, View::INDEX);
		$this->get = $get;
		//$system->clear();

        if(isset($get['e'])){
            $this->error = "Invalid Credentials";
        }
	}

	/**
	 * Present the page header
	 * @return string HTML
	 */
	public function presentHeader() {
		$html = parent::presentHeader();

		$html .= <<<HTML
<h1 class="center">Welcome to Romi Yun's Endless Enigma!</h1>
HTML;

		return $html;
	}

	/**
	 * Present the page body
	 * @return string HTML
	 */
	public function presentBody() {
		$system = $this->getSystem();

		$html = <<<HTML
<div class="body">
<form class="dialog" method="post" action="post/index-post.php">
	<div class="controls">
	<p class="name">
        <label for="name">Email </label>
        <br>
        <input type="email" id="name" name="name">
    </p>
    <p class="password">
        <label for="name">Password </label>
        <br>
        <input type="password" id="password" name="password">
    </p>
	<p>
	    <button name="ok">Login</button>
	</p>
    <p>
        <a href="newuser.php">New User</a>
    </p>
HTML;

        if(isset($this->get['e'])) {
            $html .= '<p class="message">' . $this->error . '</p>';
        }

        $html .= <<<HTML
	</div>
</form>
</div>
HTML;

		return $html;
	}
    CONST INVALID = 1;
	private $error;
	private $get;
}