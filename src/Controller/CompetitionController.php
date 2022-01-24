<?php

namespace App\Controller;

use App\Entity\Competition;
use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CompetitionController extends AbstractController
{
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/inicio", name="inicio")
     */
    public function index(): Response
    {
        return $this->json(['Deu tudo certo']);
    }

    /**
     * @Route("/competition", name="project_new", methods={"GET"})
     */
    public function competitions(): Response
    {
        $competition = new Competition();
        $competition->setName('Champions League');

        $this->entityManager->persist($competition);
        $this->entityManager->flush();

        return $this->json($competition);
    }

    /**
     * @Route("/newteams", name="newteams", methods={"GET"})
     */
    public function teams(): Response
    {
        $team = new Team();
        $team->setName('Fenerbahce');

        $this->entityManager->persist($team);
        $this->entityManager->flush();

        return $this->json($team);
    }

    /**
     * Link an existing Competition to a new Team.
     * @var Competition $competition
     * @Route("/new-teams-competition", name="competition")
     */
    public function newTeamInCompetition(): Response
    {
//        $competition = $this->entityManager->getRepository(Competition::class)->findOneById(1);
//        $team = new Team();
//        $team->setName('Manchester United 2');
//        $team->addCompetition($competition);
//        $competition->addTeam($team);
//        $this->entityManager->persist($team);
//        $this->entityManager->flush();

        $competitions = $this->entityManager->getRepository(Team::class)->find(2);

        //dd($competitions->getTeams());
        return $this->json([$competitions],200,[], [ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER => function($obj){
            return $obj->getName();
        }]
        );

    }
}
