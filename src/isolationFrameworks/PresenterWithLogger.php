<?php

namespace ArtOfUnitTesting\isolationFrameworks;

use Exception;

class PresenterWithLogger
{

    private IView $view;

    private ILogger $logger;

    public function __construct(IView $view, ILogger $logger)
    {
        $this->view = $view;
        $this->logger = $logger;

        // we register/attach the IView::loaded event handler here
        // and simultaneously fire it as it's called in the constructor

        try {
            $this->view->loaded([$this, 'onLoaded']);
        } catch (Exception $e) {
            $this->logger->logError($e->getMessage());
        }
    }

    /**
     * This is the Event Listener/Handler i.e. the callback
     * that will be fired for the 'loaded' event
     * @return void
     */
    public function onLoaded() : void
    {
        $viewInput = "Hello, World!";
        $this->view->render($viewInput);
    }

}
