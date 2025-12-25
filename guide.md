# How to Use Packages in a Consumer Project

This guide explains how to use the packages from this monorepo in a consumer project.

## Using a Specific Package

To use a specific package, you need to add it to your `composer.json` file and specify the version.

1.  **Add the package to your `composer.json` file.**

    For example, to use the `kaizen/aws_agent` package, add the following to your `composer.json` file:

    ```json
    {
        "require": {
            "kaizen/aws_agent": "dev-main"
        }
    }
    ```

2.  **Add the repository to your `composer.json` file.**

    You also need to add the repository to your `composer.json` file so that Composer knows where to find the package.

    ```json
    {
        "repositories": [
            {
                "type": "vcs",
                "url": "https://github.com/your-organization/kaizen"
            }
        ]
    }
    ```

3.  **Run `composer update`.**

    Finally, run `composer update` to install the package.

    ```bash
    composer update
    ```

## Using All Packages

To use all the packages, you can use a wildcard in your `composer.json` file.

1.  **Add the packages to your `composer.json` file.**

    ```json
    {
        "require": {
            "kaizen/*": "dev-main"
        }
    }
    ```

2.  **Add the repository to your `composer.json` file.**

    ```json
    {
        "repositories": [
            {
                "type": "vcs",
                "url": "https://github.com/your-organization/kaizen"
            }
        ]
    }
    ```

3.  **Run `composer update`.**

    ```bash
    composer update
    ```
