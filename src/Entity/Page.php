<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\Entity(repositoryClass: PageRepository::class)]
#[Vich\Uploadable] 
class Page
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $title;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $subtitle;

    #[ORM\Column(type: 'string', length: 300, nullable: true)]
    private $description;

    // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[Vich\UploadableField(mapping: 'page_image', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string')]
    private ?string $imageName = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $subtitle2;

    #[ORM\ManyToOne(targetEntity: Products::class)]
    private $featuredProduct;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $valueSectionTitle;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $valueSectionSubtitle;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $value1Title;

        // NOTE: This is not a mapped field of entity metadata, just a simple property.
        #[Vich\UploadableField(mapping: 'page_image', fileNameProperty: 'value1ImageName')]
        private ?File $imageFile1 = null;

        #[ORM\Column(type: 'string', length: 255, nullable: true)]
        private ?string $value1ImageName = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $value1Description;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $value2Title;

    #[Vich\UploadableField(mapping: 'page_image', fileNameProperty: 'value2ImageName')]
    private ?File $imageFile2 = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $value2ImageName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $value2Description;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $value3Title;

    #[Vich\UploadableField(mapping: 'page_image', fileNameProperty: 'value3ImageName')]
    private ?File $imageFile3 = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $value3ImageName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $value3Description;


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

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(?string $subtitle): self
    {
        $this->subtitle = $subtitle;

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

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;
        
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSubtitle2(): ?string
    {
        return $this->subtitle2;
    }

    public function setSubtitle2(string $subtitle2): self
    {
        $this->subtitle2 = $subtitle2;

        return $this;
    }

    public function getFeaturedProduct(): ?Products
    {
        return $this->featuredProduct;
    }

    public function setFeaturedProduct(?Products $featuredProduct): self
    {
        $this->featuredProduct = $featuredProduct;

        return $this;
    }

    // public function getValueSectionTitle(): ?string
    // {
    //     return $this->valueSectionTitle;
    // }

    // public function setValueSectionTitle(?string $valueSectionTitle): self
    // {
    //     $this->valueSectionTitle = $valueSectionTitle;

    //     return $this;
    // }

    // public function getValueSectionSubtitle(): ?string
    // {
    //     return $this->valueSectionSubtitle;
    // }

    // public function setValueSectionSubtitle(?string $valueSectionSubtitle): self
    // {
    //     $this->valueSectionSubtitle = $valueSectionSubtitle;

    //     return $this;
    // }

    // public function getValue1Title(): ?string
    // {
    //     return $this->value1Title;
    // }

    // public function setValue1Title(?string $value1Title): self
    // {
    //     $this->value1Title = $value1Title;

    //     return $this;
    // }

    // /**
    //  * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
    //  * of 'UploadedFile' is injected into this setter to trigger the update. If this
    //  * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
    //  * must be able to accept an instance of 'File' as the bundle will inject one here
    //  * during Doctrine hydration.
    //  *
    //  * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
    //  */
    // public function setImageFile1(?File $imageFile1 = null): void
    // {
    //     $this->imageFile1 = $imageFile1;
        
    // }

    // public function getImageFile1(): ?File
    // {
    //     return $this->imageFile1;
    // }

    // public function getValue1ImageName(): ?string
    // {
    //     return $this->value1ImageName;
    // }

    // public function setValue1ImageName(?string $value1ImageName): self
    // {
    //     $this->value1ImageName = $value1ImageName;

    //     return $this;
    // }

    // public function getValue1Description(): ?string
    // {
    //     return $this->value1Description;
    // }

    // public function setValue1Description(?string $value1Description): self
    // {
    //     $this->value1Description = $value1Description;

    //     return $this;
    // }

    // public function getValue2Title(): ?string
    // {
    //     return $this->value2Title;
    // }

    // public function setValue2Title(?string $value2Title): self
    // {
    //     $this->value2Title = $value2Title;

    //     return $this;
    // }

    // public function setImageFile2(?File $imageFile2 = null): void
    // {
    //     $this->imageFile2 = $imageFile2;
        
    // }

    // public function getImageFile2(): ?File
    // {
    //     return $this->imageFile2;
    // }

    // public function getValue2ImageName(): ?string
    // {
    //     return $this->value2ImageName;
    // }

    // public function setValue2ImageName(?string $value2ImageName): self
    // {
    //     $this->value2ImageName = $value2ImageName;

    //     return $this;
    // }

    // public function getValue2Description(): ?string
    // {
    //     return $this->value2Description;
    // }

    // public function setValue2Description(?string $value2Description): self
    // {
    //     $this->value2Description = $value2Description;

    //     return $this;
    // }

    // public function getValue3Title(): ?string
    // {
    //     return $this->value3Title;
    // }

    // public function setValue3Title(?string $value3Title): self
    // {
    //     $this->value3Title = $value3Title;

    //     return $this;
    // }

    // public function setImageFile3(?File $imageFile3 = null): void
    // {
    //     $this->imageFile3 = $imageFile3;
        
    // }

    // public function getImageFile3(): ?File
    // {
    //     return $this->imageFile3;
    // }

    // public function getValue3ImageName(): ?string
    // {
    //     return $this->value3ImageName;
    // }

    // public function setValue3ImageName(?string $value3ImageName): self
    // {
    //     $this->value3ImageName = $value3ImageName;

    //     return $this;
    // }

    // public function getValue3Description(): ?string
    // {
    //     return $this->value3Description;
    // }

    // public function setValue3Description(?string $value3Description): self
    // {
    //     $this->value3Description = $value3Description;

    //     return $this;
    // }

}
