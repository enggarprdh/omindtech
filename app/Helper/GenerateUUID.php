<?php

namespace App\Helper;

use Ramsey\Uuid\Uuid;

class GenerateUUID
{

    //Time Based
    public function ver1()
    {
        return Uuid::uuid1()->toString();
    }

    //Name based and hashed with MD5
    public function ver3()
    {
        return Uuid::uuid3(Uuid::NAMESPACE_DNS,'php.net')->toString();
        
    }

    //Random based
    public function ver4()
    {
        return Uuid::uuid4()->toString();
    }

    //Name based and hashed with SHA1
    public function ver5()
    {
        return Uuid::uuid5(Uuid::NAMESPACE_DNS,'php.net')->toString();
    }
}
