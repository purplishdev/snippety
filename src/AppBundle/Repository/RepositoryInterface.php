<?php

namespace AppBundle\Repository;

interface RepositoryInterface {
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);
    public function findOneBy(array $criteria, array $orderBy = null);
    public function findAll();
    public function deleteById($id);
    public function delete($entity);
    public function save($entity);
}