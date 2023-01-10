<?php

namespace Gila\model;

class User extends \Gila\model\DbObjectEditable
{
	/**
	 * @return string
	 */
	public function getObjName(): string
	{
        return "user";
	}
	/**
	 * @return array
	 */
	public function getFields(): array
	{
        return ["name", "email", "phone_nr"];
	}
}