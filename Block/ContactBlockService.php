<?php
namespace Lpi\KernelBundle\Block;

use Lpi\KernelBundle\Controller\ContactServiceController;
use Lpi\KernelBundle\Form\ContactType;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Response;

class ContactBlockService extends BaseBlockService
{
    /**
     * @var ContactServiceController
     */
    private $service;

    public function __construct($name, EngineInterface $templating, ContactServiceController $service)
    {
        parent::__construct($name, $templating);
        $this->service = $service;
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        return $this->renderResponse('LpiKernelBundle:Block:contact.html.twig', array(
            'form' => $this->service->getFormView()
        ), $response);
    }
}