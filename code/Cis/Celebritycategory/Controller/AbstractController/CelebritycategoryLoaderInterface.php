<?php

namespace Cis\Celebritycategory\Controller\AbstractController;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;

interface CelebritycategoryLoaderInterface
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return \Cis\Celebritycategory\Model\Celebritycategory
     */
    public function load(RequestInterface $request, ResponseInterface $response);
}
