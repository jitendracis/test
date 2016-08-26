<?php

namespace Cis\Celebritycategory\Controller\AbstractController;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Registry;

class CelebritycategoryLoader implements CelebritycategoryLoaderInterface
{
    /**
     * @var \Cis\Celebritycategory\Model\CelebritycategoryFactory
     */
    protected $celebritycategoryFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $url;

    /**
     * @param \Cis\Celebritycategory\Model\CelebritycategoryFactory $celebritycategoryFactory
     * @param OrderViewAuthorizationInterface $orderAuthorization
     * @param Registry $registry
     * @param \Magento\Framework\UrlInterface $url
     */
    public function __construct(
        \Cis\Celebritycategory\Model\CelebritycategoryFactory $celebritycategoryFactory,
        Registry $registry,
        \Magento\Framework\UrlInterface $url
    ) {
        $this->celebritycategoryFactory = $celebritycategoryFactory;
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

        $celebritycategory = $this->celebritycategoryFactory->create()->load($id);
        $this->registry->register('current_celebritycategory', $celebritycategory);
        return true;
    }
}
