<?php

namespace LiskPhpBundle\Controller;

use LiskPhpBundle\Service\Lisk;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request, Lisk $lisk)
    {
        var_dump($lisk->getForgedByPublicKey("b002f58531c074c7190714523eec08c48db8c7cfc0c943097db1a2e82ed87f84"));
        die("done");
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
