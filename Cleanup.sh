 #!/bin/sh

# Change to the script directory
pushd "$(dirname "$0")"

# Delete all dangerous directories and files
sudo rm -rf .git/
sudo rm -rf sql/
sudo rm -rf tests/
sudo rm -rf coverage/
sudo rm composer.phar
sudo rm index_tests.php
sudo rm index_documentation.php
sudo rm phpunit.xml

# Delete the script itself
sudo rm Cleanup.sh

# Change back
popd
