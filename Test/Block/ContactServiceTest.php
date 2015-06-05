<?php

namespace Lpi\KernelBundle\Test\Block;

use Lpi\KernelBundle\Block\ContactService;

class ContactServiceTest extends \PHPUnit_Framework_TestCase {

    public function testC() {

        $twigEngine = $this->getMockBuilder('Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine')->disableOriginalConstructor()->getMock();
        $formFactory = $this->getMockBuilder('Symfony\Component\Form\FormFactory')->disableOriginalConstructor()->getMock();

        $contactService = new ContactService('name', $twigEngine, $formFactory);
    }

}