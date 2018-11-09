<?php

namespace App\Helpers;

/**
 * Class FilterHelper
 *
 * @package App\Helpers
 */
class FilterHelper
{

    /**
     * Filter delimiter
     */
    const FILTER_DELIMITER = '|';

    /**
     * Allowed filter actions
     */
    const FILTER_ACTIONS_ALLOWED = [
        '=',
        '!=',
        '<',
        '<=',
        '>',
        '>=',
        'like'
    ];

    /**
     * Prepare filters
     *
     * @return array
     */
    public static function prepareFilters(): array
    {
        $filter = [];
        $request = app('Illuminate\Http\Request');
        if ($data = $request->input('filter')) {
            foreach ($data as $value) {
                $filterData = explode(self::FILTER_DELIMITER, $value);
                $filterKey = trim($filterData[0]);
                $filterAction = trim($filterData[1]);
                $filterValue = trim($filterData[2]);
                if (!empty($filterAction) && $filterValue !== '') {
                    if (\in_array($filterAction, self::FILTER_ACTIONS_ALLOWED)) {
                        $filter[] = ['key' => $filterKey, 'action' => $filterAction, 'value' => ($filterAction === 'like' ? '%' . $filterValue . '%' : $filterValue)];
                    }
                }
            }
        }

        return $filter;
    }

}
