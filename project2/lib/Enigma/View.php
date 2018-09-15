<?php
/**
 * General purpose view base class, where we put generic formatting.
 * @author Charles B. Owen
 */

namespace Enigma;

/**
 * General purpose view base class, where we put generic formatting.
 */
abstract class View {
    const INDEX = 0;        ///< Constant for index.php
    const ENIGMA = 1;       ///< Constant for enigma.php
    const SETTINGS = 2;     ///< Constant for settings.php
    const BATCH = 3;        ///< Constant for batch.php
    const NEWUSER = 4;
    const SEND = 5;
    const RECEIVE = 6;
    const NEWUSERPENDING = 7;
    const PASSWORDVALIDATE = 8;
    const RECIPIENTS = 9;
    const SEND1 = 10;

    /**
     * View constructor.
     * @param System $system The System object
     * @param Site $site The Site object
     * @param $page Page we are viewing (one of the constants above)
     */
	public function  __construct(System $system, $page) {
		$this->system = $system;
		$this->page = $page;


		// Automatically redirect to index if
        // the system is not ready to use.
		if($page !== self::INDEX && $page != self::NEWUSER && $page != self::NEWUSERPENDING) {
		    if(!$system->ready()) {
		        $this->setRedirect('./index.php');
            }
        }
	}

    /**
     * Get the System object
     * @return System object
     */
	public function getSystem() {
		return $this->system;
	}

    /**
     * Set a page to optionally redirect to
     * @param $redirect string Redirect link or null if none.
     */
	public function setRedirect($redirect) {
		$this->redirect = $redirect;
	}

    /**
     * Get a page to optionally redirect to
     * @return string|null Redirect link or null if none.
     */
	public function getRedirect() {
		return $this->redirect;
	}

    /**
     * Common content that goes in the &lt;head&gt; section
     * @return string HTML
     */
	public function head() {
	    return <<<HTML
	<link href="lib/css/enigma.css" type="text/css" rel="stylesheet" />
HTML;
    }

    /**
     * Present the entire page.
     * @return string HTML
     */
	public function present() {
		return $this->presentHeader() .
			$this->presentBody() .
			$this->presentFooter();
	}

    /**
     * Present the header for a page
     * @return string HTML
     */
	public function presentHeader() {
		$html = <<<HTML
<header>
<figure><img src="images/banner-800.png" width="800" height="357" alt="Header image"/></figure>
HTML;

        if($this->page !== self::INDEX && $this->page !== self::NEWUSER && $this->page !== self::NEWUSERPENDING) {
            $html .= $this->nav();
        }

        $html .= <<<HTML

</header>
HTML;
		return $html;
	}

    /**
     * Create the page &lt;nav&gt; area
     * @return string HTML
     */
	private function nav() {
        $links = [
            ['to'=>'enigma.php', 'text'=>'Enigma', 'page'=>self::ENIGMA],
            ['to'=>'settings.php', 'text'=>'Settings', 'page'=>self::SETTINGS],
            ['to'=>'batch.php', 'text'=>'Batch', 'page'=>self::BATCH],
            ['to'=>'sender.php', 'text'=>'Send', 'page'=>self::SEND],
            ['to'=>'receiver.php', 'text'=>'Receive', 'page'=>self::RECEIVE],
            ['to'=>'./', 'text'=>'Ausloggen', 'page'=>0]
        ];

        $html = <<<HTML
<nav><ul>
HTML;

        foreach($links as $link) {
            $to = $link['to'];
            $text = $link['text'];
            $selected = $this->page === $link['page'] ? ' class="selected"' : '';
            $html .= <<<HTML
<li$selected><a href="$to">$text</a></li>
HTML;
        }

        $html .= <<<HTML
</ul></nav>
HTML;

        return $html;
    }

    /**
     * Present the body of the page (page specific)
     * @return mixed HTML
     */
    abstract public function presentBody();

    /**
     * Present the Enigma machine (rotors only).
     * Used by Settings and Batch.
     */
	protected function presentEnigmaRotors() {
        $system = $this->getSystem();
        $enigma = $system->getEnigma();

        $rotor1 = $enigma->getRotorSetting(1);
        $rotor2 = $enigma->getRotorSetting(2);
        $rotor3 = $enigma->getRotorSetting(3);

        $html = <<<HTML
<div class="enigma" id="enigma">
<figure class="enigma"><img src="images/rotors.png" alt="Enigma Rotors" width="1024" height="580"></figure>
<p class="wheel wheel-s wheel-1">$rotor1</p>
<p class="wheel wheel-s wheel-2">$rotor2</p>
<p class="wheel wheel-s wheel-3">$rotor3</p>
</div>
HTML;

        return $html;
    }

    /**
     * Present the page footer
     * @return string HTML
     */
	public function presentFooter() {
		$html = <<<HTML
<footer>
	<p class="center"><img src="images/banner1-800.png" width="800" height="100" alt="Footer image"/></p>
</footer>
HTML;

		return $html;
	}

	/**
     * Present Rotor
     * @return string HTML
	 */
	public function presentRotor() {
        // The form controls...
        $html = $this->rotor(1);
        $html .= $this->rotor(2);
        $html .= $this->rotor(3);
        return $html;

    }

    /**
     * Present any error message for this page if one exists.
     * @return string HTML
     */
	public function presentMessage() {
	    if($this->system->getMessage($this->page) !== null) {
            return '<p class="message">' . $this->system->getMessage($this->page) . '</p>';
        }

        return '';
    }

    /**
     * Create the form controls for a single rotor
     * @param $rotor Rotor number 1-3
     * @return string HTML
     */
    protected function rotor($rotor) {
        $system = $this->getSystem();
        $enigma = $system->getEnigma();

        $setting = $enigma->getRotorSetting($rotor);
        $wheel = $enigma->getRotor($rotor);

        $html = <<<HTML
<p><label for="rotor-$rotor">Rotor $rotor:</label>
<select id="rotor-$rotor" name="rotor-$rotor">
HTML;

        $rotors = ['', 'I', 'II', 'III', 'IV', 'V'];
        for($i=1; $i<=5; $i++) {
            $id = $rotors[$i];
            $selected = $wheel == $i ? " selected" : "";
            $html .= <<<HTML
<option value="$i"$selected>$id</option>
HTML;

        }
        $html .= <<<HTML
</select>&nbsp;&nbsp;
<label for="initial-$rotor">Setting:</label>
<input class="initial" id="initial-$rotor" name="initial-$rotor" type="text" value="$setting">
</p>
HTML;

        return $html;
    }

	private $page;              ///< The current page ID
	private $system;            ///< System object
    private $site;              ///< Site object
	private $redirect = null;   ///< Optional redirect if we can't be here
}