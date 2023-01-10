<?php

namespace Gila\model;

class Category extends \Gila\model\DbObjectEditable
{
	/**
	 * @return string
	 */
	public function getObjName(): string
	{
        return "category";
	}
	/**
	 * @return array
	 */
	public function getFields(): array
	{
        return ["name"];
	}
}