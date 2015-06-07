<?php

namespace Lpi\KernelBundle\Test\Block;

use Lpi\KernelBundle\Controller\ContactServiceController;

class ContactServiceTest extends \PHPUnit_Framework_TestCase {

    public function testC() {



        $twigEngine = $this->getMockBuilder('Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine')->disableOriginalConstructor()->getMock();
        $formFactory = $this->getMockBuilder('Symfony\Component\Form\FormFactory')->disableOriginalConstructor()->getMock();
        $router= $this->getMockBuilder('Symfony\Bundle\FrameworkBundle\Routing\Router')->disableOriginalConstructor()->getMock();
        $service = new ContactServiceController($twigEngine, $formFactory, $router);
//
//        $contactService = new ContactService('name', $twigEngine, $formFactory);
    }

}