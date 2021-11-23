<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Conversation;
use App\Entity\Message;
use App\Entity\Office;
use App\Entity\Participant;
use App\Entity\Profile;
use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $userPasswordEncoder;


    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }


    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $office = new Office();
        $office->setName('Bureau Executive');
        $manager->persist($office);

        $office = new Office();
        $office->setName('Bureau Politique');
        $manager->persist($office);

        $office = new Office();
        $office->setName('Conseil National');
        $manager->persist($office);

        $role = new Role();
        $role->setRole('SG');
        $manager->persist($role);

        $role = new Role();
        $role->setRole('SE');
        $manager->persist($role);

        $role = new Role();
        $role->setRole('SD');
        $manager->persist($role);


        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setEmail("email$i@email.com");
            $user->setPassword($this->userPasswordEncoder->encodePassword($user, "password"));
            $user->setRoles(['ROLE_USER']);
            $user->setUsername("User $i");
            $manager->persist($user);

            $profile = new Profile();
            $profile->setFirstname("Firstname $i");
            $profile->setLastname("Lastname $i");
            $profile->setUser($user);
            $manager->persist($profile);


            $message = new Message();
            $message->setContent('hi');
            $message->setUser($user);
            $manager->persist($message);

            $conversation = new Conversation();
            $conversation->setLastMessage($message);
            $manager->persist($conversation);

            $participant = new Participant();
            $participant->setUser($user);
            $participant->setConversation($conversation);
            $manager->persist($participant);

        }


        $user = new User();
        $user->setEmail("rami.aouinti@gmail.com");
        $user->setPassword($this->userPasswordEncoder->encodePassword($user, "19891989aA"));
        $user->setRoles(['ROLE_ADMIN']);
        $user->setUsername('Ramy');
        $manager->persist($user);

        $profile = new Profile();
        $profile->setFirstname("Mohamed Rami");
        $profile->setLastname("Aouinti");
        $profile->setUser($user);
        $manager->persist($profile);

        $message = new Message();
        $message->setContent('hi');
        $message->setUser($user);
        $manager->persist($message);

        $conversation = new Conversation();
        $conversation->setLastMessage($message);
        $manager->persist($conversation);

        $participant = new Participant();
        $participant->setUser($user);
        $participant->setConversation($conversation);
        $manager->persist($participant);


        $manager->flush();
    }
}
