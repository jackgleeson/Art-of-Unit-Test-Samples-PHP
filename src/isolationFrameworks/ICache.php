<?php

namespace ArtOfUnitTesting\isolationFrameworks;

interface ICache
{

    public function getCacheInstance() : ICache;
}