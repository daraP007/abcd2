const { test, expect } = require('@playwright/test')
import { Locators } from '../locators.js'
import { Constants } from '../constants.js'
import { generateRandomString_AllChars } from '../helperFunctions.js';

//  Import locators from file
const { 
  loginLoc,
  loginEmailFieldLoc,
  nominationLoc,
  nominationTypeLoc_Hero,
  nominationNameFieldLoc,
  nominationDescriptionFieldLoc,
  nominationSubmitButtonLoc,
  loginPasswordFieldLoc,
  loginButtonLoc,
  manageNominationsTitleLoc,
  manageNominations_DeleteButtonLoc,
  deleteNominations_DeleteButtonLoc,
  manageNominations_NameFilterFieldLoc,
  manageNominations_ModifyButtonLoc,
  modifyNomination_HeroCatergoryLoc,
  modifyNomination_SheroCatergoryLoc,
  modifyNomination_OtherCatergoryLoc,
  modifyNomination_NameFieldLoc,
  modifyNomination_DescriptionFieldLoc,
  modifyNomination_ModifyNominationButtonLoc,
  manageNominations_DescriptionFilterFieldLoc,
  manageNominations_CategoryFilterFieldLoc,
  manageNominations_DisplayButtonLoc,
  displayNomination_TitleLoc,
  displayNomination_FieldsLoc,
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

test('Check admin user can delete nominations', async ({ page }) => {
  // Create random names and descriptions for nominations
  const heroName = "HERO_NAME_" + generateRandomString_AllChars(6)
  const heroDescription = "HERO_DESCRIPTION_" + generateRandomString_AllChars(8)
  const sheroName = "SHERO_NAME_" + generateRandomString_AllChars(5)
  const sheroDescription = "DESCRIPTION_" + generateRandomString_AllChars(7)
  const otherName = "OTHER_NAME_" + generateRandomString_AllChars(5)
  const otherDescription = "OTHER_DESCRIPTION_" + generateRandomString_AllChars(7)
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
  expect(await page.isVisible(manageNominationsTitleLoc)).toBe(true)
  await page.click(nominationLoc)
  await page.waitForLoadState('networkidle')
  // Submit: Shero
  await page.click(nominationTypeLoc_Hero)
  await page.fill(nominationNameFieldLoc, sheroName)
  await page.fill(nominationDescriptionFieldLoc, sheroDescription)
  await page.click(nominationSubmitButtonLoc)
  expect(await page.isVisible(manageNominationsTitleLoc)).toBe(true)
  await page.click(nominationLoc)
  await page.waitForLoadState('networkidle')
  // Submit: Other
  await page.click(nominationTypeLoc_Hero)
  await page.fill(nominationNameFieldLoc, otherName)
  await page.fill(nominationDescriptionFieldLoc, otherDescription)
  await page.click(nominationSubmitButtonLoc)
  expect(await page.isVisible(manageNominationsTitleLoc)).toBe(true)
  await page.waitForLoadState('networkidle')  
  // Construct locators and check for visibility before and after deletion
  var heroLocator = "//td[contains(text(), '" + heroName + "')]"
  var sheroLocator = "//td[contains(text(), '" + sheroName + "')]"
  var otherLocator = "//td[contains(text(), '" + otherName + "')]"
  // Delete: Hero
  await page.fill(manageNominations_NameFilterFieldLoc, heroName)
  await page.keyboard.press('Enter')
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(2000)
  expect(await page.isVisible(heroLocator)).toBe(true)
  await page.click(manageNominations_DeleteButtonLoc)
  await page.waitForLoadState('networkidle')
  await page.click(deleteNominations_DeleteButtonLoc)
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(1000)
  expect(await page.isHidden(heroLocator)).toBe(true)
  // Delete: Shero
  await page.reload();
  await page.waitForLoadState('networkidle');
  await page.fill(manageNominations_NameFilterFieldLoc, sheroName)
  await page.keyboard.press('Enter')
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(2000)
  expect(await page.isVisible(sheroLocator)).toBe(true)
  await page.click(manageNominations_DeleteButtonLoc)
  await page.waitForLoadState('networkidle')
  await page.click(deleteNominations_DeleteButtonLoc)
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(1000)
  expect(await page.isHidden(sheroLocator)).toBe(true)
  // Delete: Other
  await page.reload();
  await page.waitForLoadState('networkidle');
  await page.fill(manageNominations_NameFilterFieldLoc, otherName)
  await page.keyboard.press('Enter')
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(2000)
  expect(await page.isVisible(otherLocator)).toBe(true)
  await page.click(manageNominations_DeleteButtonLoc)
  await page.waitForLoadState('networkidle')
  await page.click(deleteNominations_DeleteButtonLoc)
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(1000)
  expect(await page.isHidden(otherLocator)).toBe(true)
});

test('Check admin user can modify nominations', async ({ page }) => {
  // Create random names and descriptions for nominations
  const heroName = "HERO_NAME_" + generateRandomString_AllChars(6)
  const heroDescription = "HERO_DESCRIPTION_" + generateRandomString_AllChars(8)
  const heroCategory = "Hero"
  const sheroName = "SHERO_NAME_" + generateRandomString_AllChars(5)
  const sheroDescription = "DESCRIPTION_" + generateRandomString_AllChars(7)
  const sheroCategory = "Shero"
  const otherName = "OTHER_NAME_" + generateRandomString_AllChars(5)
  const otherDescription = "OTHER_DESCRIPTION_" + generateRandomString_AllChars(7)
  const otherCategory = "Other"
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
  // Construct locators and check for visibility before and after modification
  var heroLocator = "//td[contains(text(), '" + heroName + "')]"
  await page.fill(manageNominations_NameFilterFieldLoc, heroName)
  await page.keyboard.press('Enter');
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(1500)
  expect(await page.isVisible(heroLocator)).toBe(true)
  // Modify: Hero -> Shero
  await page.click(manageNominations_ModifyButtonLoc)
  await page.click(modifyNomination_SheroCatergoryLoc)
  await page.fill(modifyNomination_NameFieldLoc, sheroName)
  await page.fill(modifyNomination_DescriptionFieldLoc, sheroDescription)
  await page.click(modifyNomination_ModifyNominationButtonLoc)
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(1500)
  await page.fill(manageNominations_NameFilterFieldLoc, heroName)
  await page.keyboard.press('Enter');
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(1500)
  expect(await page.isHidden(heroLocator)).toBe(true)
  // Check for 'Shero' in grid
  await page.reload();
  await page.waitForLoadState('networkidle');
  var sheroLocator = "//td[contains(text(), '" + sheroName + "')]"
  await page.fill(manageNominations_NameFilterFieldLoc, sheroName)
  await page.keyboard.press('Enter')
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(1500)
  expect(await page.isVisible(sheroLocator)).toBe(true)
  // Modify: Shero -> Other
  await page.click(manageNominations_ModifyButtonLoc)
  await page.click(modifyNomination_OtherCatergoryLoc)
  await page.fill(modifyNomination_NameFieldLoc, otherName)
  await page.fill(modifyNomination_DescriptionFieldLoc, otherDescription)
  await page.click(modifyNomination_ModifyNominationButtonLoc)
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(1500)
  await page.fill(manageNominations_NameFilterFieldLoc, sheroName)
  await page.keyboard.press('Enter')
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(1500)
  expect(await page.isHidden(sheroLocator)).toBe(true)
  // Check for 'Other' in grid
  await page.reload();
  await page.waitForLoadState('networkidle');
  var otherLocator = "//td[contains(text(), '" + otherName + "')]"
  await page.fill(manageNominations_NameFilterFieldLoc, otherName)
  await page.keyboard.press('Enter')
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(1500)
  expect(await page.isVisible(otherLocator)).toBe(true)
  // Modify: Other -> Hero
  await page.click(manageNominations_ModifyButtonLoc)
  await page.click(modifyNomination_HeroCatergoryLoc)
  await page.fill(modifyNomination_NameFieldLoc, heroName)
  await page.fill(modifyNomination_DescriptionFieldLoc, heroDescription)
  await page.click(modifyNomination_ModifyNominationButtonLoc)
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(1500)
  await page.fill(manageNominations_NameFilterFieldLoc, otherName)
  await page.keyboard.press('Enter')
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(1500)
  expect(await page.isHidden(otherLocator)).toBe(true)
  // Check for 'Hero' in grid
  await page.reload();
  await page.waitForLoadState('networkidle');
  await page.fill(manageNominations_NameFilterFieldLoc, heroName)
  await page.keyboard.press('Enter')
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(1500)
  expect(await page.isVisible(heroLocator)).toBe(true)
});

test('Check admin user can display nominations', async ({ page }) => {
  // Create random names and descriptions for nominations
  const heroName = "HERO_NAME_" + generateRandomString_AllChars(6)
  const heroDescription = "HERO_DESCRIPTION_" + generateRandomString_AllChars(8)
  const heroCategory = "Hero"
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
  // Construct locators and check for visibility before and after modification
  var heroLocator = "//td[contains(text(), '" + heroName + "')]"
  await page.fill(manageNominations_NameFilterFieldLoc, heroName)
  await page.keyboard.press('Enter');
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(1000)
  expect(await page.isVisible(heroLocator)).toBe(true)
  // Click 'Display' button
  await page.click(manageNominations_DisplayButtonLoc)
  await page.waitForLoadState('networkidle')
  await page.waitForTimeout(1000)
  var titleLoc = displayNomination_TitleLoc.replace("{0}", heroName)
  var descriptionLoc = displayNomination_FieldsLoc.replace("{0}", heroDescription)
  var categoryLoc = displayNomination_FieldsLoc.replace("{0}", heroCategory)
  var nominatorLoc = displayNomination_FieldsLoc.replace("{0}", predefinedAdminLogin)
  expect(await page.isVisible(titleLoc)).toBe(true)
  expect(await page.isVisible(descriptionLoc)).toBe(true)
  expect(await page.isVisible(categoryLoc)).toBe(true)
  expect(await page.isVisible(nominatorLoc)).toBe(true)
});
