#!/usr/bin/env bash

set -euo pipefail

# Check if a symfony project already exist
if [[ -f composer.json ]]; then
    echo "A Symfony project already exists."
    exit 0
fi

PROJECT_DIR="temp"

echo "==> Creating Symfony project..."

composer create-project symfony/skeleton:"8.1.*" "${PROJECT_DIR}"

echo "==> Moving project to repository root..."

# Move all files (include hidden files)
shopt -s dotglob

mv "${PROJECT_DIR}"/* .

shopt -u dotglob

echo "==> Removing temporary directory..."

rmdir "${PROJECT_DIR}"

echo "==> Symfony project successfully installed."
