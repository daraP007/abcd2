// Import necessary functions and constants from external files for testing with Playwright
const { test, expect } = require('@playwright/test')
import { Constants } from '../constants.js' // Importing constants like URLs and credentials
import { Locators } from '../locators.js' // Importing locators for elements on the webpage

// Destructuring constant values for easier access to 'constants.js'
const {
    targetURL,
    predefinedAdminLogin,
    predefinedAdminPassword
    } = Constants

// Destructuring specific locator strings from 'locators.js'
// These strings target DOM elements on abcd2 webpage
// Access the DOM via Chrome browser with f12 and by then clicking the 'Elements' tab
// While on the 'Elements' tab you can 'control+f' to search in the DOM
const { 
        loginLoc,
        loginEmailFieldLoc,      
        loginPasswordFieldLoc,
        loginButtonLoc,        
        adminLoc,
} = Locators;

// Runs before each test
test.beforeEach(async ({ page }) => {
    // Navigate to the home page
    await page.goto(targetURL)
    // 'Wait for load state network idle': 
    //  scans the network and waits for a specific amount of time to pass without incoming/outgoing network calls
    await page.waitForLoadState('networkidle')
     // Login as admin user and go to Nominations page
     await page.click(loginLoc)
    await page.waitForLoadState('networkidle')
    await page.fill(loginEmailFieldLoc, predefinedAdminLogin)
    await page.fill(loginPasswordFieldLoc, predefinedAdminPassword)
    await page.click(loginButtonLoc)
    await page.waitForLoadState('networkidle')
  });
  
  // Runs after each test
  test.afterEach(async ({ page }) => {
    // Close the browser
    await page.close();
  });
  
  // Start test #1
  test('Test example #1', async ({ page }) => {
    // Click 'Admin' link on the menu bar
    await page.click(adminLoc)
    await page.waitForLoadState('networkidle')
    // Check icon 'My Favorite' is displayed on the 'Admin' page
    // Note the loctor is added directly as a string here rather than being imported from 'locators.js'
    // Importing from locators creates better readability and reusability
    expect(await page.isVisible("//i[@class='fa fa-shirt']")).toBe(true)
    expect(await page.isEnabled("//i[@class='fa fa-shirt']")).toBe(true)
    await page.click("//i[@class='fa fa-shirt']")
  });

 // Start test #2
 test('Test example #2', async ({ page }) => {
  // Write test #2 here
});