<?php
/**
 * {Description}
 *
 * @category    Wcb
 * @package     Wcb_
 * @contact     Ryan Street <rstreet@wcbradley.com>
 */

namespace Training\RequestFlow\Controller\Router;


use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;
use Magento\Framework\Exception\LocalizedException;

class LoginUser implements RouterInterface {

    /**
     * @var ActionFactory
     */
    private $actionFactory;
    /**
     * @var AccountManagementInterface
     */
    private $customerManager;
    /**
     * @var Session
     */
    private $customerSession;

    public function __construct(
        ActionFactory $actionFactory,
        AccountManagementInterface $customerManager,
        Session $customerSession
    ) {
        $this->actionFactory   = $actionFactory;
        $this->customerManager = $customerManager;
        $this->customerSession = $customerSession;
    }

    /**
     * Match application action by request
     *
     * @param RequestInterface $request
     *
     * @return ActionInterface
     */
    public function match( RequestInterface $request ) {
        $pathParts = explode( '/', ltrim( $request->getPathInfo() ), 2 );

        if ( $pathParts[0] !== 'login' ) {
            return $this->actionFactory->create( 'Magento\Framework\App\Action\Forward' );
        }

        if ( ! isset( $pathParts[1] ) || ! isset( $pathParts[2] ) ) {
            return $this->actionFactory->create( 'Magento\Framework\App\Action\Forward' );
        }

        $username = $pathParts[1];
        $password = $pathParts[2];

        try {
            $customer = $this->customerManager->authenticate( $username, $password );
            $this->customerSession->setCustomerAsLoggedIn( $customer );
            $this->customerSession->regenerateId();

            /** @var \Magento\Framework\App\Action\Redirect $result */
            $result = $this->actionFactory->create( 'Magento\Framework\App\Action\Redirect' );
            $result->getResponse()->setRedirect( 'customer/account/dashboard' );
            $result->getResponse()->setDispatched( true );

            return $this->actionFactory->create( 'Magento\Framework\App\Action\Redirect' );
        } catch ( LocalizedException $e ) {
            return $this->actionFactory->create( 'Magento\Framework\App\Action\Forward' );
        }


    }
}