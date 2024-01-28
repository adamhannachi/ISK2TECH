<?php
namespace App\Form;

use App\Data\SearchData;
use App\Entity\Categories;
use App\Entity\SmartPhone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class SearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {     $builder
        
        ->add('q', TextType::class, ['label' => false,'required' => false,'attr' => [
            'placeholder' => ' rechercher...','class'=>'form-control  w-75 mt-2 ms-5']])

        ->add('nom',ChoiceType::class,['label'=>false,'required' => false,'choices'  => [
            'Iphone 15 Pro Max' => 'Iphone 15 Pro Max',
            'Iphone 14 Pro' => 'Iphone 14 Pro',
            'Iphone 14 plus' => 'Iphone 14 plus',
            'Samsung Galaxy S23 FE' => 'Samsung Galaxy S23 FE',
            'Samsung Galaxy Z Flip 4' => 'Samsung Galaxy Z Flip 4',],
        'attr'=>['class'=>'form-control  mt-2 ',]
        ])

        ->add('Capacite',ChoiceType::class,['label'=>false, 'required' => false, 'choices'  => [
                '128 Go' => '128 Go',
                '256 Go ' => '256 Go',
                '512 Go' => '512 Go',
            ],
            'attr'=>[    
             'class'=>'form-control  mt-2' 
        ]
            ])

        

        ->add('smartPhoneCategorie',EntityType::class,[ 'label'=>false, 'required'=> false,'class' => Categories::class,
            'expanded'=> true, 'multiple'=> true,  'attr'=>[
                    'class'=>'form-control   mt-2  text-center  bg-transparent border-0 ']])

        ->add('min',NumberType::class,[ 'label'=>false, 'required'=> false, 'attr'=>
           [ 'placeholder'=>'Prix min €',  'class'=>'form-control  mt-2  ' ,]])

        ->add('max',NumberType::class,['label'=>false,'required'=> false,'attr'=>[
            'placeholder'=>'Prix max €',  'class'=>'form-control   mt-2 ' ]]);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SmartPhone::class, 'data_class' => SearchData::class, 'method' => 'GET', ' csrf_protection' => false]);}
}
