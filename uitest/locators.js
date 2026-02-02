const Locators = {

    // Menu buttons
    homeLoc: '//a[@title="SILC Project ABCD"]',
    dressesLoc: '//a[@class="nav-link"][contains(text(), "Dresses")]',
    artistLoc: '//a[@class="nav-link"][contains(text(), "Artist")]',
    nominationLoc: '//a[@class="nav-link"][contains(text(), "Nomination")]',
    blogLoc: '//a[@class="nav-link"][contains(text(), "Blog")]',
    aboutLoc: '//a[@class="nav-link"][contains(text(), "About")]',
    helpLoc: '//a[@class="nav-link"][contains(text(), "Help")]',
    shopLoc: '//a[@class="nav-link"][contains(text(), "Shop")]',
    loginLoc: '//a[@class="nav-link"][contains(text(), "Login")]',
    logoutLoc: '//a[@class="nav-link"][contains(text(), "Logout")]',
    adminLoc: '//a[@class="nav-link"][contains(text(), "Admin")]',
  
    // Page title locators
    homePageTitleLoc: '//title[contains(text(), "ABCD")]//parent::body',
    dressesPageTitleLoc: '//h2[@id="title"][contains(text(), "Dresses List")]',
    artistPageTitleLoc: '//h2[@class="artistTitle"]',
    nominationPageTitleLoc: '//h2[@id="title"][contains(text(), "Create Your Nomination!")]',
    aboutPageTitleLoc: '//h2[@id="aboutTitle"]',
    helpPageTitleLoc: '//title[contains(text(), "ProjectABCD > Help")]//parent::body',
    shopPageTitleLoc: '//div[@class="shopTitleContainer"]',
    loginPageTitleLoc: '//title[contains(text(), "Register/Login Form")]//parent::body',
    adminPageTitleLoc: '//h2[@id="title"][contains(text(), "Admin")]',
    manageNominationsTitleLoc: '//h2[@id="title"][contains(text(), "Manage Nominations")]',
  
    // 'Login' page locators
    welcomeBackTitleLoc: '//*[@id="welcomeText"]',
    loginEmailAddressLabelLoc: '//form[@action="loginForm.php"]//label[contains(text(), "Email Address")]',
    loginEmailFieldLoc: '//form[@action="loginForm.php"]//input[@type="email"]',
    recoverEmailFieldLoc: '//form[@action="confirmEmail.php"]//input[@type="email"]',
    recoverEmailFormLoc: '//form[@action="confirmEmail.php"]',
    loginPasswordLabelLoc: '//form[@action="loginForm.php"]//label[contains(text(), "Password")]', 
    loginPasswordFieldLoc: '//form[@action="loginForm.php"]//input[@type="password"]',
    loginButtonLoc: '//button[@name="login"]',
    forgotPasswordButtonLoc: '//a[@href="confirmEmail.php"]',
    registerAsNewUserTitleLoc: '//*[@id="newUser"]',
    firstNameLabelLoc: '//*[@id="register"]//label[contains(text(), "First Name")]',
    firstNameFieldLoc: '//*[@id="register"]//input[@name="first_name"]',
    lastNameLabelLoc: '//*[@id="register"]//label[contains(text(), "Last Name")]',
    lastNameFieldLoc: '//*[@id="register"]//input[@name="last_name"]',
    registerEmailAddressLabelLoc: '//*[@id="register"]//label[contains(text(), "Email Address")]',
    registerEmailAddressFieldLoc: '//*[@id="register"]//input[@name="email"]',
    registerPasswordLabelLoc: '//*[@id="register"]//label[contains(text(), "Set A Password")]',
    registerPasswordFieldLoc: '//*[@id="register"]//input[@name="password"]',
    registerButtonLoc: '//button[@name="register"]',
    resetPasswordButtonLoc: '//button[@name="RESET"]',

    // 'Nomination' page locators
    nominationTypeLoc_Hero: '//form//input[@value="Hero"]',
    nominationTypeLoc_Shero: '//form//input[@value="Shero"]',
    nominationTypeLoc_Other: '//form//input[@value="Other"]',
    nominationNameFieldLoc: '//form//input[@name="name"]',
    nominationDescriptionFieldLoc: '//form//textarea[@name="description"]',
    nominationEmailFieldLoc: '//input[@id="email"]',
    nominationSubmitButtonLoc: '//button[@name="submit"]',

    // 'Blog' page locators
    blogPageTitleLoc: '//title[contains(text(), "Project ABCD2 Blog")]//following-sibling::header//descendant::span[contains(text(), "Blog")]',

    // 'Manage Nominations' page locators
    manageNominations_NameFilterFieldLoc: '//input[@placeholder="Search Name"]',
    manageNominations_DescriptionFilterFieldLoc: '//input[@placeholder="Search Description"]',
    manageNominations_CategoryFilterFieldLoc: '//input[@placeholder="Search Category"]',
    manageNominations_DeleteButtonLoc: '//a[contains(text(), "Delete")]',
    deleteNominations_DeleteButtonLoc: '//button[@type="submit"][contains(text(), "Delete")]',
    manageNominations_ModifyButtonLoc: '//a[contains(text(), "Modify")]',
    manageNominations_DisplayButtonLoc: '//a[contains(text(), "Display")]',

    // 'Modify Nominations' page locators
    modifyNomination_HeroCatergoryLoc: '//input[@id="Hero"]',
    modifyNomination_SheroCatergoryLoc: '//input[@id="Shero"]',
    modifyNomination_OtherCatergoryLoc: '//input[@id="Other"]',
    modifyNomination_NameFieldLoc: '//label[@for="name"]//following-sibling::input',
    modifyNomination_DescriptionFieldLoc: '//label[@for="description"]//following-sibling::textarea',
    modifyNomination_ModifyNominationButtonLoc: '//button[@name="update_nomination"]',

    // 'Display Nomination' page
    displayNomination_TitleLoc: '//h2[contains(text(), "{0}")]',
    displayNomination_FieldsLoc: '//p[contains(text(), "{0}")]',
  };
  
  export { Locators };
  