<?php
use Pimcore\Bundle\GenericDataIndexBundle\PimcoreGenericDataIndexBundle;
use Pimcore\Bundle\StudioBackendBundle\PimcoreStudioBackendBundle;
use Pimcore\Bundle\StudioUiBundle\PimcoreStudioUiBundle;

return [
    //Twig\Extra\TwigExtraBundle\TwigExtraBundle::class => ['all' => true],
    Pimcore\Bundle\GenericExecutionEngineBundle\PimcoreGenericExecutionEngineBundle::class => ['all' => true],
    PimcoreGenericDataIndexBundle::class => ['all' => true],
    PimcoreStudioBackendBundle::class => ['all' => true],
    PimcoreStudioUiBundle::class => ['all' => true],
    ];
