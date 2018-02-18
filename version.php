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
 * NOTE: Based on 'auth_loginlogoutredir' package by Felipe Carasso
 *
 * @package    auth
 * @subpackage loginlogoutredirect
 * @copyright  2018 onwards Teachstone Training, LLC
 * @author     Warren C. Wang <warren.wang@teachstone.com>
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2018021407;        // The current plugin version (Date: YYYYMMDDXX)
$plugin->requires  = 2014051200;        // Requires this Moodle version
$plugin->release   = '1.0.0';
$plugin->maturity  = MATURITY_RC;
$plugin->component = 'auth_loginlogoutredirect';      // Full name of the plugin (used for diagnostics)
