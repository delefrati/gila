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

	public function generateQueue() : bool
	{
		return $this->exec('CALL `gila`.`sp_fill_queue`()', []);
	}

	public function pop() : array
	{
		$rs = $this->getFirst();
		if (is_array($rs) && count($rs) > 0) {
			$id = $rs['id'];
			$this->delete($id);
		}
		return $rs;
	}
}