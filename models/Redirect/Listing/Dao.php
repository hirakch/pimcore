<?php

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Commercial License (PCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3 and PCL
 */

namespace Pimcore\Model\Redirect\Listing;

use Pimcore\Model;

/**
 * @internal
 *
 * @property \Pimcore\Model\Redirect\Listing $model
 */
class Dao extends Model\Listing\Dao\AbstractDao
{
    /**
     * Loads a list of static routes for the specicifies parameters, returns an array of Redirect elements
     *
     * @return array
     */
    public function load(): array
    {
        $redirectsData = $this->db->fetchFirstColumn('SELECT id FROM redirects' . $this->getCondition() . $this->getOrder() . $this->getOffsetLimit(), $this->model->getConditionVariables());

        $redirects = [];
        foreach ($redirectsData as $redirectData) {
            $redirects[] = Model\Redirect::getById($redirectData);
        }

        $this->model->setRedirects(array_filter($redirects));

        return $redirects;
    }

    public function getTotalCount(): int
    {
        try {
            return (int) $this->db->fetchOne('SELECT COUNT(*) FROM redirects ' . $this->getCondition(), $this->model->getConditionVariables());
        } catch (\Exception $e) {
            return 0;
        }
    }
}
