<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact/{id}', name: 'app_contact_show', requirements: ['id' => '\d+'])]
    #[Entity('contact', expr: "repository.findWithCategory(id)")]
    public function show(Contact $contact = null): Response
    {
        if (is_null($contact)) {
            throw $this->createNotFoundException("Le contact cet identifiant n'existe pas.");
        }

        return $this->render('contact/show.html.twig', ['contact' => $contact]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function index(ContactRepository $contactRepository, Request $request): Response
    {
        $search = $request->get('search', '');

        $contacts = $contactRepository->search($search);
        dump($contacts);
        return $this->render('contact/index.html.twig', ['contacts' => $contacts, 'isCategory' => false]);


    }
    #[Route('/contact/{id}/update', name: 'app_contact_update', requirements: ['id' => '\d+'])]
    public function update(Contact $contact) : Response
    {
        return $this->render('contact/update.html.twig', ['contact' => $contact]);
    }

    #[Route('/contact/{id}/delete', name: 'app_contact_delete', requirements: ['id' => '\d+'])]
    public function delete(Contact $contact) : Response
    {
        return $this->render('contact/delete.html.twig', ['contact' => $contact]);
    }

    #[Route('/contact/create', name: 'app_contact_create')]
    public function create() : Response
    {
        return $this->render('contact/create.html.twig');
    }
}
