<?php

namespace Framework\AccessControl;

use App\Models\Users;
use Framework\AccessControl\Exceptions\ConfigurationNotFoundException;
use Framework\AccessControl\Exceptions\SessionNotFoundException;
use Framework\AccessControl\Exceptions\UserNotFoundException;
use Framework\AccessControl\Exceptions\UserRoleNotFound;
use Framework\DatabaseHandler\exceptions\RecordNotFoundException;
use Framework\DatabaseHandler\MysqlConnection;
use Framework\Session\Session;

class AccessControl
{

    private array $config;

    const ROLES_ORDER_KEY_NAME = 'order';
    const USER_ROLES_KEY_NAME = 'role';
    const ROLES_ACTIONS_KEY_NAME = 'actions';

    /**
     * Deze class wordt gebruikt om te checken of de huisdige gebruiker een controller actie mag uitvoeren.
     *
     * Als Alleen de controller naam gedefineerd is dan mij je alle acties van die controller uitvoeren
     *
     * Bij het installeren van deze klaase moet je eerst de configuratie inladen
     * @param array $config
     */
    public function __construct(private Session $session, public AccessGates $gates)
    {
        try {
            $this->config = include $_SERVER['DOCUMENT_ROOT'] . '/..//src/Framework/AccessControl/Configuration/RolsConfig.php';
        } catch (\TypeError) {
            throw new ConfigurationNotFoundException();
        }

        //Controleer of er wel een sessie actief is
        if (empty($this->session))
            throw new SessionNotFoundException();

    }


    /**
     * @param string $controller
     * @param string $action
     * @return void
     * @throws UserNotFoundException
     * @throws UserRoleNotFound
     */
    public function can(string $controller, string $action): bool
    {
        $roleValues = array_values($this->config[self::USER_ROLES_KEY_NAME]);
        $roleNames = array_keys($this->config[self::USER_ROLES_KEY_NAME]);
        $result = false;
        //Controleer of de gebruiker bestaat
        if (is_null($this->session))
            throw new UserNotFoundException();

            $userRolesJson = json_decode($this->session->user->roles);
            if ($userRolesJson) {
                foreach ($userRolesJson as $item) {
                    if ($result)
                        break;

                    //controleer of de key wel gedefinieerd is
                    if (!in_array($item, $roleValues))
                        throw new UserRoleNotFound();

                    $fetchedController = $this->config[self::ROLES_ACTIONS_KEY_NAME][$roleNames[$item]][$controller] ?? null;

                    //Als het een array is dan moet er gekeken worden of de actie er in staat

                    if ($fetchedController && is_array($fetchedController)) {
                        $result = in_array($action, $fetchedController);
                        continue;
                    }

                    //Als de controller als key bestaat en het is geen array return true
                    $result = is_string($controller);
                }
            }

        return $result;
    }

}