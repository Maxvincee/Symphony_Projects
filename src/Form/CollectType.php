<?php

namespace App\Form;

use App\Entity\Collect;
use App\Entity\JeuVideo;
use App\Entity\Utilisateur;
use App\Enum\StatutJeuEnum;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CollectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('utilisateur', EntityType::class, [
                'class' => Utilisateur::class,
                'choice_label' => 'pseudo',
                'label' => 'Utilisateur',
                'placeholder' => 'Sélectionnez un utilisateur',
            ])
            ->add('jeuvideo', EntityType::class, [
                'class' => JeuVideo::class,
                'choice_label' => 'titre',
                'label' => 'Jeu vidéo',
                'placeholder' => 'Sélectionnez un jeu',
            ])
            ->add('statut', EnumType::class, [
                'class' => StatutJeuEnum::class,
                'choice_label' => function (StatutJeuEnum $statut) {
                    return $statut->getLabel();
                },
                'label' => 'Statut',
            ])
            ->add('dateModifStatut', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de modification du statut',
                'required' => false,
            ])
            ->add('prixAchat', MoneyType::class, [
                'label' => 'Prix d\'achat',
                'currency' => 'EUR',
                'required' => false,
            ])
            ->add('dateAchat', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date d\'achat',
                'required' => false,
            ])
            ->add('commentaire', TextareaType::class, [
                'label' => 'Commentaire',
                'required' => false,
                'attr' => [
                    'rows' => 4,
                    'placeholder' => 'Ajoutez un commentaire...'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Collect::class,
        ]);
    }
}
