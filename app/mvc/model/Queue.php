<?php

namespace Gila\model;

class Queue extends \Gila\model\DbObjectEditable
{
	/**
	 * @return string
	 */
	public function getObjName(): string
	{
        return "queue";
	}
	/**
	 * @return array
	 */
	public function getFields(): array
	{
        return ["name", "email", "phone_nr", "category", "template", "notification_type", "data_queued"];
	}

}