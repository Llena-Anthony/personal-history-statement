# Admin Search Bar Component

A reusable search bar component for Laravel Blade views that provides consistent filtering and search functionality across admin sections.

## Location
`resources/views/components/admin/search-bar.blade.php`

## Usage

### Basic Usage
```blade
<x-admin.search-bar 
    :route="route('admin.users.index')"
    searchPlaceholder="Search by name, username, or email..."
/>
```

### Advanced Usage with All Options
```blade
<x-admin.search-bar 
    :route="route('admin.activity-logs.index')"
    searchPlaceholder="Search activities, users..."
    :statusOptions="$statuses"
    :userOptions="$users"
    :actionOptions="$actions"
    :userTypeOptions="$userTypes"
    :showUserFilter="true"
    :showActionFilter="true"
    :showUserTypeFilter="true"
    :showDateFilters="true"
    gridCols="md:grid-cols-2 lg:grid-cols-4"
/>
```

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `route` | string | '' | The form action URL |
| `searchPlaceholder` | string | 'Search...' | Placeholder text for search input |
| `showDateFilters` | boolean | true | Show date range filters |
| `showStatusFilter` | boolean | true | Show status dropdown filter |
| `showUserFilter` | boolean | false | Show user dropdown filter |
| `showActionFilter` | boolean | false | Show action dropdown filter |
| `showUserTypeFilter` | boolean | false | Show user type dropdown filter |
| `statusOptions` | array | [] | Array of status options for dropdown |
| `userOptions` | array | [] | Array of user objects for dropdown |
| `actionOptions` | array | [] | Array of action options for dropdown |
| `userTypeOptions` | array | [] | Array of user type options for dropdown |
| `gridCols` | string | 'md:grid-cols-4' | Tailwind CSS grid classes |
| `additionalFilters` | slot | null | Additional custom filters slot |

## Features

### Search Input
- Text-based search with customizable placeholder
- Searches across multiple fields (implemented in controllers)

### Status Filter
- Dropdown with configurable status options
- Automatically handles request state

### User Filter
- Dropdown populated with user data
- Shows user name and username
- Requires `userOptions` array with User models

### Action Filter
- Dropdown for filtering by action type
- Automatically formats action names (underscores to spaces)

### User Type Filter
- Dropdown for filtering by user role/type
- Useful for user management and reports

### Date Range Filters
- Date from/to inputs
- Automatically handles request state
- Can be disabled with `showDateFilters="false"`

### Action Buttons
- Filter button to apply search
- Clear button to reset all filters
- Consistent styling with the application theme

## Controller Integration

The component works with existing controller search functionality. Controllers should handle the following request parameters:

- `search` - Text search
- `status` - Status filter
- `user_id` - User filter
- `action` - Action filter
- `user_type` - User type filter
- `date_from` - Start date
- `date_to` - End date

## Examples by Section

### PHS Submissions
```blade
<x-admin.search-bar 
    :route="route('admin.phs.index')"
    searchPlaceholder="Search by name or username"
    :statusOptions="['pending', 'reviewed', 'approved', 'rejected']"
    :showUserFilter="false"
    :showActionFilter="false"
    :showUserTypeFilter="false"
    gridCols="md:grid-cols-4"
/>
```

### Activity Logs
```blade
<x-admin.search-bar 
    :route="route('admin.activity-logs.index')"
    searchPlaceholder="Search activities, users..."
    :statusOptions="$statuses"
    :userOptions="$users"
    :actionOptions="$actions"
    :showUserFilter="true"
    :showActionFilter="true"
    :showUserTypeFilter="false"
    gridCols="md:grid-cols-2 lg:grid-cols-4"
/>
```

### User Management
```blade
<x-admin.search-bar 
    :route="route('admin.users.index')"
    searchPlaceholder="Search by name, username, or email..."
    :statusOptions="['active', 'inactive']"
    :userTypeOptions="['admin', 'personnel', 'regular']"
    :showUserFilter="false"
    :showActionFilter="false"
    :showUserTypeFilter="true"
    :showDateFilters="false"
    gridCols="md:grid-cols-3"
/>
```

### Reports
```blade
<x-admin.search-bar 
    :route="route('admin.reports.index')"
    searchPlaceholder="Search user, action, file..."
    :statusOptions="$statuses"
    :userTypeOptions="$userTypes"
    :showUserFilter="false"
    :showActionFilter="false"
    :showUserTypeFilter="true"
    gridCols="md:grid-cols-2 lg:grid-cols-5"
/>
```

## Styling

The component uses Tailwind CSS classes and follows the application's design system:
- Primary color: `#1B365D`
- Hover color: `#2B4B7D`
- Consistent border radius and shadows
- Responsive grid layout
- Focus states with ring effects

## Customization

### Additional Filters
You can add custom filters using the `additionalFilters` slot:

```blade
<x-admin.search-bar :route="route('admin.example.index')">
    <x-slot:additionalFilters>
        <div>
            <label for="custom_filter" class="block text-sm font-medium text-gray-700 mb-1">Custom Filter</label>
            <select name="custom_filter" id="custom_filter" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring focus:ring-[#1B365D] focus:ring-opacity-50">
                <option value="">All</option>
                <option value="option1">Option 1</option>
                <option value="option2">Option 2</option>
            </select>
        </div>
    </x-slot:additionalFilters>
</x-admin.search-bar>
```

### Custom Grid Layout
Modify the grid layout by changing the `gridCols` prop:

```blade
<!-- 2 columns on medium screens, 3 on large -->
gridCols="md:grid-cols-2 lg:grid-cols-3"

<!-- 1 column on small, 4 on medium, 6 on large -->
gridCols="sm:grid-cols-1 md:grid-cols-4 lg:grid-cols-6"
``` 