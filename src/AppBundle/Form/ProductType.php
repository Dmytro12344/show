<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class,

            ['attr' => ['placeholder' => 'app.product.name', 'class' => 'form-control'],
                'label' => 'app.product.name',
            'translation_domain' => 'messages',])

            ->add('price', TextType::class,
                ['attr' => ['placeholder' => 'app.product.price', 'class' => 'form-control'],
                    'label' => 'app.product.price',
                    ])

            ->add('description', TextType::class,
                ['attr' => ['placeholder' => 'app.product.description', 'class' => 'form-control'],
                    'label' => 'app.product.description',
                    ])

            ->add('category', EntityType::class, [
                'class' => 'AppBundle:ProductCategory',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'DESC');
                },
                'choice_label' => 'name',
                'placeholder' => 'app.product.chose_cat',
                'attr' => ['class' => 'form-control'],
                'label' => 'app.product.categories'
                ])
            ->add('save', SubmitType::class, ['label' => 'app.product.save', 'attr' => ['class' => 'btn btn-primary']])
        ->getForm();


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_product';
    }


}
