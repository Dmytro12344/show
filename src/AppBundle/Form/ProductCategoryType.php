<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use AppBundle\Entity\ProductCategory;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductCategoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder->add('name', TextType::class,
                    [
                        'attr' => [
                            'class' => 'form-control',
                            'placeholder' => 'app.category.name'
                        ],
                        'label' => 'app.category.name'
                    ])
                ->add('save', SubmitType::class, ['label' => 'app.category.save', 'attr' => ['class' => 'btn btn-primary']])
                ->getForm();
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) : void
    {
        $resolver->setDefaults(array(
            'data_class' => ProductCategory::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() : string
    {
        return 'appbundle_productcategory';
    }


}
