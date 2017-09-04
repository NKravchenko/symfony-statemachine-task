<?php

namespace Jimm\BookBundle\Form;

use Jimm\BookBundle\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class);
        $builder->add('authors', TextType::class);
        $builder->add(
            'publishedAt',
            DateType::class,
            [
                'widget'         => 'single_text',
                'input'          => 'datetime',
                'view_timezone'  => 'Europe/Kiev',
                'model_timezone' => 'Etc/UTC'
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => Book::class,
                'attr'       => array('novalidate' => 'novalidate'),
            )
        );

    }

//    public function getBlockPrefix()
//    {
//        return 'jimm_book_bundle_book_type';
//    }

//->add('title', TextType::class)
//->add('email', EmailType::class)
////            ->add('float', FloatType::class)
//->add('description', TextareaType::class)
//->add('availableFrom', DateTimeType::class)
//->add('save', SubmitType::class)


//    private $name;
//    private $authors;
//    private $publishedAt;
//    private $createdAt;
//    private $updatedAt;
//    private $status;
}
