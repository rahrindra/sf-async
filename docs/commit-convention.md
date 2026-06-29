## Commit Convention

This project follows the **Conventional Commits** specification.

| Type | Description | Example                                     |
|------|-------------|---------------------------------------------|
| `feat` | Introduce a new feature | `feat: add JWT authentication`              |
| `fix` | Fix a bug | `fix: handle invalid JSON payload`          |
| `docs` | Documentation changes only | `docs: add Docker installation guide`       |
| `style` | Code style changes (formatting, whitespace, etc.) | `style: format PHP files with PHP-CS-Fixer` |
| `refacto` | Code refactoring without changing behavior | `refactor: simplify user repository`        |
| `perf` | Improve performance | `perf: optimize Elasticsearch queries`      |
| `test` | Add or update tests | `test: add functional tests for login`      |
| `build` | Build system or external dependencies (Docker, Makefile, etc.) | `build: update PHP Docker image to 8.4`     |
| `ci` | Continuous Integration / Continuous Deployment changes | `ci: add PHPStan workflow`                  |
| `chore` | General maintenance tasks | `chore: clean temporary files`              |
| `deps` | Add or update dependencies | `deps: Add orm-pack`                        |
| `revert` | Revert a previous commit | `revert: revert JWT authentication`         |
