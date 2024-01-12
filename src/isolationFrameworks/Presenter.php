<?php

namespace ArtOfUnitTesting\isolationFrameworks;

class Presenter
{

    private IView $view;

    public function __construct(IView $view)
    {
        $this->view = $view;

        // we register/attach the IView::loaded event handler here
        // and simultaneously fire it as it's called in the constructor
        $this->view->loaded([$this, 'onLoaded']);
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
