Feature: install
  In order to manage my my repository based system
  As a software developer
  I need to be able to install flyrepo 

  Scenario: install
    Given I am in the direcotry "webroot"
    When I run "curl https://raw.githubusercontent.com/cabservicesag/flyrepo/master/install.php|php"
    Then I should get:
      """
      successfully installed flyrepo
      """