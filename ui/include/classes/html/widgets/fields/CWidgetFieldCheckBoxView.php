<?php declare(strict_types = 0);
/*
** Copyright (C) 2001-2025 Zabbix SIA
**
** This program is free software: you can redistribute it and/or modify it under the terms of
** the GNU Affero General Public License as published by the Free Software Foundation, version 3.
**
** This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
** without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
** See the GNU Affero General Public License for more details.
**
** You should have received a copy of the GNU Affero General Public License along with this program.
** If not, see <https://www.gnu.org/licenses/>.
**/


use Zabbix\Widgets\Fields\CWidgetFieldCheckBox;

class CWidgetFieldCheckBoxView extends CWidgetFieldView {

	public function __construct(CWidgetFieldCheckBox $field) {
		$this->field = $field;
	}

	public function getView(): array {
		return [
			(new CVar($this->field->getName(), '0'))->removeId(),
			(new CCheckBox($this->field->getName()))
				->setChecked((bool) $this->field->getValue())
				->setEnabled(!$this->isDisabled())
				->setLabel($this->field->getCaption())
				->onChange($this->field->getAction())
		];
	}

	public function getJavaScript(): string {
		return '
			CWidgetForm.addField(
				new CWidgetFieldCheckbox('.json_encode([
					'name' => $this->field->getName(),
					'form_name' => $this->form_name
				]).')
			);
		';
	}
}
