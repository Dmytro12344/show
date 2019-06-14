<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'id' => 'inputEmail',
                        'placeholder' => 'app.user.email'
                    ],
                    'label' => 'app.user.email',
                    'label_attr' => ['class' => 'control-label'],
                ])
            ->add('username', TextType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'id' => 'inputName',
                        'placeholder' => 'app.user.username',
                    ],
                    'label' => 'app.user.username',
                    'label_attr' => ['class' => 'control-label'],
                ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => [
                    'label' => 'app.user.first_password',
                    'label_attr' => ['class' => 'control-label'],
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'app.user.first_password',
                    ],
                ],
                'second_options' => [
                    'label' => 'app.user.second_password',
                    'label_attr' => ['class' => 'control-label'],
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'app.user.second_password',
                    ]
                ],
                'invalid_message' => 'app.user.invalid_password',
            ])
            ->add('save', SubmitType::class, ['label' => 'app.product.save', 'attr' => ['class' => 'btn btn-primary']]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
