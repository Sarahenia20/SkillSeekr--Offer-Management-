<?php

namespace App\Form;
use App\Repository\StatusRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\User;
use App\Entity\Skill;
use App\Entity\Status;
use App\Entity\Offer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class OfferType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('author')
            ->add('CreatedAt', DateType::class,[
                'widget'=>'single_text',
            ])
            ->add('motive')
            ->add('type')
            ->add('location')

        
            ->add('status', EntityType::class, [
                'class' => Status::class,
                'expanded' => true,
                'multiple' => false,
                'query_builder' => function (StatusRepository $repository) {
                    return $repository->createQueryBuilder('s')
                        ->where('s.status = :status')
                        ->setParameter('status', 'Draft');
                },
                'choice_attr' => function ($choice, $key, $value) {
                    if ($value !== 'Draft' ) {
                        return ['disabled' => 'disabled'];
                    }
                    return [];
                },
            ])
    
    ->add('skills', EntityType::class, [
        'class' => 'App\Entity\Skill',
        'choice_label' => 'skill',
        'multiple' => true,
        'expanded' => true,
    ]);
    // ->add('save', SubmitType::class, ['label' => 'Create Offer']);
}


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Offer::class,
        ]);
    }
}
