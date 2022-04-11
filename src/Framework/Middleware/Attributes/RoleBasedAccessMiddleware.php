<?php

namespace Framework\Middleware\Attributes;

use App\Http\Controller\SiteController;
use App\Models\Users;
use Framework\AccessControl\AccessControl;
use Framework\Container\Container;
use Framework\Core\Application;
use Framework\DatabaseHandler\Entity;
use Framework\DatabaseHandler\MysqlConnection;
use Framework\Middleware\AbstractHandler;
use Framework\Middleware\HttpUnauthorizedException;
use Framework\Middleware\Interfaces\Handler;

#[\Attribute]
class RoleBasedAccessMiddleware extends AbstractHandler implements Handler
{
    private AccessControl $accessControl;

    public function __construct(
        private string $controller,
        private string $action
    )
    {
        $this->accessControl = Application::getContainer()->get(AccessControl::class);
    }

    public function handle(): ?string
    {
        if (!$this->accessControl->can($this->controller,$this->action))
            throw new HttpUnauthorizedException('Unauthorized','401');

        return parent::handle();
    }
}