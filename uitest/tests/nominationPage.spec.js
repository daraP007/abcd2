const { test, expect } = require('@playwright/test')
import { Locators } from '../locators.js'
import { Constants } from '../constants.js'
import { generateRandomString_AllChars } from '../helperFunctions.js'

//  Import locators from file
const { 
  loginLoc,
  loginEmailFieldLoc,
  nominationLoc,
  nominationPageTitleLoc,
  nominationTypeLoc_Hero,
  nominationTypeLoc_Shero,
  nominationTypeLoc_Other,
  nominationNameFieldLoc,
  nominationDescriptionFieldLoc,
  nominationEmailFieldLoc,
  nominationSubmitButtonLoc,
  loginPasswordFieldLoc,
  loginButtonLoc,
  loginPageTitleLoc,
  manageNominationsTitleLoc,
  manageNominations_NameFilterFieldLoc,
} = Locators;

// Import helper function
const {
targetURL,
predefinedAdminLogin,
predefinedAdminPassword
} = Constants

test.beforeEach(async ({ page }) => {
  // Navigate to the home page
  await page.goto(targetURL)
  await page.waitForLoadState('networkidle')
});

test.afterEach(async ({ page }) => {
  // Close the browser
  await page.close();
});

test('Check Nomination page form fields', async ({ page }) => {
  // Login and go to Nominations page
  await page.click(loginLoc)
  await page.waitForLoadState('networkidle')
  await page.fill(loginEmailFieldLoc, predefinedAdminLogin)
  await page.fill(loginPasswordFieldLoc, predefinedAdminPassword)
  await page.click(loginButtonLoc)
  await page.waitForLoadState('networkidle')
  await page.click(nominationLoc)
  await page.waitForLoadState('networkidle')
  // Nomination page title
  expect(await page.isVisible(nominationPageTitleLoc)).toBe(true)
  // Radio buttons: Hero, Shero, Other
  expect(await page.isVisible(nominationTypeLoc_Hero)).toBe(true)
  expect(await page.isVisible(nominationTypeLoc_Shero)).toBe(true)
  expect(await page.isVisible(nominationTypeLoc_Other)).toBe(true)
  expect(await page.isEnabled(nominationTypeLoc_Hero)).toBe(true)
  expect(await page.isEnabled(nominationTypeLoc_Shero)).toBe(true)
  expect(await page.isEnabled(nominationTypeLoc_Other)).toBe(true)
  // Name field
  expect(await page.isVisible(nominationNameFieldLoc)).toBe(true)
  expect(await page.isEnabled(nominationNameFieldLoc)).toBe(true)
  // Description field
  expect(await page.isVisible(nominationDescriptionFieldLoc)).toBe(true)
  expect(await page.isEnabled(nominationDescriptionFieldLoc)).toBe(true)
  // Email field (Readonly)
  expect(await page.isVisible(nominationEmailFieldLoc)).toBe(true)
  expect(await page.isEditable(nominationEmailFieldLoc)).toBe(false)
  // Submit Notification button
  expect(await page.isVisible(nominationSubmitButtonLoc)).toBe(true)
  expect(await page.isEnabled(nominationSubmitButtonLoc)).toBe(true)
});

test('Check regular user must be logged in to access Nominations page and is redirected to login page', async ({ page }) => {

  await page.click(nominationLoc)
  await page.waitForLoadState('networkidle')
  expect(await page.isVisible(loginPageTitleLoc)).toBe(true)
  await page.click(nominationLoc)
  await page.waitForLoadState('networkidle')
  expect(await page.isVisible(loginPageTitleLoc)).toBe(true)
  await page.click(nominationLoc)
  await page.waitForLoadState('networkidle')
  expect(await page.isVisible(loginPageTitleLoc)).toBe(true)
});

test('Check admin user can create nominations', async ({ page }) => {
  // Create random names and descriptions for nominations
  const heroName = "HERO_NAME_" + generateRandomString_AllChars(10)
  const heroDescription = "HERO_DESCRIPTION_" + generateRandomString_AllChars(255)
  const sheroName = "SHERO_NAME_" + generateRandomString_AllChars(10)
  const sheroDescription = "DESCRIPTION_" + generateRandomString_AllChars(255)
  const otherName = "OTHER_NAME_" + generateRandomString_AllChars(10)
  const otherDescription = "OTHER_DESCRIPTION_" + generateRandomString_AllChars(255)
  // Login and go to Nominations page
  await page.click(loginLoc)
  await page.waitForLoadState('networkidle')
  await page.fill(loginEmailFieldLoc, predefinedAdminLogin)
  await page.fill(loginPasswordFieldLoc, predefinedAdminPassword)
  await page.click(loginButtonLoc)
  await page.waitForLoadState('networkidle')
  await page.click(nominationLoc)
  await page.waitForLoadState('networkidle')
  // Submit: Hero
  await page.click(nominationTypeLoc_Hero)
  await page.fill(nominationNameFieldLoc, heroName)
  await page.fill(nominationDescriptionFieldLoc, heroDescription)
  await page.click(nominationSubmitButtonLoc)
  await page.waitForLoadState('networkidle')
  expect(await page.isVisible(manageNominationsTitleLoc)).toBe(true)
  await page.click(nominationLoc)
  await page.waitForLoadState('networkidle')
  // Submit: Shero
  await page.click(nominationTypeLoc_Shero)
  await page.fill(nominationNameFieldLoc, sheroName)
  await page.fill(nominationDescriptionFieldLoc, sheroDescription)
  await page.click(nominationSubmitButtonLoc)
  await page.waitForLoadState('networkidle')
  expect(await page.isVisible(manageNominationsTitleLoc)).toBe(true)
  await page.click(nominationLoc)
  await page.waitForLoadState('networkidle')
  // Submit: Other
  await page.click(nominationTypeLoc_Other)
  await page.fill(nominationNameFieldLoc, otherName)
  await page.fill(nominationDescriptionFieldLoc, otherDescription)
  await page.click(nominationSubmitButtonLoc)
  await page.waitForLoadState('networkidle')
  expect(await page.isVisible(manageNominationsTitleLoc)).toBe(true)
  await page.waitForLoadState('networkidle')  
  // Check rows are added to grid
  var heroLocator = "//td[contains(text(), '" + heroName + "')]"
  var sheroLocator = "//td[contains(text(), '" + sheroName + "')]"
  var otherLocator = "//td[contains(text(), '" + otherName + "')]"
  await page.fill(manageNominations_NameFilterFieldLoc, heroName)
  await page.keyboard.press('Enter')
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(2000)
  expect(await page.isVisible(heroLocator)).toBe(true)
  await page.reload();
  await page.waitForLoadState('networkidle');
  await page.fill(manageNominations_NameFilterFieldLoc, sheroName)
  await page.keyboard.press('Enter')
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(2000)
  expect(await page.isVisible(sheroLocator)).toBe(true)
  await page.reload();
  await page.waitForLoadState('networkidle');
  await page.fill(manageNominations_NameFilterFieldLoc, otherName)
  await page.keyboard.press('Enter')
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(2000)
  expect(await page.isVisible(otherLocator)).toBe(true)
});
