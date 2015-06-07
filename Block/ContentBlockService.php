<?php
namespace AppBundle\Block;

use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;

class ContentBlockService extends BaseBlockService {

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        return $this->renderResponse('LpiKernelBundle:Block:contact.html.twig', array(
            'form' => $this->service->getFormView()
        ), $response);
    }
}