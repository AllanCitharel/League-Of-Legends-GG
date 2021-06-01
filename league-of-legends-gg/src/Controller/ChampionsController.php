<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ChampionsController extends AbstractController
{
    /**
     * @Route("/champions", name="champions")
     */
    public function index(): Response
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://ddragon.leagueoflegends.com/cdn/11.11.1/data/fr_FR/champion.json');
       
        $content = $response->toArray();
        $champions = $content['data'];
        // dd($champions);
        return $this->render('champions/index.html.twig', [
            'champions' => $champions,
        ]);
    }

    /**
     * @Route("/champions/{slug}", name="champion")
     */
    public function read(string $slug): Response
    {
        $client = HttpClient::create();
        
        $response = $client->request('GET', 'https://ddragon.leagueoflegends.com/cdn/11.11.1/data/fr_FR/champion/' . $slug . '.json');
        $content = $response->toArray();
        $champion = $content['data'];
        
        return $this->render('champions/read.html.twig', [
            'champion' => $champion,
        ]);
    }
}
