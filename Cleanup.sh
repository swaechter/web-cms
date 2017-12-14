 #!/bin/sh

# Change to the script directory
pushd "$(dirname "$0")"

# Delete all dangerous directories and files
sudo rm -rf .git/
sudo rm -rf sql/
sudo rm -rf tests/
sudo rm -rf coverage/
sudo rm -f .gitignore
sudo rm -f README.md
sudo rm -f composer.json
sudo rm -f composer.phar
sudo rm -f index_tests.php
sudo rm -f index_documentation.php
sudo rm -f phpunit.xml

# Delete the script itself
sudo rm Cleanup.sh

# Change back
popd
