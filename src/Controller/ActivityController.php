<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Repository\ActivityRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ActivityController extends AbstractController
{
  public function showActivity(int $id, ActivityRepository $activityRepository): Response
  {
    $encoders = [new XmlEncoder(), new JsonEncoder()];
    $normalizers = [new ObjectNormalizer()];

    $serializer = new Serializer($normalizers, $encoders);
    header('Content-Type: application/json; charset=utf-8');
    $activity = $activityRepository->find($id);
    return new Response($serializer->serialize($activity, 'json'));
  }

  public function newActivity(Request $request,EntityManagerInterface $entityManager): Response
  {
    $activityData = $request->toArray();
    $newActivity = new Activity();
    $newActivity->setTitle($activityData['title']);
    $newActivity->setDescription($activityData['description']);
    $newActivity->setName($activityData['name']);
    $newActivity->setPlace($activityData['place']);
    $temp =  DateTime::createFromFormat("Y/m/d", $activityData['date']);
    $newActivity->setDate($temp);
    $newActivity->setNbrParticipants($activityData['nbrparticipants']);
    $newActivity->setIsPublic($activityData['privacy']);

    $entityManager->persist($newActivity);
    $entityManager->flush();

    return new Response('New Activity added,', Response::HTTP_CREATED);

  }
}
