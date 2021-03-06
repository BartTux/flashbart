<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class FlashcardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('exampleSentence', CheckboxType::class, [
                'label' => 'Example sentence',
                'required' => false,
                'attr' => [
                    'checked' => true
                ]
            ])
            ->add('pronunciation', CheckboxType::class, [
                'label' => 'Pronunciation',
                'required' => false,
                'attr' => [
                    'checked' => true
                ]
            ])
            ->add('sortBy', ChoiceType::class, [
                'label' => 'Sort by',
                'choices' => [
                    'Date decrease' => 1,
                    'Date increase' => 2,
                    'Word alphabetically' => 3,
                    'Word not alphabetically' => 4
                ]
            ]);
    }
}
