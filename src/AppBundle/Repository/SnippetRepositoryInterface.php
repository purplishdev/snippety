<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;

interface SnippetRepositoryInterface extends RepositoryInterface {

    public function getLatestSnippets($count);
    public function getUserSnippetByTitle(User $user, $snippetTitle);

}