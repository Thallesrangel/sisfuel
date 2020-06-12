<?php

namespace Src\interfaces;

interface InterfaceView
{
    # Obriga a implementencao dos metodos abaixo
    public function setDir($Dir);
    public function setTitle($Title);
    public function setDescription($Description);
    public function setKeywords($Keywords);
}