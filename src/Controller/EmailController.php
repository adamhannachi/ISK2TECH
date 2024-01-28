<?php

namespace App\Controller;

use App\Form\FormEmailType;
use App\Entity\ContactClient;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ContactClientRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmailController extends AbstractController
{
    #[Route('/email', name: 'app_email', methods:['Get'])]
    public function show(ContactClientRepository $repository , PaginatorInterface $paginator, Request $request): Response
    {
        $data = $repository->findAll();
        $Email= $paginator->paginate(
          $data, $request->query->getInt('page', 1),
          10
        );
        return $this->render('email/index.html.twig', ['Email'=> $Email]);
    }

   // creer email

    #[Route('/creer/email', name: 'creer_email', methods:['Get','POST'])]
    public function creer(Request $request, EntityManagerInterface $manager ): Response
    {
       
        $Email= new ContactClient();
        $formEmail= $this->createForm(FormEmailType::class, $Email);

        $formEmail->handleRequest($request);
        if($formEmail->isSubmitted() && $formEmail->isValid()){
            $Email=  $formEmail->getData();

           $manager->persist( $Email);
           
           $manager->flush();
           return $this->redirectToRoute('app_page_accueil');
        }
        return $this->render('email/formulaire_email.html.twig', [
        'formEmail'=> $formEmail->createview()
        ]);
    }


    // supprimer email

    #[Route('/supprimer/email/{id}', name:'delete_email', methods:['GET'])]
    public function delete(ContactClientRepository $repository,int $id , EntityManagerInterface $manager): Response
    {
        $Email = $repository->findOneBy(['id'=> $id]);
        $manager->remove($Email);
        $manager->flush();
       
        $this->addFlash(
            'success',
            'votre accessoire a été bien supprimé dans le système',
        );
        return $this->redirectToRoute('app_email');
    }

   
}
