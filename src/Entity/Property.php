<?php

namespace App\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use App\Entity\Picture;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: PropertyRepository::class)]
/**
 * @UniqueEntity("title")
 */
class Property
{
    const HEAT =[
        0 => 'Electrique',
        1 => 'Gaz'
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    /**
     * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "Le nom du bien doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Le nom du bien ne peux pas être plus grand que {{ limit }} caractères"
     * )
     */
    private $title;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'integer')]
    /**
     * @Assert\Range(
     *      min = 10,
     *      max = 400,
     *      notInRangeMessage = "La surface doit être comprise entre {{ min }}m² et {{ max }}m²",
     * )
     */
    private $surface;

    #[ORM\Column(type: 'smallint')]
    private $rooms;

    #[ORM\Column(type: 'smallint')]
    private $bedroom;

    #[ORM\Column(type: 'smallint')]
    private $floor;

    #[ORM\Column(type: 'integer')]
    private $price;

    #[ORM\Column(type: 'integer')]
    private $heat;

    #[ORM\Column(type: 'string', length: 255)]
    private $city;

    #[ORM\Column(type: 'string', length: 255)]
    private $address;

    #[ORM\Column(type: 'string', length: 255)]
    
    /**
     * @Assert\Regex(
     *     pattern="/^[0-9]{5}/",
     *     message="Code postal invalide"
     * )
     */
    private $postal_code;

    #[ORM\Column(type: 'boolean', options : ["default" => false])]
    private $sold = false;

    #[ORM\Column(type: 'datetime_immutable')]
    private $created_at;

    #[ORM\ManyToMany(targetEntity: Option::class, inversedBy: 'properties')]
    private $options;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?DateTimeInterface $updatedAt = null;

    /**
     * @var Picture|null
     */
    private $picture;

    #[ORM\OneToMany(mappedBy: 'property', targetEntity: Picture::class, orphanRemoval: true, cascade:["persist"])]
    private $pictures;

    private $pictureFiles;

    #[ORM\Column(type: 'float', scale: 4, precision: 6)]
    private $lat;

    #[ORM\Column(type: 'float', scale: 4, precision: 7)]
    private $lng;

    public function __construct()
    {
        $this->created_at = new DateTimeImmutable();
        $this->options = new ArrayCollection();
        $this->pictures = new ArrayCollection();
        $this->updatedAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getSlug(): string
    {
        return (new AsciiSlugger())->slug($this->title)->lower();
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(int $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getBedroom(): ?int
    {
        return $this->bedroom;
    }

    public function setBedroom(int $bedroom): self
    {
        $this->bedroom = $bedroom;

        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(int $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function getFormattedPrice(): string
    {
        return number_format($this->price,0,'',' ');
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getHeat(): ?int
    {
        return $this->heat;
    }

    public function getHeatType(): string
    {
        return self::HEAT[$this->heat];
    }

    public function setHeat(int $heat): self
    {
        $this->heat = $heat;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function isSold(): ?bool
    {
        return $this->sold;
    }

    public function setSold(bool $sold): self
    {
        $this->sold = $sold;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, Option>
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(Option $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
            $option->addProperty($this);
        }

        return $this;
    }

    public function removeOption(Option $option): self
    {
        if ($this->options->removeElement($option)) {
            $option->removeProperty($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Picture>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setProperty($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getProperty() === $this) {
                $picture->setProperty(null);
            }
        }

        return $this;
    }

    /**
     * Get the value of pictureFiles
     */
    public function getPictureFiles()
    {
        return $this->pictureFiles;
    }

    public function getPicture(): ?Picture
    {
        return $this->picture;
    }

    public function setPicture(Picture $picture): self
    {
        $this->picture = $picture;
        return $this;
    }

    /**
     * Set the value of pictureFiles
     */
    public function setPictureFiles($pictureFiles): self
    {
        foreach ($pictureFiles as $pictureFile)
        {
            $picture = new Picture();
            $picture->setImageFile($pictureFile);
            $this->addPicture($picture);
        }
        $this->pictureFiles = $pictureFiles;

        dump($this->pictureFiles);

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?float
    {
        return $this->lng;
    }

    public function setLng(float $lng): self
    {
        $this->lng = $lng;

        return $this;
    }
}
