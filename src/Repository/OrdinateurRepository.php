<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Ordinateur;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Ordinateur>
 *
 * @method Ordinateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ordinateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ordinateur[]    findAll()
 * @method Ordinateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdinateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,  PaginatorInterface $paginator)
    {
        parent::__construct($registry, Ordinateur::class);
        $this->paginator = $paginator;
    }

 /**
     * Recupérer les martphone en lien avec une rehcerche
     *@return PaginationInterface
     */
     

     public function findSearch(SearchData $search): PaginationInterface
     {
        $query = $this
    
        ->createQueryBuilder('o')
        ->select('c' , 'o')
        ->join('o.ordinateurcategory', 'c');
      

      // bare de recherche 
      if(!empty($search->q)){
        $query =$query
        ->andWhere('o.Nom LIKE :q')
        ->setParameter('q', "%{$search->q}%");
    }

      // recherche par nom de produit
      if(!empty($search->nom)){
        $query =$query
        ->andWhere('o.nom LIKE :nom')
        ->setParameter('nom', "%{$search->nom}%");
    }

    // recherche par tailleEcran
    if(!empty($search->Capacite)){
        $query =$query
        ->andWhere('o.Capacite  LIKE :Capacite')
        ->setParameter('Capacite', "%{$search->Capacite}%");
    }

   // filter prix
    if(!empty($search->min)){
        $query =$query
        ->andWhere('o.prix >= :min')
        ->setParameter('min', $search->min);
       
    }

    if(!empty($search->max)){
        $query =$query
        ->andWhere('o.prix <= :max')
        ->setParameter('max', $search->max);
    }

         // ordinateurCategorie
         if(!empty($search->ordinateurcategory)){
            $query =$query
            ->andWhere('c.id IN (:ordinateurcategory)')
            ->setParameter('ordinateurcategory', $search->ordinateurcategory);
        }
         
        $query = $query->getQuery();
        return $this->paginator->paginate(
            $query,
           $search->page,
            16
        );
   
}   
}
