<?php

namespace Enhavo\Bundle\ContactBundle\Controller;

use Enhavo\Bundle\ContactBundle\Model\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{

    protected $errorResolver = null;

    public function getErrorResolver()
    {
        if($this->errorResolver === null) {
            $this->errorResolver = $this->get('errorresolver.formerrorresolver');
        }
        return $this->errorResolver;
    }

    public function submitAction(Request $request)
    {
        $form = $this->get('form.factory')->create('enhavo_contact_'.$this->container->getParameter("enhavo_contact.contact.type"));
        $form->handleRequest($request);

        if($form->isValid()) {
            $emailTo = $this->container->getParameter('enhavo_contact.contact.recipient');

            $contact = $form->getData();

            $text = $this->render($this->container->getParameter('enhavo_contact.contact.template.recipient'), array(
                'contact' => $contact
            ));

            $message = \Swift_Message::newInstance()
                ->setSubject($this->container->getParameter('enhavo_contact.contact.subject'))
                ->setFrom($this->container->getParameter('enhavo_contact.contact.from'))
                ->setTo($emailTo)
                ->setBody($text);

            $this->get('mailer')->send($message);
            $response = new Response();
            if($this->container->getParameter('enhavo_contact.contact.send_to_sender') == true) {
                $response->setContent(1);
            } else {
                $response->setContent(0);
            }
        } else {
            $errors = $this->getErrorResolver()->getErrors($form);
            $response = new Response();
            $response->setContent($errors[0]);
        }
        return $response;
    }

    public function senderMailAction(Request $request) {
        $form = $this->get('form.factory')->create('enhavo_contact_'.$this->container->getParameter("enhavo_contact.contact.type"));
        $form->handleRequest($request);

        $text = $this->render($this->container->getParameter('enhavo_contact.contact.template.sender'));

        $message = \Swift_Message::newInstance()
            ->setSubject($this->container->getParameter('enhavo_contact.contact.subject'))
            ->setFrom($this->container->getParameter('enhavo_contact.contact.recipient'))
            ->setTo($form->getData()->getEmail())
            ->setBody($text);

        $this->get('mailer')->send($message);
        $response = new Response();
        $response->setContent("Nachricht gesendet");
        return $response;
    }
}