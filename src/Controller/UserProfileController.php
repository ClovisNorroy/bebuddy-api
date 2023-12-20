<?php

namespace App\Controller;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Vich\UploaderBundle\Handler\DownloadHandler;

class UserProfileController extends AbstractController
{
    private $security;
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function getUserProfilePicture(DownloadHandler $downloadHandler): Response
    {
        /**@var User $user */
        $user = $this->security->getUser();
        $userProfile =  $user->getUserProfile();

       return $downloadHandler->downloadObject($userProfile, $fileField = 'profilePicture', $objectClass = null, $fileName = null, $forceDownload = false );
    }

    public function getUserProfileInfos(): Response
    {
        /**@var User $user */
        $user = $this->security->getUser();
        $userProfile =  $user->getUserProfile();

        return new Response(json_encode(
            array(
                'birthdate'=>$userProfile->getBirtdate(),
                'about'=>$userProfile->getDescription(),
                'gender'=>$userProfile->getGender(),
                'place'=>$userProfile->getPlace()
            )
        ));
    }

    public function setUserProfileInfos(Request $request, EntityManagerInterface $entityManager): Response
    {
                /**@var User $user */
                $user = $this->security->getUser();
                $userProfile =  $user->getUserProfile();
                $userProfileData = $request->toArray();
                $temp =  DateTimeImmutable::createFromFormat("Y/m/d", $userProfileData["birthdate"]);
                $userProfile->setDescription($userProfileData["about"]);
                $userProfile->setBirtdate($temp);
                $userProfile->setPlace($userProfileData["place"]);
                $entityManager->persist($userProfile);
                $entityManager->flush();
                return new Response("User infos saved");
    }

    public function setUserProfilePicture(Request $request, EntityManagerInterface $entityManager): Response
    {
        /**@var UploadedFile $profilePicture */
        $profilePicture = $request->files->get("profilepicture");
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