<?php
namespace App\Form;
use App\Entity\User;
use App\Entity\Skill;
use App\Entity\Offer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Security;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Draft' => 'Draft',
                    'Published' => 'Published',
                    'Archived' => 'Archived',
                ],
                'expanded' => true,
                'multiple' => false,
                'disabled' => true,
                'data' => 'Draft', 
            ]);
    }
            // ->add('skills', EntityType::class, [
            //     'class' => Skill::class,
            //     'choice_label' => 'skill',
            //     'multiple' => true,
            //     'expanded' => false, // Set to true if you want checkboxes instead of a dropdown
            // ]);



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Offer::class,
        ]);
    }
}
