<?php

namespace AppBundle\Service;

use Roukmoute\HashidsBundle\Hashids;

class HashServiceImpl implements HashService
{
    protected $hashEncoder;

    public function __construct(Hashids $hashEncoder)
    {
        $this->hashEncoder = $hashEncoder;
    }

    /**
     * @param $hashId
     * @return int
     */
    public function decodeId($hashId)
    {
        $id = $this->hashEncoder->decode($hashId);
        return count($id) > 0 ? $id[0] : 0;
    }

    /**
     * @param $id
     * @return string
     */
    public function encodeId($id)
    {
        return $this->hashEncoder->encode($id);
    }
}