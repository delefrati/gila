<?php

namespace Gila\model;

class Notification extends \Gila\model\DbObjectEditable
{
	/**
	 * @return string
	 */
	public function getObjName(): string
	{
        return "notification";
	}
	/**
	 * @return array
	 */
	public function getFields(): array
	{
        return ["user", "category", "by_sms", "by_email", "by_notification"];
	}
}