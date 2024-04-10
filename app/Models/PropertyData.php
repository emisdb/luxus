<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PropertyData extends Model
{
    protected $filters = [
        'name' => 'name',
        'price' => ['min_price', 'max_price'],
        'bedrooms' => 'bedrooms',
        'bathrooms' => 'bathrooms',
        'storeys' => 'storeys',
        'garages' => 'garages',
    ];
    protected $likes = [
        'name'
        ];

    protected $fillable;
    protected $filtersToFields = [];

    public function __construct(array $attributes = [])
    {
        $this->fillable = $this->getFields();
        parent::__construct($attributes);
    }

    /**
     * @return string[]
     */
    public function getFields(): array
    {
        return array_keys($this->filters);
    }

    /**
     * @return string[]
     */
    public function getFilters(): array
    {
        $flattenedArray = array_reduce($this->filters, function ($carry, $item) {
            return array_merge($carry, is_array($item) ? $item : [$item]);
        }, []);
        return $flattenedArray;
    }
    /**
     * Querying the model.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */

    public function search($filters)
    {
        foreach ($filters as $field => $value) {
            $this->addFilter($field, $value);
        }
        $query = $this->newQuery();
        $this->buildFilter($query);
        return $query->get();
    }

    /**
     * Begin querying the model.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function buildFilter(Builder $query): Builder
    {
        foreach ($this->filtersToFields as $filterField => $filter) {
            if (is_array($filter)) {
                $this->filterIntervalValue($query, $filterField, $filter[0] ?? null, $filter[1] ?? null);
            } else {
                if(in_array($filterField,$this->likes)){
                    $query->where($filterField, 'like', '%' . trim($filter). '%');
                } else {
                    $query->where($filterField, $filter);
                }
            }
        }
        return $query;
    }

    private function filterIntervalValue(Builder $query, $field, $filterFrom, $filerTo)
    {
        if (!is_null($filterFrom)) {
            if (!is_null($filerTo)) {
                $query->whereBetween($field, [$filterFrom, $filerTo]);
            } else {
                $query->where($field, '>=', $filterFrom);
            }
        } else {
            if (!is_null($filerTo)) {
                $query->where($field, '<=', $filerTo);
            }
        }
    }

    /**
     * Begin querying the model.
     *
     */
    protected function addFilter(string $field, string $value)
    {
        foreach ($this->filters as $filterField => $filter) {
            if (is_array($filter)) {
                $key = array_search($field, $filter);
                if ($key !== false) {
                    $this->filtersToFields[$filterField][$key] = $value;
                    return;
                }
            } else {
                if ($field == $filter) {
                    $this->filtersToFields[$field] = $value;
                    return;
                }
            }
        }
        return;

    }


}
