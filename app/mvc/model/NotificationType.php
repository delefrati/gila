<?php

namespace Gila\model;

class NotificationType extends \Gila\model\DbObjectEditable
{
	/**
	 * @return string
	 */
	public function getObjName(): string
	{
        return "notification_type";
	}
	/**
	 * @return array
	 */
	public function getFields(): array
	{
        return ["type"];
	}
}