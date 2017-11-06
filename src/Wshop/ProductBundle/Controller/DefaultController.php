<?php

namespace Wshop\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WshopProductBundle:Default:index.html.twig');
    }
}
