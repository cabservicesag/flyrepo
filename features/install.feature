Feature: install
  In order to manage my my repository based system
  As a software developer
  I need to be able to install flyrepo 

  Scenario: install
    Given I am in the direcotry "webroot"
    When I run "./flyrepo.phar"
    Then I should get:
      """
      successfully installed flyrepo
      """