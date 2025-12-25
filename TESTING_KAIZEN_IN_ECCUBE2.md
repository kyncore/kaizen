# Testing Kaizen Packages in EC-CUBE 2 Projects

This document outlines the best practices for testing features developed within the `kaizen` monorepo packages directly within an EC-CUBE 2 project, focusing on observational testing rather than unit/integration test cases.

The `Eccube2Bridge` class (`Kaizen\Core\Bootstrap\Eccube2Bridge`) is primarily designed for bootstrapping an EC-CUBE 2 environment programmatically, useful for internal `kaizen` tests or CLI tools. For observing features in a running EC-CUBE 2 application, a different integration approach is required.

## 1. Integrating Kaizen Packages into EC-CUBE 2 (Recommended for Development)

The most effective way to integrate your `kaizen` packages for development and observational testing is by using Composer's path repositories with symlinking. This allows for live changes in your `kaizen` monorepo to be immediately reflected in the `eccube2` project.

### Steps:

1.  **Modify `eccube2/composer.json`:**
    Add a `repositories` entry to your `eccube2` project's `composer.json` file. This tells Composer to look for packages locally within your `kaizen/packages` directory.

    ```json
    // eccube2/composer.json
    {
        "name": "ec-cube/ec-cube",
        "description": "EC-CUBE 2.13",
        // ...
        "repositories": [
            {
                "type": "path",
                "url": "../kaizen/packages/*", // Adjust this path if your eccube2 project is not directly next to the kaizen monorepo
                "options": {
                    "symlink": true
                }
            }
        ],
        "require": {
            // ... existing requirements
            "kaizen/aws_agent": "@dev", // Example: Require your kaizen packages
            "kaizen/core": "@dev",
            "kaizen/survey": "@dev"
        },
        // ...
    }
    ```
    The `"symlink": true` option is crucial. It creates symbolic links from `eccube2/vendor/kaizen/<package-name>` back to `kaizen/packages/<package-name>`, ensuring that any code changes in your monorepo are instantly available in the EC-CUBE 2 project.

2.  **Run `composer update` in `eccube2`:**
    Navigate to your `eccube2` project directory and execute:

    ```bash
    cd /Users/kyawyenaing/EcCube/kaizen/ec-cube2 # Or your actual eccube2 path
    composer update
    ```
    This command will create the necessary symlinks in `eccube2/vendor/`.

3.  **Integrate and Observe:**
    Your `kaizen` package classes will now be autoloaded within the `eccube2` project. You can call `kaizen` classes/functions from your EC-CUBE 2 code (e.g., within custom modules, `SC_Helper` classes, or Smarty templates) and observe the results in the running EC-CUBE 2 application.

## 2. EC-CUBE 2 Plugin Integration (for `kaizen` packages designed as EC-CUBE 2 plugins)

For `kaizen` packages that are specifically designed as EC-CUBE 2 plugins (e.g., `packages/survey` with its `install.php` and `src/data` structure), additional steps are needed *after* Composer integration for EC-CUBE 2 to recognize and load them as plugins.

1.  **Create a Symlink for the Plugin:**
    EC-CUBE 2 expects plugins to reside in `data/downloads/plugin`. After Composer has created the symlink in `vendor`, you need to create another symlink from there to the plugin directory.

    ```bash
    # From your eccube2 project root:
    ln -s ../vendor/kaizen/survey data/downloads/plugin/Survey
    ```
    *(Note: The exact plugin directory name, e.g., `Survey`, might need to match an internal identifier within your `survey` package's `install.php` or other plugin metadata.)*

2.  **Install the Plugin via EC-CUBE 2 Admin:**
    Log into the EC-CUBE 2 administration panel. Navigate to the plugin management section (typically under "オーナーズストア" or "設定"). You should see your "Survey" plugin listed. Click to install it. This will execute your `packages/survey/install.php` script, performing any necessary setup (database changes, file copies, etc.).

3.  **Observe Functionality:**
    After installation, you can interact with the relevant parts of your EC-CUBE 2 storefront or admin panel to observe the features provided by your `survey` package.

## 3. Debugging and Logging

To effectively observe and troubleshoot your features:

*   **EC-CUBE 2 Logging:** Utilize EC-CUBE 2's logging mechanisms. Your `kaizen` packages should write relevant information to EC-CUBE 2's log files (e.g., `data/logs/site.log`) using utilities like `SC_Utils_Ex::sfWriteLog()`.
*   **Xdebug:** Configure Xdebug in your PHP environment. This allows you to set breakpoints in your `kaizen` package code and step through execution as EC-CUBE 2 processes requests, providing deep insight into code interaction.
*   **`var_dump()` / `error_log()`:** For quick, temporary debugging, `var_dump()` or `error_log()` can be used. Remember to remove these before committing code.

## 4. Cache Clearing

EC-CUBE 2 heavily caches various components. After making code changes, especially to templates, configurations, or class definitions, you must clear the cache to see your updates.

*   **Via Admin Panel:** The safest method is to clear the cache through the EC-CUBE 2 administration panel (e.g., "システム設定" -> "キャッシュ管理").
*   **Manually Deleting Cache Files:** You can manually delete the contents of the `data/cache` directory:
    ```bash
    # From your eccube2 project root:
    rm -rf data/cache/*
    ```

## 5. Frontend Assets (CSS/JavaScript)

If your `kaizen` packages introduce frontend assets:

*   **Plugin Integration:** For plugins, the `install.php` or other plugin files are typically responsible for copying assets to a publicly accessible location within the EC-CUBE 2 `html` directory (e.g., `html/user_data/packages/survey/css/style.css`).
*   **Smarty Templates:** Ensure your EC-CUBE 2 Smarty templates correctly link to these assets using paths relative to the `html` directory:
    ```html
    <link rel="stylesheet" href="<!--{$smarty.const.ROOT_URL}-->user_data/packages/survey/css/style.css">
    <script src="<!--{$smarty.const.ROOT_URL}-->user_data/packages/survey/js/script.js"></script>
    ```
*   **Asset Compilation:** If your `kaizen` packages use frontend build tools, ensure these processes are run and output files are placed where EC-CUBE 2 can serve them.

## 6. Version Control and `composer.json` Management

When using path repositories for development:

*   **`eccube2/composer.json`:** Decide whether to commit the `repositories` and `require` entries for your `kaizen` packages. This depends on your team's development workflow.
*   **`.gitignore`:** Ensure `eccube2/vendor/` and any symlinks created in `eccube2/data/downloads/plugin/` are added to `eccube2/.gitignore` to prevent committing local development artifacts.

By following these guidelines, you can establish an efficient and robust workflow for developing and testing your `kaizen` monorepo packages within a live EC-CUBE 2 environment.



docker exec -it -w / 1b63ae6ad44f /bin/sh


docker exec -it -w /var 1b63ae6ad44f /bin/sh


docker exec -it 1b63ae6ad44f composer dump-autoload


docker exec -it -w /var/www 1b63ae6ad44f /bin/sh

docker exec -it -w /var/www/app 1b63ae6ad44f composer dump-autoload -o

