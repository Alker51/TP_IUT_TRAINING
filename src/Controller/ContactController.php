<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact/{id}', name: 'app_contact_show', requirements: ['id' => '\d+'])]
    public function show(Contact $contact = null): Response
    {
        if (is_null($contact)) {
            throw $this->createNotFoundException("Le contact cet identifiant n'existe pas.");
        }

        return $this->render('contact/show.html.twig', ['contact' => $contact]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function index(ContactRepository $contactRepository): Response
    {
        $contacts = $contactRepository->findAll();

        return $this->render('contact/index.html.twig', ['contacts' => $contacts]);
    }


}
