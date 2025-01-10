<?php
require_once './../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');

$twig = new \Twig\Environment($loader);

$teams = [
    ['name' => 'Angry Owls', 'logo' => 'team-a-logo.png', 'description' => 'A team of angry owls'],
    ['name' => 'Chatty Parrots', 'logo' => 'team-b-logo.png', 'description' => 'A team of chatty parrots'],
    ['name' => 'Panthers', 'logo' => 'team-c-logo.png', 'description' => 'A team of panthers'],
    ['name' => 'Sparrow',  'logo' => 'team-d-logo.png', 'description' => 'The spies from the east'],
    ['name' => 'Vendetta', 'logo' => 'team-e-logo.png', 'description' => 'A knack for revenge']
    
];

echo $twig->render('teams.html.twig', [
    'page_title' => 'THE LEAGUE',
    'teams' => $teams,
    'header_title' => '',
    'section_title' => ''
]);
