<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\User;
use App\Entity\Address;

class UserAddressService {

    // Object Manager global
    private $om;

    public function __construct( ObjectManager $om ) {
        $this->om = $om;
    }

    public function add( $user ) {
        // On définit le rôle
        $user->addRole( User::ROLE['BUYER'] );

        // On active par défaut
        $user->setisActive( true );

        $repo = $this->om->getRepository( User::class );
        $this->om->persist( $user );

        // Sauvegarde base de donnée
        $this->om->flush();
    }
    
    public function getAll() {
        $repo = $this->om->getRepository( User::class );
        return $repo->findAll();
    }

    public function getOneId( $id ) {
        $repo = $this->om->getRepository( User::class );
        return $repo->find( $id );
    }

    public function isUsernameExist( $username ) {
        $repo = $this->om->getRepository( User::class );
        return ( !empty( $repo->findBy( array( 'username' => $username ) )[0]->getUsername() ) );
    }

    public function getPassword( $username ) {
        $repo = $this->om->getRepository( User::class );
        return $repo->findBy( array( 'username' => $username ) )[0]->getPassword();
    }

    public function isConnected( $user ) {
        $user_password = $user->getPassword();
        $bdd_password = $this->getPassword( $user->getUsername() );
        return ( password_verify( $user_password, $bdd_password ) );
    }

}