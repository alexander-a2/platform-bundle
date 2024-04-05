<?php

namespace AlexanderA2\PlatformBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DatePickerFormType extends AbstractType
{
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['attr'] = [
            'data-date-picker' => 'Y-m-d',
            'autocomplete' => 'off',
        ];
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'widget' => 'single_text',
            'html5' => false,
        ]);
    }

    public function getParent()
    {
        return DateType::class;
    }
}