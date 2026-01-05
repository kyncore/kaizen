parameters:
  # List of package directories inside your monorepo
  packages:
    - packages/core
    - packages/survey
    - packages/aws_agent

  # Mapping from package directory → split repository
  directories_to_repositories:
    packages/core: git@github.com:kyncore/kaizen-core.git
    packages/survey: git@github.com:kyncore/kaizen-survey.git
    packages/aws_agent: git@github.com:kyncore/kaizen-aws-agent.git

  # Optional: vendor prefix (used for merged composer.json)
  vendor: kaizen
  merged_composer_json_file: composer.json
