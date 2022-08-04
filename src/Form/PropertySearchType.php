<?php

namespace App\Form;

use App\Entity\Option;
use App\Entity\PropertySearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('maxPrice', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Budget Maximum'
                ]
            ])
            ->add('minSurface',  IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Surface Minimale'
                ]
            ])
            ->add('options', EntityType::class, [
                'required' => false,
                'label' => 'Options',
                'class' => Option::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('address_search', TextType::class, [
                'attr' => [
                    'autocomplete' => 'address-line1',
                    'placeholder' => 'Adresse'
                ],
                'label' => false
            ])
            ->add('city_search', TextType::class, [
                'attr' => [
                    'autocomplete' => 'address-level2',
                    'placeholder' => 'Ville'
                ],
                'label' => false
            ])
            ->add('distance', ChoiceType::class,[
                'choices' => [
                    'Indifferent' => 0,
                    '10 km' => 10,
                    '50 km' => 50,
                    '100 km' => 100
                ],
                'label' => 'Distance'
            ])
            ->add('lat', HiddenType::class)
            ->add('lng', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'translation_domain' => 'forms',
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

}
