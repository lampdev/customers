<?php

namespace Acme\CustomersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeCustomersBundle:Default:index.html.twig', array('name' => $name));
    }
}