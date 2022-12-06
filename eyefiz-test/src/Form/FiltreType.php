<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class FiltreType  extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type',ChoiceType::class,[
                'choices' => [
                    'temporaire' => 'temporaire',
                    'permanent' => 'permanent',
                    'partagé' => 'partagé'
                ],
                    "attr" => [
                        "class" => 'form-control ']
                ])
                ->add('dtStart',TextType::class,[
                    "attr" => [
                        "class" => 'form-control',
                        ],
                        'required' => false
                ])
                ->add('dtEnd',TextType::class,[
                    "attr" => [
                        "class" => 'form-control',
                        ],
                        'required' => false
                ])
                ->add('budget',TextType::class,[
                    "attr" => [
                        "class" => 'form-control ',
                        'placeholder' => 'Budget'],
                        'required' => false
                ])
                ->add('surface',TextType::class,[
                    "attr" => [
                        "class" => 'form-control ',
                        ],
                        'required' => false
                ])
                ->add('personnes',TextType::class,[
                    "attr" => [
                        "class" => 'form-control ',
                        ],
                        'required' => false
                ])
                ->add('Rechercher',SubmitType::class,[
                    "attr" => [
                        "class" => 'btn btn-primary'],
                    
                ]);
    }
}