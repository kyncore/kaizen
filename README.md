# kaizen
vendor/bin/monorepo-builder merge
composer install


## BK
composer install
composer run-script test
composer run-script analyse
composer run-script cs-check




   vendor/bin/phpunit --testsuite "Kaizen DynamoWorker             │
 │   Tests"





# Make sure you're logged in via gh CLI
gh auth login

# Create public repos for each package
gh repo create kyncore/kaizen-core --public --description "Kaizen Core package" --confirm
gh repo create kyncore/kaizen-survey --public --description "Kaizen Survey package" --confirm
gh repo create kyncore/kaizen-aws-agent --public --description "Kaizen AWS Agent package" --confirm
