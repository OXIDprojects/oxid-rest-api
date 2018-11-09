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
     * Allowed filter actions
     */
    const FILTER_ACTIONS_ALLOWED = [
        'ne' => '!=',
        'eq' => '=',
        'lt' => '<',
        'le' => '<=',
        'gt' => '>',
        'ge' => '>=',
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
            foreach ($data as $key => $value) {
                $value = trim($value);
                $filterAction = substr($value, 0, 2);
                $filterValue = substr($value, 2);
                if (!empty($filterAction) && $filterValue != '') {
                    if (array_key_exists($filterAction, self::FILTER_ACTIONS_ALLOWED)) {
                        $filter[] = ['key' => $key, 'action' => self::FILTER_ACTIONS_ALLOWED[ $filterAction ], 'value' => $filterValue];
                    }
                }
            }
        }

        return $filter;
    }

}
