# Admin PHS Access Feature

## Overview

The Admin PHS Access feature allows administrators who are also Academy members to access and manage their own Personal History Statement (PHS) using the client interface while maintaining their admin privileges.

## Features

### 1. Access My PHS
- **Location**: Admin Dashboard (prominent button at the top)
- **Functionality**: Allows admin Academy members to access their own PHS forms
- **Session Management**: Tracks the access state and original route
- **Activity Logging**: Records all access actions for audit purposes

### 2. Return to Admin View
- **Location**: Client interface header (red "Return to Admin" button)
- **Visibility**: Only appears when an admin has accessed their PHS
- **Functionality**: Returns to admin dashboard and clears access session

### 3. Visual Indicators
- **Admin PHS Badge**: Shows "Admin PHS" badge in client interface
- **Success Messages**: Displays confirmation messages for all access actions
- **Info Modal**: Provides detailed information about the feature

## How to Use

### Accessing Your PHS
1. Log in as an administrator who is also an Academy member
2. Navigate to the Admin Dashboard
3. Click the "Access My PHS" button in the blue section at the top
4. You'll be redirected to the client dashboard
5. A success message will confirm the access

### Working on Your PHS
- Access all PHS forms as a regular Academy member
- Fill out your personal information and history
- Submit your completed PHS for review and processing
- Your PHS will be processed like any other member's submission

### Returning to Admin View
1. Look for the red "Return to Admin" button in the client header
2. Click the button to return to admin dashboard
3. Session will be cleared and you'll return to admin view

## Technical Implementation

### Routes
- `GET /admin/switch-to-client` - Access your PHS
- `GET /return-to-admin` - Return to admin view

### Session Variables
- `admin_switched_to_client` - Boolean flag indicating access state
- `admin_original_route` - Stores the original admin route

### Activity Logging
- **Access Action**: `access_own_phs`
- **Return Action**: `return_to_admin`
- All actions are logged with user ID, description, and status

### Security
- Only users with admin privileges can access PHS functionality
- Middleware protection on access routes
- Session-based state management

## Benefits

1. **Personal PHS Management**: Admins can manage their own PHS as Academy members
2. **Form Completion**: Complete and submit personal history statements
3. **Workflow Understanding**: Better understanding of the PHS process
4. **Quality Assurance**: Experience the system as an end user
5. **Dual Role Support**: Seamlessly switch between admin and member roles

## Important Notes

- **Personal Data**: You'll be working on your own PHS as an Academy member
- **Submission Processing**: Your PHS submission will be processed like any other member's
- **Data Accuracy**: Ensure all information is accurate and complete before submission
- **Session Persistence**: The access state persists until explicitly returned to admin view
- **Activity Tracking**: All access actions are logged for audit purposes

## Troubleshooting

### Button Not Visible
- Ensure you're logged in as an administrator
- Check that the admin middleware is properly configured
- Verify the route is accessible

### Can't Return to Admin
- Check if the session variable `admin_switched_to_client` is set
- Try logging out and back in if session issues occur
- Verify the return route is properly configured

### PHS Submission Issues
- Remember that you're submitting your own PHS as an Academy member
- Check activity logs for any errors
- Verify form validation rules are working correctly
- Ensure all required fields are completed accurately 