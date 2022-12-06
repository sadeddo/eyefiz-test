<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('adresse')
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
                'mapped' => true,
                'constraints' => [
                    new Regex('/^(?=.*?[A-Z])(?=.*?[0-9]).{8,15}$/','le mot de passe doit contenir entre 8 et 15 caractères,une majuscule et un chiffre')
                ],
                'error_bubbling' => true,
            ])
            ->add('dateNaissance',DateType::class,[
                'widget' => "single_text",
                'error_bubbling' => true,
            ])
            ->add('type')
            ->add('raisonSociale')
            ->add('statutJuridique')
            ->add('siret')
            ->add('dirigeant')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
