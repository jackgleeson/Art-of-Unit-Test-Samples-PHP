<?php

namespace ArtOfUnitTesting\isolationFrameworks;

use Exception;

/**
 * This is a wierd design.
 * In the real world, the presenter would internally build the view output
 * and then render it as a final step, not as an initial step.
 *
 * I think it's been cut short for the sake of the example in the book,
 * but it is horrible and confusing.
 */
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
        // in production, this would be wrapped with
        // html by the implementation of IView
        $this->view->render($viewInput);
        // also in the real world, render would be part of the
        // presenter responsibility to render the view
    }

}
