<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CrudUserController extends AbstractController
{
    #[Route('/crud/user', name: 'app_crud_user')]
    public function index(UserRepository $repository ,PaginatorInterface $paginator, Request $request): Response
    {
        $data= $repository->findAll();
        $User = $paginator->paginate(
            $data, $request->query->getInt('page', 1),
            10
        );
        return $this->render('crud_user/index.html.twig', [
          'User'=> $User
        ]);
    }

    
    //  créer un nouveau User

    #[Route('/creer/user', name: 'creer_user', methods:['GET','POST'])]
    public function create( Request $request, EntityManagerInterface $manager ,UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $User= new User();
        $formUser = $this->createForm(UserType::class, $User);

        $formUser->handleRequest($request);
        if($formUser->isSubmitted() && $formUser->isValid()){
            $User->setPassword( $userPasswordHasher->hashPassword( $User, $formUser->get('plainPassword')->getData() ) );

           $User= $formUser->getData();

           $manager->persist($User);
           
           $manager->flush();
        }
        return $this->render('crud_user/CreeUser.html.twig', [
            'formUser'=>$formUser->createView(),
            
        ]);
    
    }


     //  modifier User

     #[Route('/modifier/user/{id}', name:'modifier_user', methods:['GET','POST'])]
     public function update(UserRepository $repository,int $id ,Request $request, EntityManagerInterface $manager ): Response
     {
        $User = $repository->findOneBy(['id'=>$id]);
        $formUser= $this->createForm(UserType::class,$User);
        
        $formUser->handleRequest($request);
        if($formUser->isSubmitted() && $formUser->isValid()){
            $User= $formUser->getData();
          
           $manager->persist($User);
           
           $manager->flush();
         
        }
        
         return $this->render('crud_user/ModifierUser.html.twig', [
            'formUser'=>$formUser->createView(),
             
         ]);
     
     }

     
     //  supprimer User

     #[Route('/supprimer/user/{id}', name: 'delete_user', methods:['GET','POST'])]
     public function delete(UserRepository $repository,int $id , EntityManagerInterface $manager): Response
     {
 
        $User = $repository->findOneBy(['id'=> $id]);
        $manager->remove($User);
        $manager->flush();
       
        $this->addFlash(
            'success',
            'Utilisateur a été bien supprimé dans le système',
        );
        return $this->redirectToRoute('app_crud_user');
        
     
     }
}
