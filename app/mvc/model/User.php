<?php

namespace Gila\model;
use DbObject;
use Gila\interfaces\DbObjectInterface;

class User extends \Gila\model\DbObject
{
	/**
	 * @return string
	 */
	public function getObjName(): string {
        return "user";
	}
	/**
	 * @return array
	 */
	public function getFields(): array {
        return ["name", "email", "phone_nr"];
	}
}