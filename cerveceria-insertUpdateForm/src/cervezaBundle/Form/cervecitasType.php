<?php

namespace cervezaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;



class cervecitasType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre',TextType::class)
            ->add('pais',TextType::class)
            ->add('poblacion',TextType::class)
            ->add('tipo',TextType::class)
            ->add('importacion',TextType::class)
            ->add('tamano')
            ->add('fechaAlamcen')
            ->add('cantidad',IntegerType::class)//solo deja poner string, no letras
            ->add('foto')
            ->add('insertar',SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'cervezaBundle\Entity\cervecitas'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'cervezabundle_cervecitas';
    }


}
