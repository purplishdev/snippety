<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository implements UserRepositoryInterface {

    public function deleteById($id) {
        $entity = $this->_em->getPartialReference('AppBundle:User', $id);

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
