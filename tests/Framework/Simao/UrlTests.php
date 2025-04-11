<?php

namespace Tests\Framework\Simao;

use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class UrlTests extends TestCase
{
    public function testAbout() 
    {
        //Cette fonction vérifie que le slug "about" mène bien a la page about (Bonne réponse)
        $app= new App(); 
        $request = new ServerRequest('GET','/about');
        $response = $app->run($request);
        $this->assertStringContainsString('<h1>Bienvenue About</h1>',(string) $response->getBody());
        $this->assertEquals(200,$response->getStatusCode());
    }

    public function testAccount() 
    {
        //Cette fonction vérifie que le slug "about" mène bien a la page about (Bonne réponse)
        $app= new App(); 
        $request = new ServerRequest('GET','/account');
        $response = $app->run($request);
        $this->assertStringContainsString('<h1>Bienvenue sur le Account</h1>',(string) $response->getBody());
        $this->assertEquals(200,$response->getStatusCode());
    }

    public function testBlog() 
    {
        //Cette fonction vérifie que le slug "about" mène bien a la page about (Bonne réponse)
        $app= new App(); 
        $request = new ServerRequest('GET','/blog');
        $response = $app->run($request);
        $this->assertStringContainsString('<h1>Bienvenue sur le blog</h1>',(string) $response->getBody());
        $this->assertEquals(200,$response->getStatusCode());
    }

    public function testCart() 
    {
        //Cette fonction vérifie que le slug "about" mène bien a la page about (Bonne réponse)
        $app= new App(); 
        $request = new ServerRequest('GET','/cart');
        $response = $app->run($request);
        $this->assertStringContainsString('<h1>Bienvenue sur le Cart</h1>',(string) $response->getBody());
        $this->assertEquals(200,$response->getStatusCode());
    }

    public function testContact() 
    {
        //Cette fonction vérifie que le slug "about" mène bien a la page about (Bonne réponse)
        $app= new App(); 
        $request = new ServerRequest('GET','/contact');
        $response = $app->run($request);
        $this->assertStringContainsString('<h1>Bienvenue sur les Contacts</h1>',(string) $response->getBody());
        $this->assertEquals(200,$response->getStatusCode());
    }

    public function testFaq() 
    {
        //Cette fonction vérifie que le slug "about" mène bien a la page about (Bonne réponse)
        $app= new App(); 
        $request = new ServerRequest('GET','/faq');
        $response = $app->run($request);
        $this->assertStringContainsString('<h1>Bienvenue sur la FAQ</h1>',(string) $response->getBody());
        $this->assertEquals(200,$response->getStatusCode());
    }

    public function testHome() 
    {
        //Cette fonction vérifie que le slug "about" mène bien a la page about (Bonne réponse)
        $app= new App(); 
        $request = new ServerRequest('GET','/home');
        $response = $app->run($request);
        $this->assertStringContainsString('<h1>Bienvenue sur la Page d\'acceuil</h1>',(string) $response->getBody());
        $this->assertEquals(200,$response->getStatusCode());
    }

    public function testProject() 
    {
        //Cette fonction vérifie que le slug "Project" mène bien a la page Project (Bonne réponse)
        $app= new App(); 
        $request = new ServerRequest('GET','/project');
        $response = $app->run($request);
        $this->assertStringContainsString('<h1>Bienvenue sur les Projets</h1>',(string) $response->getBody());
        $this->assertEquals(200,$response->getStatusCode());
    }

    public function testProperties() 
    {
        //Cette fonction vérifie que le slug "Properties" mène bien a la page Properties (Bonne réponse)
        $app= new App(); 
        $request = new ServerRequest('GET','/properties');
        $response = $app->run($request);
        $this->assertStringContainsString('<h1>Bienvenue sur les Propriétés</h1>',(string) $response->getBody());
        $this->assertEquals(200,$response->getStatusCode());
    }

    public function testRedirectTrailingSlash()
    {
        //On redirige les utilisateurs correctement sur une URL sans slash a la fin
        $app= new App(); 
        $request = new ServerRequest('GET','/demoslash/');
        $response = $app->run($request);
        $this->assertContains('/demoslash', $response->getHeader('Location'));
        $this->assertEquals(301,$response->getStatusCode());

    }

    public function testError404()
    {
        //Vérifie si la redirection vers l'erreur 404 fonctionne
        $app= new App(); 
        $request = new ServerRequest('GET','/aavbcd');
        $response = $app->run($request);
        $this->assertStringContainsString('<h1>Erreur 404</h1>', (string)$response->getBody());
        $this->assertEquals(404,$response->getStatusCode());

    }

}