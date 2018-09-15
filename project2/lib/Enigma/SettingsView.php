<?php
/**
 * View class for the settings page
 * @author Charles B. Owen
 */

namespace Enigma;

/**
 * View class for the settings page
 */
class SettingsView extends View {
    /**
     * SettingsView constructor.
     * @param System $system The System object
     */
	public function __construct(System $system) {
		parent::__construct($system, View::SETTINGS);
	}

	/**
	 * Preset the page header
	 * @return string HTML
	 */
	public function presentHeader() {
		$html = parent::presentHeader();

		return $html;
	}

	/**
	 * Present the page body
	 * @return string HTML
	 */
	public function presentBody() {
		$system = $this->getSystem();
		$enigma = $system->getEnigma();

		$rotor1 = $enigma->getRotorSetting(1);
        $rotor2 = $enigma->getRotorSetting(2);
        $rotor3 = $enigma->getRotorSetting(3);

        $machine = $this->presentEnigmaRotors();

        $html = <<<HTML
<div class="body">
$machine
<form class="dialog" method="post" action="post/settings.php">
HTML;

        $html .= parent::presentRotor();

		$html .= <<<HTML
<p><input type="submit" name="set" value="Set"> <input type="submit" name="cancel" value="Cancel"></p>
HTML;

        $html .= '<p class = "message">' . $system->getMessage(View::SETTINGS) . '</p>';

		$html .= <<<HTML
</form>
</div>
HTML;

		return $html;
	}
}