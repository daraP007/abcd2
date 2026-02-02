const { test, expect } = require('@playwright/test')
import { Locators } from '../locators.js'
import { Constants } from '../constants.js'
import { generateRandomString_LettersOnly } from '../helperFunctions';

//  Import locators from file
const { 
  loginLoc,
  welcomeBackTitleLoc,
  loginEmailAddressLabelLoc,
  loginEmailFieldLoc,
  loginPasswordLabelLoc,
  loginPasswordFieldLoc,
  loginButtonLoc,
  forgotPasswordButtonLoc,
  registerAsNewUserTitleLoc,
  firstNameLabelLoc,
  firstNameFieldLoc,
  lastNameLabelLoc,
  lastNameFieldLoc,
  registerEmailAddressLabelLoc,
  registerEmailAddressFieldLoc,
  registerPasswordLabelLoc,
  registerPasswordFieldLoc,
  registerButtonLoc,
  adminPageTitleLoc,
  recoverEmailFieldLoc,
  resetPasswordButtonLoc,
  recoverEmailFormLoc
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

test('Login Page: Check that all titles, labels, and fields are expected', async ({ page }) => {

  await page.click(loginLoc)
  await page.waitForLoadState('networkidle')

  // Check expected fields are displayed:
  expect(await page.isVisible(welcomeBackTitleLoc)).toBe(true)
  expect(await page.isVisible(loginEmailAddressLabelLoc)).toBe(true)
  expect(await page.isVisible(loginEmailFieldLoc)).toBe(true)
  expect(await page.isVisible(loginPasswordLabelLoc)).toBe(true)
  expect(await page.isVisible(loginPasswordFieldLoc)).toBe(true)
  expect(await page.isVisible(loginButtonLoc)).toBe(true)
  expect(await page.isVisible(forgotPasswordButtonLoc)).toBe(true)
  expect(await page.isVisible(registerAsNewUserTitleLoc)).toBe(true)
  expect(await page.isVisible(firstNameLabelLoc)).toBe(true)
  expect(await page.isVisible(firstNameFieldLoc)).toBe(true)
  expect(await page.isVisible(lastNameLabelLoc)).toBe(true)
  expect(await page.isVisible(lastNameFieldLoc)).toBe(true)
  expect(await page.isVisible(registerEmailAddressLabelLoc)).toBe(true)
  expect(await page.isVisible(registerEmailAddressFieldLoc)).toBe(true)
  expect(await page.isVisible(registerPasswordLabelLoc)).toBe(true)
  expect(await page.isVisible(registerPasswordFieldLoc)).toBe(true)
  expect(await page.isVisible(registerButtonLoc)).toBe(true)

  // Check expected fields are enabled:
  expect(await page.isEnabled(loginEmailFieldLoc)).toBe(true)
  expect(await page.isEnabled(loginPasswordFieldLoc)).toBe(true)
  expect(await page.isEnabled(loginButtonLoc)).toBe(true)
  expect(await page.isEnabled(forgotPasswordButtonLoc)).toBe(true)
  expect(await page.isEnabled(firstNameFieldLoc)).toBe(true)
  expect(await page.isEnabled(lastNameFieldLoc)).toBe(true)
  expect(await page.isEnabled(registerEmailAddressFieldLoc)).toBe(true)
  expect(await page.isEnabled(registerPasswordFieldLoc)).toBe(true)
  expect(await page.isEnabled(registerButtonLoc)).toBe(true)
});

test('Login Page: Register as new user', async ({ page }) => {
  
  await page.click(loginLoc)
  await page.waitForLoadState('networkidle')

  const firstName = "firstName_" + generateRandomString_LettersOnly(5)
  const lastName = "lastName_" + generateRandomString_LettersOnly(5)
  const email = "UIAUTO_" + generateRandomString_LettersOnly(5) + "@Test.com"
  const password = "password_" + generateRandomString_LettersOnly(5)

  await page.fill(firstNameFieldLoc, firstName)
  await page.fill(lastNameFieldLoc, lastName)
  await page.fill(registerEmailAddressFieldLoc, email)
  await page.fill(registerPasswordFieldLoc, password)
  await page.click(registerButtonLoc, { timeout: 5000 })
});

test('Login Page: Sign in as Admin user', async ({ page }) => {
  
  await page.click(loginLoc)
  await page.waitForLoadState('networkidle')
  await page.fill(loginEmailFieldLoc, predefinedAdminLogin)
  await page.fill(loginPasswordFieldLoc, predefinedAdminPassword)
  await page.click(loginButtonLoc)
  // User is logged in and redirected to Admin page
  expect(await page.isVisible(adminPageTitleLoc)).toBe(true)
});

test('Login Page: Attempt to recover password with wrong email', async ({ page }) => {
  
  await page.click(loginLoc)
  await page.waitForLoadState('networkidle')
  await page.click(forgotPasswordButtonLoc)
  await page.fill(recoverEmailFieldLoc, "FAKE_EMAIL@TEST.com")
  await page.click(resetPasswordButtonLoc)

  const text = await page.innerText(recoverEmailFormLoc);
  
  expect(text.includes("No email found.")).toBe(true)
});