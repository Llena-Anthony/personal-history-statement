# Enhanced Search Bar Documentation

## Overview

The enhanced search bar system provides powerful, flexible database searching capabilities across all admin sections. It allows users to search across any database fields with advanced filtering options.

## Key Features

### 🔍 **Universal Database Search**
- Search across any database field dynamically
- Support for relationship-based searches
- Multiple search types (contains, exact, starts with, ends with)
- Case-sensitive and case-insensitive options

### 🎯 **Field-Specific Search**
- Dropdown to select specific fields to search in
- Automatic field discovery from models
- Human-readable field labels

### ⚙️ **Advanced Search Options**
- Search type selection
- Case sensitivity toggle
- Results per page configuration
- Collapsible advanced options panel

### 🔄 **Smart Filtering**
- Status-based filtering
- Date range filtering
- User and user type filtering
- Action-based filtering (for activity logs)

## Architecture

### 1. Searchable Trait (`app/Traits/Searchable.php`)

The core of the enhanced search system is the `Searchable` trait that can be added to any Eloquent model.

```php
use App\Traits\Searchable;

class User extends Authenticatable
{
    use Searchable;
    
    public function getSearchableFields()
    {
        return [
            'name' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Full Name'
            ],
            'email' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'Email Address'
            ],
            'user.name' => [
                'type' => 'string',
                'searchable' => true,
                'label' => 'User Name',
                'relationship' => 'user'
            ]
        ];
    }
}
```

### 2. Enhanced Search Bar Component

The search bar component (`resources/views/components/admin/search-bar.blade.php`) provides:

- **Dynamic field selection**: Choose which fields to search in
- **Advanced search options**: Search type, case sensitivity, results per page
- **Smart filtering**: Status, date range, user filters
- **Visual feedback**: Active filter count and search icon

### 3. Controller Integration

Controllers use the `applyFilters` method to handle all search parameters:

```php
public function index(Request $request)
{
    $query = User::query();
    
    // Apply all filters using the Searchable trait
    $query->applyFilters($request->all());
    
    // Get searchable fields for the search bar
    $searchFields = collect((new User())->getSearchableFields())
        ->mapWithKeys(function ($config, $field) {
            return [$field => $config['label'] ?? ucfirst(str_replace('_', ' ', $field))];
        })->toArray();
    
    $users = $query->paginate($request->get('per_page', 10))->withQueryString();
    
    return view('admin.users.index', compact('users', 'searchFields'));
}
```

## Usage Examples

### Basic Search Bar
```blade
<x-admin.search-bar 
    :route="route('admin.users.index')"
    searchPlaceholder="Search by name, username, email, or any field..."
    :statusOptions="['active', 'inactive']"
    :userTypeOptions="['admin', 'personnel', 'regular']"
    :searchFields="$searchFields"
    :showFieldFilter="true"
    :enableAdvancedSearch="true"
/>
```

### Advanced Search Bar with All Options
```blade
<x-admin.search-bar 
    :route="route('admin.activity-logs.index')"
    searchPlaceholder="Search activities, users, IP addresses, or any field..."
    :statusOptions="$statuses"
    :userOptions="$users"
    :actionOptions="$actions"
    :searchFields="$searchFields"
    :showUserFilter="true"
    :showActionFilter="true"
    :showFieldFilter="true"
    :enableAdvancedSearch="true"
    gridCols="md:grid-cols-2 lg:grid-cols-4"
/>
```

## Search Types

### 1. **Contains** (Default)
- Searches for text anywhere in the field
- Example: "john" finds "John Doe", "Johnny", "Johnson"

### 2. **Exact Match**
- Searches for exact text match
- Example: "john" only finds "john" (case-sensitive option available)

### 3. **Starts With**
- Searches for text at the beginning of the field
- Example: "john" finds "John Doe", "Johnny" but not "Johnson"

### 4. **Ends With**
- Searches for text at the end of the field
- Example: "son" finds "Johnson", "Wilson" but not "Sonny"

## Field Configuration

### Basic Field
```php
'name' => [
    'type' => 'string',
    'searchable' => true,
    'label' => 'Full Name'
]
```

### Relationship Field
```php
'user.name' => [
    'type' => 'string',
    'searchable' => true,
    'label' => 'User Name',
    'relationship' => 'user'
]
```

### Custom Field Types
```php
'created_at' => [
    'type' => 'datetime',
    'searchable' => true,
    'label' => 'Created Date'
],
'is_active' => [
    'type' => 'boolean',
    'searchable' => true,
    'label' => 'Active Status'
]
```

## Search Parameters

The search system handles these request parameters:

| Parameter | Type | Description |
|-----------|------|-------------|
| `search` | string | Search term |
| `search_field` | string | Specific field to search in |
| `search_type` | string | Search type (contains, exact, starts_with, ends_with) |
| `case_sensitive` | boolean | Case sensitivity (0/1) |
| `status` | string | Status filter |
| `user_id` | integer | User filter |
| `user_type` | string | User type filter |
| `action` | string | Action filter |
| `date_from` | date | Start date |
| `date_to` | date | End date |
| `per_page` | integer | Results per page |

## Model Implementation

### 1. Add Searchable Trait
```php
use App\Traits\Searchable;

class YourModel extends Model
{
    use Searchable;
}
```

### 2. Define Searchable Fields
```php
public function getSearchableFields()
{
    return [
        'field_name' => [
            'type' => 'string',
            'searchable' => true,
            'label' => 'Human Readable Label'
        ],
        'relationship.field' => [
            'type' => 'string',
            'searchable' => true,
            'label' => 'Related Field',
            'relationship' => 'relationship_name'
        ]
    ];
}
```

### 3. Override Default Methods (Optional)
```php
protected function getStatusField()
{
    return 'is_active'; // Custom status field
}

protected function getDateField()
{
    return 'created_at'; // Custom date field
}

protected function getUserField()
{
    return 'user_id'; // Custom user field
}
```

## Controller Implementation

### 1. Apply Filters
```php
public function index(Request $request)
{
    $query = YourModel::query();
    $query->applyFilters($request->all());
    
    $results = $query->paginate($request->get('per_page', 10))->withQueryString();
    
    return view('your.view', compact('results'));
}
```

### 2. Provide Search Fields
```php
$searchFields = collect((new YourModel())->getSearchableFields())
    ->mapWithKeys(function ($config, $field) {
        return [$field => $config['label'] ?? ucfirst(str_replace('_', ' ', $field))];
    })->toArray();
```

## Advanced Features

### 1. **Search Suggestions**
```php
$suggestions = User::getSearchSuggestions('john', 'name', 5);
```

### 2. **Custom Search Conditions**
```php
// In your model
protected function applySearchCondition($query, $field, $search, $searchType, $caseSensitive, $config = [])
{
    // Custom search logic for specific fields
    if ($field === 'custom_field') {
        $query->orWhereRaw("CUSTOM_SEARCH_FUNCTION({$field}, ?)", [$search]);
        return;
    }
    
    // Default search logic
    parent::applySearchCondition($query, $field, $search, $searchType, $caseSensitive, $config);
}
```

### 3. **Performance Optimization**
```php
// Add indexes to your database
Schema::table('users', function (Blueprint $table) {
    $table->index(['name', 'username', 'email']);
    $table->index('is_active');
    $table->index('created_at');
});
```

## Security Considerations

### 1. **SQL Injection Prevention**
- All search parameters are properly escaped
- Uses Laravel's query builder for safe SQL generation
- Parameter binding for all user inputs

### 2. **Access Control**
- Search functionality respects model-level permissions
- User can only search in fields they have access to
- Relationship searches respect foreign key constraints

### 3. **Rate Limiting**
```php
// Add to your routes
Route::middleware(['throttle:60,1'])->group(function () {
    Route::get('/admin/users', [AdminUserController::class, 'index']);
});
```

## Performance Tips

### 1. **Database Indexes**
```sql
-- Add indexes for frequently searched fields
CREATE INDEX idx_users_name ON users(name);
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_users_username ON users(username);
CREATE INDEX idx_users_status ON users(is_active);
```

### 2. **Query Optimization**
```php
// Use select to limit fields
$query->select(['id', 'name', 'email', 'username']);

// Eager load relationships
$query->with(['user', 'profile']);

// Use pagination
$results = $query->paginate(25);
```

### 3. **Caching**
```php
// Cache search results for frequently searched terms
$cacheKey = "search_{$request->search}_{$request->search_field}";
$results = Cache::remember($cacheKey, 300, function () use ($query) {
    return $query->get();
});
```

## Troubleshooting

### Common Issues

1. **Search not working**
   - Check if the Searchable trait is added to the model
   - Verify searchable fields are defined correctly
   - Check database indexes

2. **Relationship searches not working**
   - Ensure relationship is defined in the model
   - Check foreign key constraints
   - Verify relationship name in searchable fields

3. **Performance issues**
   - Add database indexes
   - Limit searchable fields
   - Use pagination
   - Consider caching

### Debug Mode
```php
// Enable query logging
DB::enableQueryLog();
$results = $query->applyFilters($request->all())->get();
dd(DB::getQueryLog());
```

## Future Enhancements

### Planned Features
- Full-text search support
- Fuzzy search (typo tolerance)
- Search result highlighting
- Search analytics and insights
- Export search results
- Saved searches
- Search suggestions with autocomplete

### Custom Extensions
- Elasticsearch integration
- Algolia integration
- Custom search engines
- Multi-language search support 