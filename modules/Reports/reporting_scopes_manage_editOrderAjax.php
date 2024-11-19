<?php
/*
Gibbon: the flexible, open school platform
Founded by Ross Parker at ICHK Secondary. Built by Ross Parker, Sandra Kuipers and the Gibbon community (https://gibbonedu.org/about/)
Copyright © 2010, Gibbon Foundation
Gibbon™, Gibbon Education Ltd. (Hong Kong)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

use Gibbon\Module\Reports\Domain\ReportingScopeGateway;

$_POST['address'] = '/modules/Reports/reporting_scopes_manage.php';

require_once '../../gibbon.php';

if (isActionAccessible($guid, $connection2, '/modules/Reports/reporting_scopes_manage.php') == false) {
    exit;
} else {
    // Proceed!
    $gibbonReportingCycleID = $_POST['gibbonReportingCycleID'] ?? '';
    $order = $_POST['order'] ?? [];

    if (empty($order) || empty($gibbonReportingCycleID)) {
        exit;
    } else {
        $reportingScopeGateway = $container->get(ReportingScopeGateway::class);

        $count = 1;
        foreach ($order as $gibbonReportingScopeID) {

            $updated = $reportingScopeGateway->update($gibbonReportingScopeID, ['sequenceNumber' => $count]);
            $count++;
        }
    }
}
