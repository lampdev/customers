<?php

namespace Acme\CustomersBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeCustomersBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSUserBundle';
    }
}
