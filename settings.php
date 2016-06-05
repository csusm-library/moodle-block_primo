<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * block caps.
 *
 * @package    block_primo
 * @copyright  Nadav Kavalerchik <nadavkav@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

//$settings->add(new admin_setting_heading('header',
//                                         get_string('headerconfig', 'block_primo'),
//                                         get_string('descconfig', 'block_primo')));

$settings->add(new admin_setting_configtext('block_primo/accountsubdomainname',
                                                get_string('accountsubdomainnamelabel', 'block_primo'),
                                                get_string('accountsubdomainnamedesc', 'block_primo'),
                                                ''));
