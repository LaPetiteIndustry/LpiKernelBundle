<?php
namespace Lpi\KernelBundle\Controller;

use Lpi\KernelBundle\Form\ContactType;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactServiceController
{
    private $form;

    /**
     * @var FormFactory
     */
    private $formFactory;

    /**
     * @var Router
     */
    private $router;

    private $action;

    public function __construct(EngineInterface $templating, FormFactory $formFactory, Router $router)
    {
        $this->formFactory = $formFactory;
        $this->action = $router->generate('contact_type');
        $this->form = ContactType::createForm($formFactory, $this->action);
        $this->router = $router;
    }

    public function getFormView()
    {
        return $this->form->getForm()->createView();
    }

    public function submitFormAction(Request $request)
    {
        $form = ContactType::createForm($this->formFactory, $this->action)->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            return new JsonResponse("ok", 200);
        }

        foreach ($form as $e)
        {
                foreach($e->getErrors(true) as $err) {
                    $errors[$e->getName()] = $err->getMessage();
                }
        }

        return new JsonResponse($errors, 400);
    }
}