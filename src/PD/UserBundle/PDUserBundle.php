<?php

namespace PD\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PDUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
