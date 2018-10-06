<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class SnippetRepository extends EntityRepository implements SnippetRepositoryInterface {

    public function getLatestSnippets($count) {
        return $this->findBy(
            array('private' => false),
            array('createDate' => 'DESC'),
            $count
        );
    }

    public function getUserSnippetByTitle(User $user, $snippetTitle) {
        return $this->findOneBy(array(
            'author' => $user->getId(),
            'title' => $snippetTitle
        ));
    }

    public function deleteById($id) {
        $entity = $this->_em->getPartialReference('AppBundle:Snippet', $id);

        if ($entity === null) {
            return;
        }

        $this->delete($entity);
    }

    public function delete($entity) {
        $this->_em->remove($entity);
        $this->_em->flush();
    }

    public function save($entity) {
        $this->_em->merge($entity);
        $this->_em->flush();
    }
}
