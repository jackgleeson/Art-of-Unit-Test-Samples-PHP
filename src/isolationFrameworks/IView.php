<?php

namespace ArtOfUnitTesting\isolationFrameworks;

interface IView
{

    /**
     * This is what renders the view
     *
     * @param string $viewInput
     *
     * @return void
     */
    public function render(string $viewInput) : string;

    /**
     * This is an event that must be implemented
     * @param callable $callback
     *
     * @return void
     */
    public function loaded(callable $callback) : void;
}