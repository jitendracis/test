<?php

namespace Cis\Celebrity\Controller\AbstractController;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Registry;

class CelebrityLoader implements CelebrityLoaderInterface
{
    /**
     * @var \Cis\Celebrity\Model\CelebrityFactory
     */
    protected $celebrityFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $url;

    /**
     * @param \Cis\Celebrity\Model\CelebrityFactory $celebrityFactory
     * @param OrderViewAuthorizationInterface $orderAuthorization
     * @param Registry $registry
     * @param \Magento\Framework\UrlInterface $url
     */
    public function __construct(
        \Cis\Celebrity\Model\CelebrityFactory $celebrityFactory,
        Registry $registry,
        \Magento\Framework\UrlInterface $url
    ) {
        $this->celebrityFactory = $celebrityFactory;
        $this->registry = $registry;
        $this->url = $url;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return bool
     */
    public function load(RequestInterface $request, ResponseInterface $response)
    {
        $id = (int)$request->getParam('id');
        if (!$id) {
            $request->initForward();
            $request->setActionName('noroute');
            $request->setDispatched(false);
            return false;
        }

        $celebrity = $this->celebrityFactory->create()->load($id);
        $this->registry->register('current_celebrity', $celebrity);
        return true;
    }
}
