<?php

namespace App\Form;

use DateTimeImmutable;
use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

// ------- c'est les formulaire --------------
class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->remove('imagePath', FileType::class, ['label'=>'Image'])
            ->add('description', CKEditorType::class)
            ->remove('updatedAt', HiddenType::class, ['empty_data' => date('Y-m-d H:i:s')])
            ->add('titre', TextType::class, ['label'=>'Titre', 'attr' => ['placeholder' => 'titre']])
            ->add('imageFile', FileType::class, ['label' => 'Image'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
