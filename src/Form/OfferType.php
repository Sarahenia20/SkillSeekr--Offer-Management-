<?php
namespace App\Form;
use App\Entity\User;
use App\Entity\Skill;
use App\Entity\Offer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Security;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
            ->add('CreatedAt')
            ->add('motive')
            ->add('type')
            ->add('location')
            ->add('status') // Remove the semicolon from this line
            ->add('skills', EntityType::class, [
                'class' => 'App\Entity\Skill',
                'choice_label' => 'skill',
                'multiple' => true,
                'expanded' => false, // Set to true if you want checkboxes instead of a dropdown
                'attr' => [
                    'class' => 'form-control', // Add any additional CSS classes if needed
                ],
            ])
            ->add('saveAsDraft', SubmitType::class, [
                'label' => 'Save as Draft',
                'attr' => ['class' => 'btn btn-primary'], // Blue button
            ]);

        // Add publish button
        $builder->add('publish', SubmitType::class, [
            'label' => 'Publish',
            'attr' => ['class' => 'btn btn-success'],
        ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Offer::class,
        ]);
    }
}
