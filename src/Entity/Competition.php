<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="competition")
*/
class Competition
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
* @ORM\ManyToMany(targetEntity="Team", mappedBy="competitions")
*/
private $teams;

public function __construct()
{
$this->teams = new ArrayCollection();
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

public function addTeam(Team $team): self
{
$this->teams[] = $team;

return $this;
}

public function removeTeam(Team $team): bool
{
return $this->teams->removeElement($team);
}

public function getTeams(): Collection
{
return $this->teams;
}
}