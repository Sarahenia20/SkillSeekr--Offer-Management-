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
            ->add('CreatedAt')
            ->add('motive')
            ->add('type')
            ->add('location')
            ->add('status') // Remove the semicolon from this line
            ->add('skills', TextType::class, [
                'mapped' => false, // This field is not mapped to any property in the entity
                'required' => false, // Skills are added dynamically, so this field is not required
                'attr' => [
                    'placeholder' => 'Type or select skills',
                    'class' => 'form-control', // Add any additional CSS classes if needed
                ],
            ]);
    
        // Add the author field (read-only)
        $user = $this->security->getUser();
        if ($user instanceof User) {
            $builder->add('author', null, [
                'data' => $user->getEmail(),
                'disabled' => true,
                'label' => 'Author (Email)',
                'required' => true,
            ]);
        }
        
    
        // Add publish button
        $builder->add('publish', SubmitType::class, [
            'label' => 'Publish',
            'attr' => ['class' => 'btn btn-success'],
        ]);
    }
}