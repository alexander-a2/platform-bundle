<?php

namespace AlexanderA2\PlatformBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class ChoiceBootstrapType extends AbstractType
{
    public function finishView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['attr']['class'] = 'selectpicker';
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'choice_bootstrap_widget';
    }
}