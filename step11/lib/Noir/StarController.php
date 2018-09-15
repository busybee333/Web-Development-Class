<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/25/2018
 * Time: 8:16 AM
 */

namespace Noir;

class StarController extends Controller
{
    public function __construct(Site $site, $user, $post) {
        parent::__construct($site);

        $id = strip_tags($post['id']);
        $rating = strip_tags($post['rating']);
        $movies = new Movies($this->site);

        //Invalid ID
        if($movies->get($user, $id) === null){
            $this->result = json_encode(array('ok' => false, 'message' => 'Failed to update database!'));
            return;
        }

        //Success
        $movies->updateRating($user, $id, $rating);
        $view = new HomeView($site, $user);
        $this->result = json_encode(array('ok' => true, 'table' => $view->presentTable()));
    }
}