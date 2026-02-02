// @ts-check
const { test, expect } = require('@playwright/test')
import { Locators } from '../locators.js'
import { Constants } from '../constants.js'
import { generateRandomString_LettersOnly } from '../helperFunctions';

// Use locators from imported file
const { 
  homeLoc,
  dressesLoc,
  artistLoc,
  nominationLoc,
  aboutLoc,
  helpLoc,
  shopLoc,
  loginLoc,
  logoutLoc,
  adminLoc,
  homePageTitleLoc,
  dressesPageTitleLoc,
  artistPageTitleLoc,
  nominationPageTitleLoc,
  aboutPageTitleLoc,
  helpPageTitleLoc,
  shopPageTitleLoc,
  loginPageTitleLoc,
  adminPageTitleLoc,
  loginEmailFieldLoc,
  loginPasswordFieldLoc,
  loginButtonLoc ,
  blogPageTitleLoc,
  blogLoc,
} = Locators;

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

test('Checks each menu button (Including Admin buttons) is visible, enabled, clickable, and that the user is taken to the expected page page: Home, Dresses, Artist, Nomination, About, Help, Shop, Login, Logout', async ({ page }) => {

  // Login as Admin
  await page.click(loginLoc)
  expect(await page.isVisible(loginPageTitleLoc)).toBe(true)
  await page.click(loginEmailFieldLoc)
  await page.keyboard.insertText(predefinedAdminLogin)
  await page.click(loginPasswordFieldLoc)
  await page.keyboard.insertText(predefinedAdminPassword)
  await page.click(loginButtonLoc)

 // Check Home
 await page.click(homeLoc);
 await page.waitForLoadState('networkidle')
 await page.waitForTimeout(500)
 expect(await page.isVisible(homeLoc)).toBe(true)
 expect(await page.isEnabled(homeLoc)).toBe(true)
 expect(await page.isVisible(homePageTitleLoc)).toBe(true)

  // Check Dresses
  await page.click(dressesLoc);
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(500)
  expect(await page.isVisible(dressesLoc)).toBe(true)
  expect(await page.isEnabled(dressesLoc)).toBe(true)
  expect(await page.isVisible(dressesPageTitleLoc)).toBe(true)

  // Check artist
  await page.click(artistLoc);
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(500)
  expect(await page.isVisible(artistLoc)).toBe(true)
  expect(await page.isEnabled(artistLoc)).toBe(true)
  expect(await page.isVisible(artistPageTitleLoc)).toBe(true)

  // Check Nomination
  await page.click(nominationLoc);
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(500)
  expect(await page.isVisible(nominationLoc)).toBe(true)
  expect(await page.isEnabled(nominationLoc)).toBe(true)
  expect(await page.isVisible(nominationPageTitleLoc)).toBe(true)

  // Check Blog
  await page.click(blogLoc);
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(500)
  expect(await page.isVisible(blogLoc)).toBe(true)
  expect(await page.isEnabled(blogLoc)).toBe(true)
  expect(await page.isVisible(blogPageTitleLoc)).toBe(true)

  // Check About
  await page.click(aboutLoc);
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(500)
  expect(await page.isVisible(aboutLoc)).toBe(true)
  expect(await page.isEnabled(aboutLoc)).toBe(true)
  expect(await page.isVisible(aboutPageTitleLoc)).toBe(true)

  // Check Help
  await page.click(helpLoc);
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(500)
  expect(await page.isVisible(helpLoc)).toBe(true)
  expect(await page.isEnabled(helpLoc)).toBe(true)
  expect(await page.isVisible(helpPageTitleLoc)).toBe(true)

  // Check Shop
  await page.click(shopLoc);
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(500)
  expect(await page.isVisible(shopLoc)).toBe(true)
  expect(await page.isEnabled(shopLoc)).toBe(true)
  expect(await page.isVisible(shopPageTitleLoc)).toBe(true)

  // Check Admin
  await page.click(adminLoc);
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(500)
  expect(await page.isVisible(adminLoc)).toBe(true)
  expect(await page.isEnabled(adminLoc)).toBe(true)
  expect(await page.isVisible(adminPageTitleLoc)).toBe(true)

  // Check Logout
  expect(await page.isVisible(logoutLoc)).toBe(true)
  expect(await page.isEnabled(logoutLoc)).toBe(true)
  await page.click(logoutLoc); // User is redirected to home page
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(500)
  expect(await page.isVisible(homePageTitleLoc)).toBe(true)
});
