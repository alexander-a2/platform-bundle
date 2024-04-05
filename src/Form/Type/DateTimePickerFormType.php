<?php

namespace AlexanderA2\PlatformBundle\Form\Type;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class DateTimePickerFormType extends DatePickerFormType
{
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['attr'] = [
            'data-date-time-picker' => 'Y-m-d H:i',
            'autocomplete' => 'off',
        ];
    }
}