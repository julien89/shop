<?php

namespace Wshop\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    public function indexAction(Request $request)
    {
    	$api = $this->container->get('wshop.api');
    	$api->setType('product');
    	$api->sendRequest('list.php', ['limit' => 1, 'offset' => '1']);
    	$result =  $api->getResponse();
    	var_dump($result);
		return $this->render('WshopProductBundle:Default:index.html.twig');
    }
}
