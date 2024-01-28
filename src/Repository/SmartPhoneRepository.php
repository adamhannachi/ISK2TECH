<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\SmartPhone;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;


/**
 * @extends ServiceEntityRepository<SmartPhone>
 *
 * @method SmartPhone|null find($id, $lockMode = null, $lockVersion = null)
 * @method SmartPhone|null findOneBy(array $criteria, array $orderBy = null)
 * @method SmartPhone[]    findAll()
 * @method SmartPhone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SmartPhoneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, SmartPhone::class);
        $this->paginator = $paginator;
    }

    /**
     * Recupérer les martphone en lien avec une rehcerche
     *@return PaginationInterface
     */
     

     public function findSearch(SearchData $search): PaginationInterface
     {
        $query = $this
    
        ->createQueryBuilder('s')
        ->select('c' , 's')
        ->join('s.smartPhoneCategorie', 'c');
      

      // bare de recherche 
      if(!empty($search->q)){
        $query =$query
        ->andWhere('s.Nom LIKE :q')
        ->setParameter('q', "%{$search->q}%");
    }

      // recherche par nom de produit
      if(!empty($search->nom)){
        $query =$query
        ->andWhere('s.nom LIKE :nom')
        ->setParameter('nom', "%{$search->nom}%");
    }

    // recherche par tailleEcran
    if(!empty($search->Capacite)){
        $query =$query
        ->andWhere('s.Capacite  LIKE :Capacite')
        ->setParameter('Capacite', "%{$search->Capacite}%");
    }

   // filter prix
    if(!empty($search->min)){
        $query =$query
        ->andWhere('s.prix >= :min')
        ->setParameter('min', $search->min);
       
    }

    if(!empty($search->max)){
        $query =$query
        ->andWhere('s.prix <= :max')
        ->setParameter('max', $search->max);
    }

         // smartPhoneCategorie
         if(!empty($search->smartPhoneCategorie)){
            $query =$query
            ->andWhere('c.id IN (:smartPhoneCategorie)')
            ->setParameter('smartPhoneCategorie', $search->smartPhoneCategorie);
        }
         
        $query = $query->getQuery();
        return $this->paginator->paginate(
            $query,
           $search->page,
            16
        );
   
}     
     
}
    



