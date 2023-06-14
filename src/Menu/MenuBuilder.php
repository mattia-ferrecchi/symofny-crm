<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
class MenuBuilder
{
    private $factory;
    private AuthorizationChecker $authorizationChecker;
    public function __construct(FactoryInterface $factory, AuthorizationChecker $authorizationChecker)
    {
        $this->factory = $factory;
        $this->authorizationChecker = $authorizationChecker;
    }

    public function createMainMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');
        $isAdmin=$this->authorizationChecker->isGranted('ROLE_ADMIN');

        $menu->addChild('Home', ['route' => 'app_activity_index']);
        if ($isAdmin){
            $menu->addChild('Account', ['route' => 'app_account_index']);
        }
        $menu->addChild('Company', ['route' => 'app_company_index']);
        $menu->addChild('Site', ['route' => 'app_site_index']);
        $menu->addChild('Plant', ['route' => 'app_plant_index']);
        $menu->addChild('Operator', ['route' => 'app_operator_index']);
        // ... add more children

        return $menu;
    }
}