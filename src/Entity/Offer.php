<?php

namespace App\Entity;
use App\Repository\OfferRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Validator\Constraints as CustomAssert;

#[ORM\Entity(repositoryClass: OfferRepository::class)]
#[ORM\HasLifecycleCallbacks()]

class Offer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[Assert\NotBlank(message: "Title cannot be blank")]
    #[Assert\Length(max: 255, maxMessage: "Title cannot be longer than 200 characters")]
    #[ORM\Column(length: 255)]
    private $title;
    
    #[Assert\NotBlank(message: "Description cannot be blank")]
    #[ORM\Column(type: "text")]
    private $description;
 
    #[Assert\NotBlank(message: "Author cannot be blank")]
    #[Assert\Email(message: "Author must be have a valid email address")]
    #[ORM\Column(length: 255)]
    private $author;

    #[Assert\NotNull(message: "Created At cannot be null")]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $CreatedAt = null;

    #[Assert\NotNull(message: "Motive cannot be blank")]
    #[ORM\ManyToOne(targetEntity: Motive::class)]
    #[ORM\JoinColumn(name: 'motive', referencedColumnName: 'motive')]
    private ?Motive $motive;

    #[Assert\NotNull(message: "type cannot be blank")]
    #[ORM\ManyToOne(targetEntity: Type::class)]
    #[ORM\JoinColumn(name: 'type', referencedColumnName: 'type')]
    private ?Type $type;

    #[Assert\NotNull(message: "Location cannot be blank")]
    #[ORM\ManyToOne(targetEntity: Location::class)]
    #[ORM\JoinColumn(name: 'location', referencedColumnName: 'location')]
    private ?Location $location;

    #[Assert\NotNull(message: "Status cannot be blank")]
    #[ORM\ManyToOne(targetEntity: Status::class)]
    #[ORM\JoinColumn(name: 'status', referencedColumnName: 'status')]
    private ?Status $status;

    // #[ORM\ManyToMany(targetEntity: Skill::class)]
    // #[ORM\JoinTable(name: "offer_skills")]
    // #[ORM\JoinColumn(name: "offer_id", referencedColumnName: "id")]
    // #[ORM\InverseJoinColumn(name: "skills", referencedColumnName: "skill")]
    // private Collection $skills;

    


   // Getters and setters

   public function getId(): ?int
   {
       return $this->id;
   }

   public function getTitle(): ?string
   {
       return $this->title;
   }

   public function setTitle(string $title): self
   {
       $this->title = $title;

       return $this;
   }

   public function getAuthor(): ?string
   {
       return $this->author;
   }

   public function setAuthor(string $author): self
   {
       $this->author = $author;

       return $this;
   }

   public function getDescription(): ?string
   {
       return $this->description;
   }

   public function setDescription(string $description): self
   {
       $this->description = $description;

       return $this;
   }

// Getters and setters for associated entities
   public function getMotive(): ?Motive
   {
       return $this->motive;
   }

   public function setMotive(?Motive $motive): self
   {
       $this->motive = $motive;

       return $this;
   }

   public function getLocation(): ?Location
   {
       return $this->location;
   }

   public function setLocation(?Location $location): self
   {
       $this->location = $location;

       return $this;
   }

   public function getType(): ?Type
   {
       return $this->type;
   }

   public function setType(?Type $type): self
   {
       $this->type = $type;

       return $this;
   }

   public function getStatus(): ?Status
   {
       return $this->status;
   }

   public function setStatus(?Status $status): self
   {
       $this->status = $status;

       return $this;
   }


   public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt($CreatedAt): static
    {
        if (is_string($CreatedAt)) {
            $CreatedAt = new \DateTime($CreatedAt);
        }
        $this->CreatedAt = $CreatedAt;
        return $this;
    }

    // public function __construct()
    // {
    //     $this->skills = new ArrayCollection();
    // }
    //  /**
    //  * Returns a collection of Skill entities.
    //  *
    //  * @return Collection|Skill[]
    //  */

    //   public function getSkills(): Collection
    //   {
    //       return $this->skills;
    //   }
  
    //   public function addSkill(Skill $skill): self
    //   {
    //       if (!$this->skills->contains($skill)) {
    //           $this->skills[] = $skill;
    //       }
  
    //       return $this;
    //   }
  
    //   public function removeSkill(Skill $skill): self
    //   {
    //       $this->skills->removeElement($skill);
    //       $skill->removeOffer($this); // Remove association from the other side
      
    //       return $this;
    //   }
  }
      
