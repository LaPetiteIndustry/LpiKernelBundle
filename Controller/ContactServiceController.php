<?php
namespace Lpi\KernelBundle\Controller;

use Lpi\KernelBundle\Entity\Contact;
use Lpi\KernelBundle\Exception\MailNotSendException;
use Lpi\KernelBundle\Form\ContactType;
use Lpi\KernelBundle\Service\ContactMailer;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ContactServiceController
{
    private $form;

    /**
     * @var FormFactory
     */
    private $formFactory;

    private $action;
    /**
     * @var ContactMailer
     */
    private $mailer;

    private $formBuilderInferfaceName;

    public function __construct(EngineInterface $templating, FormFactory $formFactory, Router $router, ContactMailer $mailer)
    {
        $this->formFactory = $formFactory;
        $this->action = $router->generate('contact_type');
        $this->mailer = $mailer;
    }

    public function getFormView()
    {
        return $this->form->getForm()->createView();
    }

    public function submitFormAction(Request $request)
    {
        $formBuilderInferfaceName = $request->get('formBuilderInferfaceName');

        if ($formBuilderInferfaceName) {
            $this->formBuilderInferfaceName = urldecode($formBuilderInferfaceName);
        }
        $form = $this->prepareForm($this->formBuilderInferfaceName)->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            try {
                $this->mailer->send($form->getData());
            } catch (MailNotSendException $e) {
                return new JsonResponse('Unable to send e-mail', 500);
            }
            return new JsonResponse('ok', 200);
        }

        foreach ($form as $e) {
            foreach ($e->getErrors(true) as $err) {
                $errors[$e->getName()] = $err->getMessage();
            }
        }

        return new JsonResponse($errors, 400);
    }

    /**
     * @param $formBuilderInferfaceName
     * @return FormBuilder
     */
    public function prepareForm($formBuilderInferfaceName)
    {
        $this->formBuilderInferfaceName = $formBuilderInferfaceName;

        $FORM = $formBuilderInferfaceName::FORM;
        $ENTITY = $formBuilderInferfaceName::ENTITY;
        $this->form = $FORM::createForm($this->formFactory, new $ENTITY(), $this->action . '?formBuilderInferfaceName=' . urlencode($formBuilderInferfaceName));
        return $this->form;
    }
}