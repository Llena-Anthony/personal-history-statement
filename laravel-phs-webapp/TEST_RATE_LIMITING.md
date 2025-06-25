# Rate Limiting Test Guide

## Testing the Real-Time Countdown Feature

### Prerequisites
- Make sure your Laravel application is running
- Have a test user account ready (e.g., testclient)

### Test Scenario 1: Basic Rate Limiting
1. Go to the login page
2. Try to log in with incorrect credentials 6+ times
3. You should see the rate limiting error message
4. The countdown timer should appear with a progress bar
5. The submit button should be disabled and show "Please wait..."

### Test Scenario 2: Page Refresh with Active Countdown
1. Trigger rate limiting as in Test 1
2. **Before the countdown ends**, refresh the page (F5 or Ctrl+R)
3. **Expected Result**: The countdown timer should immediately appear at the top of the form
4. **Expected Result**: You should see "Rate limit from previous session" indicator
5. **Expected Result**: The submit button should remain disabled
6. **Expected Result**: The countdown should continue from where it left off

### Test Scenario 3: Progressive Rate Limiting
1. Wait for the first countdown to end
2. Try logging in with incorrect credentials again
3. You should see a longer countdown time (progressive penalties)
4. Refresh the page during this longer countdown
5. Verify the longer countdown persists correctly

### Test Scenario 4: Countdown Completion
1. Start a countdown (either fresh or from page refresh)
2. Wait for the countdown to reach 0
3. **Expected Result**: Countdown should disappear with fade animation
4. **Expected Result**: Submit button should re-enable with pulse animation
5. **Expected Result**: If there was an error message, it should turn green
6. **Expected Result**: localStorage should be cleared

### Test Scenario 5: Multiple Browser Tabs
1. Open the login page in multiple tabs
2. Trigger rate limiting in one tab
3. Switch to another tab and refresh
4. **Expected Result**: Countdown should appear in the other tab too
5. **Expected Result**: Both tabs should show the same countdown time

### Visual Indicators to Look For

#### When Countdown Appears:
- ✅ Red countdown box with clock icon
- ✅ Large bold numbers showing remaining seconds
- ✅ Progress bar that shrinks over time
- ✅ Disabled submit button with "Please wait..." text
- ✅ Smooth slide-down animation

#### When Countdown is from Previous Session:
- ✅ "Rate limit from previous session" indicator
- ✅ Countdown appears at top of form (not after error message)
- ✅ Subtle red highlight effect for 2 seconds

#### When Countdown Ends:
- ✅ Smooth slide-up fade animation
- ✅ Submit button re-enables with pulse animation
- ✅ Success message (if error was present)
- ✅ localStorage is cleared

### Troubleshooting

#### Countdown Doesn't Appear on Refresh:
- Check browser console for JavaScript errors
- Verify localStorage is working (try in incognito mode)
- Check if the countdown data is properly stored

#### Countdown Shows Wrong Time:
- Clear browser localStorage: `localStorage.removeItem('rateLimitCountdown')`
- Check if the server time and client time are synchronized

#### Countdown Persists After Completion:
- Manually clear localStorage: `localStorage.removeItem('rateLimitCountdown')`
- Check for JavaScript errors preventing cleanup

### Browser Compatibility
Test in:
- ✅ Chrome/Chromium
- ✅ Firefox
- ✅ Safari
- ✅ Edge
- ✅ Mobile browsers

### Expected Behavior Summary
1. **Rate limiting triggered** → Countdown appears immediately
2. **Page refreshed** → Countdown reappears with session indicator
3. **Countdown reaches 0** → Form re-enables with animations
4. **Multiple failures** → Progressive penalties with longer countdowns
5. **Cross-tab sync** → Countdown state shared across tabs 