#!/bin/bash

./bin/run-tests-before.sh
phpunit --coverage-html target/test-coverage
