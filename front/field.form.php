<?php
/**
 * -------------------------------------------------------------------------
 * ExecutionControl plugin for GLPI
 * Copyright (C) 2021 by the Belwest, Kapeshko Oleg.
 * -------------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of ExecutionControl.
 *
 * ExecutionControl is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * ExecutionControl is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ExecutionControl. If not, see <http://www.gnu.org/licenses/>.
 * --------------------------------------------------------------------------
 */

include('../../../inc/includes.php');

Session::checkLoginUser();

if (isset ($_POST['update'])) {
   $item = new PluginExecutioncontrolField();
   $item->update($_POST);
   Html::back();
}
