<?php

namespace AppBundle\Service;

interface HashService {
    public function decodeId($hashId);
    public function encodeId($id);
}