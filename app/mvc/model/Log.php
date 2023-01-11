<?php

namespace Gila\model;

class Log extends \Gila\model\DbObjectEditable
{
	/**
	 * @return string
	 */
	public function getObjName(): string
	{
        return "log";
	}
	/**
	 * @return array
	 */
	public function getFields(): array
	{
        return ["log", "date"];
	}
}