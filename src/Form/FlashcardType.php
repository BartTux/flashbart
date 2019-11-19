<?php

namespace App\Form;

use App\Entity\Flashcards;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FlashcardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('example_sentence', CheckboxType::class, [
                'label' => 'Example sentence'
            ])
            ->add('pronunciation', CheckboxType::class, [
                'label' => 'Pronunciation'
            ])
            ->add('sortBy', ChoiceType::class, [
                'label' => 'Sort by',
                'choices' => [
                    'Date increase' => 1,
                    'Date decrease' => 2,
                    'Word alphabetically' => 3,
                    'Word not alphabetically' => 4
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Submit'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Flashcards::class
        ]);
    }
}
