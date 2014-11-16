<?php

namespace Omar\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DealerType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $relations = array("mate"=> "زميل في المدرسة", "friend"=> "صديق","father"=> "ولي امر", "other"=> "اخري" );
        
        $builder
            ->add('name')
            ->add('nickname')
            ->add('address')
            ->add('phone')
            ->add('mobile')
            ->add('relation', "choice" , array( "choices"=> $relations, 'empty_value' => 'اختر من القائمة'))
            //->add('avatar')
            ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Omar\SiteBundle\Entity\Dealer'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'omar_sitebundle_dealer';
    }
}
