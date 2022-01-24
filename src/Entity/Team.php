<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="team")
*/
class Team
{
/**
* @ORM\Id
* @ORM\Column(name="id", type="integer")
* @ORM\GeneratedValue(strategy="AUTO")
*/
private $id;

/**
* @ORM\Column(name="name", type="string", length=100, nullable=false)
*/
private $name;

/**
* @ORM\ManyToMany(targetEntity="Competition", inversedBy="teams")
* @ORM\JoinTable(name="team_competition")
*/
private $competitions;

public function __construct()
{
$this->competitions = new ArrayCollection();
}

public function getId(): int
{
return $this->id;
}

public function setName(string $name): self
{
$this->name = $name;

return $this;
}

public function getName(): string
{
return $this->name;
}

public function addCompetition(Competition $competition): self
{
$this->competitions[] = $competition;

return $this;
}

public function removeCompetition(Competition $competition): bool
{
return $this->competitions->removeElement($competition);
}

public function getCompetitions(): Collection
{
return $this->competitions;
}
}