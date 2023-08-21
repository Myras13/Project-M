<?php

namespace App\Repository;

use App\DTO\RegisterUserDto;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\Contracts\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    private UserPasswordHasherInterface $passwordHasher;
    private EntityManagerInterface $entityManager;

    public function __construct(
        ManagerRegistry $registry, 
        UserPasswordHasherInterface $passwordHasher, 
        EntityManagerInterface $entityManager
    ) {
        parent::__construct($registry, User::class);
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
    }

    public function findOneBy(array $criteria, array $orderBy = null): ?User
    {
        return parent::findOneBy($criteria, $orderBy);
    }

    public function create(RegisterUserDto $dto): User
    {
        $user = new User();
        $user->setEmail($dto->email);
        $user->setUsername($dto->username);
        $user->setIsVerified(false);
        $user->setCreatedAt(\DateTimeImmutable::createFromMutable(new \DateTime()));
        $user->setUpdatedAt(\DateTimeImmutable::createFromMutable(new \DateTime()));

        $user->setPassword(
            $this->passwordHasher->hashPassword($user,$dto->password)
        );

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

//    /**
//     * @return User[] Returns an array of User objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?User
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
