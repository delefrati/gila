<?php

namespace Gila\model;

class UserNotification extends \Gila\model\DbObjectEditable
{
	protected $joins = [
		'notification' => [
			'type' => 'INNER',
			'validation' => 'user.id=notification.user'
		]
	];

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
        return ["user.id", "name", "email", "phone_nr"];
	}
}