<?php

namespace App\Entity;

use App\Repository\SourceTypeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SourceTypeRepository::class)]
class SourceType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $name;
    #[ORM\OneToMany(mappedBy: 'sourceType', targetEntity: Source::class)]
    private $sources;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): SourceType
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Source>
     */
    public function getSources(): Collection
    {
        return $this->sources;
    }

    /**
     * @param Source $source
     * @return $this
     */
    public function addSource(Source $source): SourceType
    {
        if (!$this->sources->contains($source)) {
            $this->sources[] = $source;
            $source->setSourceType($this);
        }

        return $this;
    }

    /**
     * @param Source $source
     * @return $this
     */
    public function removeSource(Source $source): SourceType
    {
        if ($this->sources->removeElement($source)) {
            // set the owning side to null (unless already changed)
            if ($source->getSourceType() === $this) {
                $source->setSourceType(null);
            }
        }

        return $this;
    }
}
