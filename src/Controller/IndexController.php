<?php

namespace App\Controller;

use DateTimeImmutable;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\Routing\Annotation\Route;
use Lcobucci\JWT\Configuration;

/*
 *
 */
class IndexController extends AbstractController
{
    /**
     * @Route("/inbox", name="inbox")
     */
    public function index()
    {
        $config = Configuration::forSymmetricSigner(
        // You may use any HMAC variations (256, 384, and 512)
            new Sha256(),
            // replace the value below with a key of your own!
            InMemory::plainText('konshenks')
        // You may also override the JOSE encoder/decoder if needed by providing extra arguments here
        );

        assert($config instanceof Configuration);
        $username = $this->getUser()->getUsername();

        $now   = new DateTimeImmutable();
        $key = InMemory::plainText('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtZXJjdXJlIjp7InB1Ymxpc2giOlsiKiJdfX0.1eHkpZifq6HTgi_PhAUcWhB6K5xJderwN8h76MGt6wA');

        $token = $config->builder()
            // Configures the issuer (iss claim)
            ->withClaim('mercure', ['subscribe' => [sprintf("/%s", $username)]])
            // Configures the audience (aud claim)
            // Configures the id (jti claim)
            ->identifiedBy('4f1g23a12aa')
            // Configures the time that the token was issue (iat claim)
            ->issuedAt($now)
            // Configures the time that the token can be used (nbf claim)
            // Configures a new claim, called "uid"
            ->withClaim('uid', 1)
            // Configures a new header, called "foo"
            ->withHeader('foo', 'bar')
            // Builds a new token
            ;
        $response =  $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);

        return $response;
    }
}
