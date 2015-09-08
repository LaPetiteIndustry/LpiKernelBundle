<?php

namespace Lpi\KernelBundle\Service;

use Lpi\KernelBundle\Entity\Contact;
use Lpi\KernelBundle\Entity\Sendable;
use Lpi\KernelBundle\Exception\MailNotSendException;
use Swift_Mailer;
use Symfony\Component\Templating\EngineInterface;

class ContactMailer
{

    /**
     * @var Swift_Mailer
     */
    private $mailer;
    /**
     * @var EngineInterface
     */
    private $templating;
    private $recipient;
    private $sender;

    public function __construct(Swift_Mailer $mailer, EngineInterface $templating, $recipient, $sender)
    {

        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->recipient = $recipient;
        $this->sender = $sender;
    }

    /**
     * @param Sendable $contact
     * @throws MailNotSendException
     */
    public function send(Sendable $contact)
    {
        $content = $this->templating->render('@LpiKernel/Contact/mail.txt.twig', ['contact' => $contact->prepareForSending()]);
        $message = \Swift_Message::newInstance('Formulaire de contact en provenance du site', $content, 'text/plain')
                                                ->setTo($this->recipient)
                                                ->setReplyTo($contact->getEmail())
                                                ->setFrom($this->sender);
        $numberOfSentMessages = $this->mailer->send($message);
        if ($numberOfSentMessages == 0) {
            throw new MailNotSendException();
        }
    }
}