<?php

namespace App\Form;

use App\Entity\AnnonceMoto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AnnonceMotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('marque')
            ->add('modele')
            ->add('annee', IntegerType::class)
            ->add('prix', MoneyType::class, [
                'currency' => 'EUR'
            ])
            ->add('kilometrage', IntegerType::class, [
                'required' => false
            ])
            ->add('description', TextareaType::class)
            ->add('image', FileType::class, [
                'label' => 'Image de la moto (jpg, png)',
                'mapped' => false,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AnnonceMoto::class,
        ]);
    }
}
