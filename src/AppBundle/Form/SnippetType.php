<?php

namespace AppBundle\Form;

use AppBundle\Entity\Snippet;
use AppBundle\Languages;
use Norzechowicz\AceEditorBundle\Form\Extension\AceEditor\Type\AceEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SnippetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextType::class)
            ->add('language', ChoiceType::class, array(
                'choices' => Languages::getArray()
            ))
            ->add('code', AceEditorType::class, array(
                'wrapper_attr' => array(),
                'width' => '100%',
                'height' => 400,
                'font_size' => 12,
                'mode' => 'ace/mode/plain_text',
                'theme' => 'ace/theme/dreamweaver',
                'tab_size' => 4,
                'read_only' => false,
                'use_soft_tabs' => false,
                'use_wrap_mode' => true,
                'show_print_margin' => false,
                'show_invisibles' => false,
                'highlight_active_line' => false,
                'options_enable_basic_autocompletion' => false,
                'options_enable_live_autocompletion' => false,
                'options_enable_snippets' => false
            ))
            ->add('private', CheckboxType::class, array(
                'required' => false
            ))
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Snippet::class
        ));
    }
}