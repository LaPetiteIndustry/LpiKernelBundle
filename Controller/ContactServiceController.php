<?php
namespace Lpi\KernelBundle\Controller;

use Lpi\KernelBundle\Entity\Contact;
use Lpi\KernelBundle\Exception\MailNotSendException;
use Lpi\KernelBundle\Form\ContactType;
use Lpi\KernelBundle\Service\ContactMailer;
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

    private $action;
    /**
     * @var ContactMailer
     */
    private $mailer;

    public function __construct(EngineInterface $templating, FormFactory $formFactory, Router $router, ContactMailer $mailer)
    {
        $this->formFactory = $formFactory;
        $this->action = $router->generate('contact_type');
        $this->form = ContactType::createForm($formFactory, new Contact(), $this->action);

        $this->mailer = $mailer;
    }

    public function getFormView()
    {
        return $this->form->getForm()->createView();
    }

    public function submitFormAction(Request $request)
    {
        $contact = new Contact();
        $form = ContactType::createForm($this->formFactory, $contact, $this->action)->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            try {
                $this->mailer->send($form->getData());
            } catch(MailNotSendException $e) {
                return new JsonResponse('Unable to send e-mail', 500);
            }
            return new JsonResponse('ok', 200);
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