<?php

namespace Gila\interfaces;

interface DbObjectInterface
{
    public function getObjName(): string;
    public function getFields(): array;
}