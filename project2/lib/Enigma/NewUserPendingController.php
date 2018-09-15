<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/18/2018
 * Time: 5:45 PM
 */

namespace Enigma;


class NewUserPendingController
{
    public function __construct(System $system, Site $site, array $post)
    {
        parent::__construct($system, $site);

        $root = $site->getRoot();
        if (isset($post['home'])) {
            $this->setRedirect("$root/");
        }
    }
}