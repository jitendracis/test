<?php

namespace Cis\Celebrity\Controller\AbstractController;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;

interface CelebrityLoaderInterface
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return \Cis\Celebrity\Model\Celebrity
     */
    public function load(RequestInterface $request, ResponseInterface $response);
}
