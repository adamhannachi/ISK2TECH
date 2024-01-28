<?php

namespace App\Data;

use App\Entity\Categories;

class SearchData
{
    /**
     * @var int
     */

   public $page =1;
    /**
     * @var string
     */
   public $q= "";

   

   /**
    * @var Categories []
    */
   public $smartPhoneCategorie=[];


   /**
    * @var Categories []
    */
    public $ordinateurcategory=[];
    /**
    * @var string
    */
    public $nom;

 /**
    * @var integer
    */
   public $Capacite;


/**
 * @var integer
 */  
   public $min;


   /**
 * @var integer
 */  
public $max;

   public function __toString()
   {
    return $this->q;
   
   }

}

?>