<?php
/**
 * Base class for controllers
 * @author Charles B. Owen
 */

namespace Enigma;

/**
 * Base class for controllers
 *
 * Every controller needs to know what system it is
 * a part of and any redirect page.
 */
class Controller {

    public function __construct(System $system, Site $site, $post) {
        $this->site = $site;
        $this->system = $system;
        $this->post = $post;
    }

    /**
     * Get the redirect location link.
     * @return page to redirect to.
     */
    public function getRedirect() {
        return $this->redirect;
    }

    protected function setRedirect($target) {
        $this->redirect = $target;
    }

    public function getSystem() {
        return $this->system;
    }

    public function getSite() {
        return $this->site;
    }

    public function setSite($site) {
        $this->site = $site;
    }

    private $redirect;	///< Page we will redirect the user to.
    private $system;
    private $site;		///< The Site object
    private $post;		///< $_POST
}