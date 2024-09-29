# PHPUnit Workshop TYPO3Camp 2024

## Welcome!

### Welcome to the PHPUnit Workshop at the TYPO3Camp 2024 in Vienna!

To attend in developing PHPUnit tests for the given examples during the
workshop you are kindly asked to install the actual repository to your local
development environment. Any other setup or environment than PhpStorm, DDEV and
macOS is highly welcome, but please be advised that support can only be
given for macOS and the following requirements.

## Requirements

Please ensure that your machine meets the following requirements:

* A Docker provider
    * Please install one of the following Docker provider. The (free
      version) of Orbstack is recommended.
        * [Orbstack](https://ddev.readthedocs.io/en/stable/users/install/docker-installation/#orbstack)
        * [Docker Desktop](https://ddev.readthedocs.io/en/stable/users/install/docker-installation/#docker-desktop-for-mac)
        * [Colima](https://ddev.readthedocs.io/en/stable/users/install/docker-installation/#colima)
        * [Lima](https://ddev.readthedocs.io/en/stable/users/install/docker-installation/#lima)
        * [Rancher Desktop](https://ddev.readthedocs.io/en/stable/users/install/docker-installation/#rancher-desktop)
* DDEV
    * This repository and the installation of TYPO3 relies on the Docker-based
      PHP development environment
      [DDEV](https://ddev.com/). Though the repository can also be used by
      configuring Docker manually, it is strongly recommended to use DDEV, to
      leverage all functionality PhpStorm or Visual Code provides. During the
      workshop you will be guided through the configuration of DDEV within
      PhpStorm.
* DDEV plugin
    * There is a
      [DDEV plugin for PhpStorm](https://plugins.jetbrains.com/plugin/18813-ddev-integration)
      as well as for
      [Visual Studio Code](https://marketplace.visualstudio.com/items?itemName=biati.ddev-manager)
      available, which is strongly advised to be installed.

## Setup

Please follow these steps to install the repository, respectively TYPO3, to
your local machine:

* Clone the repository to a folder your Docker provider has access to:
  `git clone git@github.com:helmutstrasser/phpunit-workshop-pb.git`
* Switch into the project root: `cd phpunit-workshop-pb`
* Start your Docker provider (Docker Desktop/Colima/Orbstack...)
* Start DDEV: `ddev start`
* Install TYPO3 and all package dependencies: `ddev composer install`

For the workshop we neither need a running TYPO3 backend, nor a frontend,
nor a functional database. No site configuration is provided or necessary.
During the workshop we will never open the project in a browser.

Though, just in case you want to check whether the installation succeeded, you
can fire up the backend by running through the setup wizard:

* Add a `FIRST_INSTALL` file to the `public` folder
* Open the project in a browser:
  https://phpunit-workshop.ddev.site/typo3/install.php
* Run through the steps and add an administrative user
* Open the backend after finishing the setup wizard

Please be advised that any code located in the theme extension
(`packages/theme`) is NOT supposed to make any sense being called from the
website. All classes are standalone examples we will develop tests for during
this workshop.

## Support

I will do everything in my power to support you at solving problems with
your installation. To save precious time during the workshop I warmly
welcome you to make contact with me beforehand via the following options (in
English or German):

* [TYPO3 Slack](https://typo3.slack.com/team/UHQN5PJRY)
* [Mastodon](https://mstdn.social/@helmutstrasser)
* [Email](mailto:h.strasser@supseven.at)

## License

[GPL-2.0 or later](https://spdx.org/licenses/GPL-2.0-or-later.html)
