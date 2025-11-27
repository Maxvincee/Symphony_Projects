<?php

namespace App\Form;

use App\Entity\Developpeur;
use App\Entity\Editeur;
use App\Entity\Genre;
use App\Entity\JeuVideo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Doctrine\ORM\EntityRepository;

class JeuVideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre du jeu',
                'attr' => ['placeholder' => 'Ex: Mario Kart 8 Deluxe']
            ])
            ->add('dateSortie', DateType::class, [
                'label' => 'Date de sortie',
                'widget' => 'single_text', // Affiche le calendrier
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
                'attr' => ['rows' => 5]
            ])
            ->add('prix', NumberType::class, [
                'label' => 'Prix',
                'scale' => 2,
                'required' => false,
                'help' => 'Le prix est en €',
            ])

            // --- RELATIONS ---

            ->add('editeur', EntityType::class, [
                'class' => Editeur::class,
                'choice_label' => 'nom',
                'label' => 'Éditeur',
                'placeholder' => 'Choisir un éditeur...',
            ])

            ->add('developpeur', EntityType::class, [
                'class' => Developpeur::class,
                'choice_label' => 'nom',
                'label' => 'Développeur',
                'placeholder' => 'Choisir un développeur...',
            ])

            // Le filtre pour n'avoir que les genres ACTIFS
            ->add('genre', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'nom',
                'label' => 'Genre',
                'placeholder' => 'Choisir un genre...',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('g')
                        ->where('g.actif = :valeur')
                        ->setParameter('valeur', true)
                        ->orderBy('g.nom', 'ASC');
                },
            ])

            // --- LE CHAMP IMAGE ---
            ->add('imageFile', FileType::class, [
                'label' => 'Image (Jaquette)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5M', // 5 Mo max
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Veuillez uploader une image valide (JPG, PNG, webp)',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JeuVideo::class,
        ]);
    }
}
