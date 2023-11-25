<?php

namespace App\Controller;

use App\Repository\UserProfileRepository;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;

class UserProfileController extends AbstractController
{
    private $security;
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function getUserProfile(UserProfileRepository $userProfileRepository): Response
    {
        /**@var User $user */
        $user = $this->security->getUser();
        $userProfile =  $user->getUserProfile();
        return new Response(json_encode(array('age'=>$userProfile->getAge())));
    }

    public function setProfilePicture(Request $request, EntityManagerInterface $entityManager): Response
    {
        /**@var UploadedFile $profilePicture */
        $profilePicture = $request->files->get("profilePicture");
        if($profilePicture){
            /**@var User $user */
            $user = $this->security->getUser();
            $userProfile = $user->getUserProfile();
            $userProfile->setProfilePicture($profilePicture);
            $entityManager->persist($userProfile);
            $entityManager->flush();
            return new Response("profile picture set successfully");
        }else{
            return new Response("Cannot find File");
        }

    }
}