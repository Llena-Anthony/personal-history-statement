<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    /**
     * Scope for dynamic searching across multiple fields
     */
    public function scopeSearch(Builder $query, $search, $fields = null, $searchType = 'contains', $caseSensitive = false)
    {
        if (empty($search)) {
            return $query;
        }

        $searchFields = $this->getSearchableFields();
        
        // If specific fields are requested, filter to only those that are searchable
        if ($fields && is_array($fields)) {
            // Ensure fields array contains only string values for array_flip
            $fieldKeys = [];
            foreach ($fields as $field) {
                if (is_string($field) || is_int($field)) {
                    $fieldKeys[] = (string) $field;
                }
            }
            
            if (!empty($fieldKeys)) {
                $searchFields = array_intersect_key($searchFields, array_flip($fieldKeys));
            }
        }

        return $query->where(function ($q) use ($search, $searchFields, $searchType, $caseSensitive) {
            foreach ($searchFields as $field => $config) {
                if (is_string($field) && !empty($field)) {
                    $this->applySearchCondition($q, $field, $search, $searchType, $caseSensitive, $config);
                }
            }
        });
    }

    /**
     * Apply search condition based on search type
     */
    protected function applySearchCondition($query, $field, $search, $searchType, $caseSensitive, $config = [])
    {
        $operator = $caseSensitive ? 'LIKE' : 'LIKE';
        $searchValue = $search;

        switch ($searchType) {
            case 'exact':
                if ($caseSensitive) {
                    $searchValue = $search;
                    $operator = '=';
                } else {
                    $searchValue = strtolower($search);
                    $operator = 'LIKE';
                }
                break;
            case 'starts_with':
                $searchValue = $caseSensitive ? $search . '%' : strtolower($search) . '%';
                break;
            case 'ends_with':
                $searchValue = $caseSensitive ? '%' . $search : '%' . strtolower($search);
                break;
            case 'contains':
            default:
                $searchValue = $caseSensitive ? '%' . $search . '%' : '%' . strtolower($search) . '%';
                break;
        }

        // Handle relationship searches
        if (isset($config['relationship'])) {
            $query->orWhereHas($config['relationship'], function ($q) use ($field, $searchValue, $operator, $caseSensitive, $searchType) {
                if ($caseSensitive) {
                    $q->where($field, $operator, $searchValue);
                } else {
                    if ($searchType === 'exact') {
                        $q->whereRaw("LOWER({$field}) = ?", [strtolower($searchValue)]);
                    } else {
                        $q->whereRaw("LOWER({$field}) LIKE ?", [strtolower($searchValue)]);
                    }
                }
            });
        } else {
            // Check if this is a relationship field (contains dot notation)
            if (strpos($field, '.') !== false) {
                $parts = explode('.', $field);
                if (count($parts) === 2) {
                    $relationship = $parts[0];
                    $relatedField = $parts[1];
                    
                    $query->orWhereHas($relationship, function ($q) use ($relatedField, $searchValue, $operator, $caseSensitive, $searchType) {
                        if ($caseSensitive) {
                            $q->where($relatedField, $operator, $searchValue);
                        } else {
                            if ($searchType === 'exact') {
                                $q->whereRaw("LOWER({$relatedField}) = ?", [strtolower($searchValue)]);
                            } else {
                                $q->whereRaw("LOWER({$relatedField}) LIKE ?", [strtolower($searchValue)]);
                            }
                        }
                    });
                    return;
                }
            }
            
            // Handle direct field searches
            if ($caseSensitive) {
                $query->orWhere($field, $operator, $searchValue);
            } else {
                if ($searchType === 'exact') {
                    $query->orWhereRaw("LOWER({$field}) = ?", [strtolower($searchValue)]);
                } else {
                    $query->orWhereRaw("LOWER({$field}) LIKE ?", [strtolower($searchValue)]);
                }
            }
        }
    }

    /**
     * Get searchable fields for this model
     * Override this method in your model to define searchable fields
     */
    public function getSearchableFields()
    {
        // Default implementation - search in fillable fields
        $fields = [];
        foreach ($this->fillable as $field) {
            $fields[$field] = [
                'type' => 'string',
                'searchable' => true
            ];
        }
        return $fields;
    }

    /**
     * Scope for filtering by status
     */
    public function scopeFilterByStatus(Builder $query, $status)
    {
        if (empty($status)) {
            return $query;
        }

        $statusField = $this->getStatusField();
        return $query->where($statusField, $status);
    }

    /**
     * Scope for filtering by date range
     */
    public function scopeFilterByDateRange(Builder $query, $dateFrom = null, $dateTo = null)
    {
        if ($dateFrom) {
            $query->whereDate($this->getDateField(), '>=', $dateFrom);
        }
        
        if ($dateTo) {
            $query->whereDate($this->getDateField(), '<=', $dateTo);
        }

        return $query;
    }

    /**
     * Scope for filtering by user
     */
    public function scopeFilterByUser(Builder $query, $userId)
    {
        if (empty($userId)) {
            return $query;
        }

        $userField = $this->getUserField();
        return $query->where($userField, $userId);
    }

    /**
     * Scope for filtering by user type
     */
    public function scopeFilterByUserType(Builder $query, $userType)
    {
        if (empty($userType)) {
            return $query;
        }

        return $query->whereHas('user', function ($q) use ($userType) {
            $q->where('usertype', $userType);
        });
    }

    /**
     * Get the status field name for this model
     */
    protected function getStatusField()
    {
        return 'status';
    }

    /**
     * Get the date field name for this model
     */
    protected function getDateField()
    {
        return 'created_at';
    }

    /**
     * Get the user field name for this model
     */
    protected function getUserField()
    {
        return 'user_id';
    }

    /**
     * Apply all filters at once
     */
    public function scopeApplyFilters(Builder $query, array $filters)
    {
        // Search
        if (isset($filters['search']) && !empty($filters['search'])) {
            $searchFields = null;
            if (isset($filters['search_field']) && !empty($filters['search_field'])) {
                // Ensure search_field is a string or array of strings
                if (is_string($filters['search_field'])) {
                    $searchFields = [$filters['search_field']];
                } elseif (is_array($filters['search_field'])) {
                    $searchFields = array_filter($filters['search_field'], function($field) {
                        return is_string($field) || is_int($field);
                    });
                }
            }
            
            $searchType = $filters['search_type'] ?? 'contains';
            $caseSensitive = isset($filters['case_sensitive']) && $filters['case_sensitive'] == '1';
            
            $query->search($filters['search'], $searchFields, $searchType, $caseSensitive);
        }

        // Status filter
        if (isset($filters['status']) && !empty($filters['status'])) {
            $query->filterByStatus($filters['status']);
        }

        // Date range filter
        if (isset($filters['date_from']) || isset($filters['date_to'])) {
            $query->filterByDateRange($filters['date_from'] ?? null, $filters['date_to'] ?? null);
        }

        // User filter
        if (isset($filters['user_id']) && !empty($filters['user_id'])) {
            $query->filterByUser($filters['user_id']);
        }

        // User type filter
        if (isset($filters['user_type']) && !empty($filters['user_type'])) {
            $query->filterByUserType($filters['user_type']);
        }

        // Action filter (for activity logs)
        if (isset($filters['action']) && !empty($filters['action'])) {
            $query->where('action', $filters['action']);
        }

        return $query;
    }

    /**
     * Get search suggestions based on current search
     */
    public function getSearchSuggestions($search, $field = null, $limit = 5)
    {
        $query = static::query();
        
        if ($field) {
            $query->where($field, 'LIKE', "%{$search}%");
        } else {
            $searchFields = array_keys($this->getSearchableFields());
            $query->where(function ($q) use ($search, $searchFields) {
                foreach ($searchFields as $field) {
                    $q->orWhere($field, 'LIKE', "%{$search}%");
                }
            });
        }

        return $query->distinct()->limit($limit)->pluck($field ?: 'id');
    }
} 