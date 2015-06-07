<?php
namespace Lpi\KernelBundle\Block;

use Ivory\CKEditorBundle\Exception\Exception;
use Lpi\KernelBundle\Repository\ContentRepository;
use Lpi\KernelBundle\Repository\ContentRepositoryInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContentBlockService extends BaseBlockService {

    /**
     * @var ContentRepository
     */
    private $repository;

    public function __construct($name, EngineInterface $templating, ContentRepositoryInterface $repository )
    {
        parent::__construct($name, $templating);
        $this->repository = $repository;
    }

    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(['zoneSlug']);
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        try {
            $contentInZone = $this->repository->findContentInZone($blockContext->getSetting('zoneSlug'));
        } catch (Exception $e) {
            return new Response();
        }

        return new Response($contentInZone);
    }
}