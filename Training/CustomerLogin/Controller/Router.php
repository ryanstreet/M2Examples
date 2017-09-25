<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 9/20/2017
 * Time: 9:12 AM
 */

namespace Training\CustomerLogin\Controller;


use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Model\Account\Redirect;
use Magento\Customer\Model\Session;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;

class Router implements RouterInterface
{

    /**
     * @var AccountManagementInterface
     */
    private $accountManagement;
    /**
     * @var Session
     */
    private $session;
    /**
     * @var Redirect
     */
    private $redirect;

    public function __construct(
        AccountManagementInterface $accountManagement,
        Session $session,
        Redirect $redirect
    )
    {
        $this->accountManagement = $accountManagement;
        $this->session = $session;
        $this->redirect = $redirect;
    }

    /**
     * Match application action by request
     *
     * @param RequestInterface $request
     * @return ActionInterface
     */
    public function match(RequestInterface $request)
    {
        $pathParts = explode('/', ltrim($request->getPathInfo()), 2);

        if($pathParts[0] != 'login') {
            return false;
        }

        if(!isset($pathParts[1]) || !isset($pathParts[2])) {
            return false;
        }

        $username = $pathParts[1];
        $password = $pathParts[2];

        $customer = $this->accountManagement->authenticate($username, $password);
        $this->session->setCustomerDataAsLoggedIn($customer);
        $this->session->regenerateId();

        return $this->redirect->getRedirect();

    }
}