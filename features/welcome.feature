Feature: Welcome page
 Check if access is public, so everyone can access without loging 

 Scenario: access to welcome page (public)
  Given I am on "/"
  Then I should see "News"
  And I should see "Blog"

 Scenario: access to login page (public)
  Given I am on "/login"
  Then I should see "E-Mail Address"
  And I should see "Password"

 Scenario: access to register page (public)
  Given I am on "/register"
  Then I should see "Name"
  And I should see "E-Mail Address"
  And I should see "Password"
  And I should see "Confirm Password"

 Scenario: access to news page (public)
  Given I am on "/news/all"
  And I should see "Open Source News"

 Scenario: access to blog page (public)
  Given I am on "/blog/all"
  And I should see "Open Source Blog"
  