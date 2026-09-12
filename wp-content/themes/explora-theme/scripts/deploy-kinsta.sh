#!/usr/bin/env bash
# Deploy committed theme files to the dedicated Kinsta test site only.
set -euo pipefail
repo_root=$(git -C "$(dirname "$0")" rev-parse --show-toplevel)
cd "$repo_root"
if [[ -n "$(git status --porcelain)" ]]; then
  echo 'Commit or stash local changes before deploying.' >&2
  exit 1
fi
git fetch origin main
if [[ "$(git rev-parse HEAD)" != "$(git rev-parse origin/main)" ]]; then
  echo 'Local HEAD must match origin/main before deploying.' >&2
  exit 1
fi
bundle_file=$(mktemp -t mdbr-deploy)
trap 'rm -f "$bundle_file"' EXIT
git bundle create "$bundle_file" HEAD
scp -P 25365 "$bundle_file" museibambiniroma@79.72.45.240:/www/museibambiniroma_564/private/mdbr-deploy.bundle
ssh -o BatchMode=yes -p 25365 museibambiniroma@79.72.45.240 'bash -s' <<'REMOTE'
set -euo pipefail
cd /www/museibambiniroma_564/public
export GIT_DIR=/www/museibambiniroma_564/private/mdbr.git
export GIT_WORK_TREE=/www/museibambiniroma_564/public
if [[ -n "$(git status --porcelain)" ]]; then
  echo 'Remote theme has local changes; deployment stopped.' >&2
  exit 1
fi
git fetch /www/museibambiniroma_564/private/mdbr-deploy.bundle HEAD
git merge --ff-only FETCH_HEAD
wp acorn view:clear
wp cache flush
if wp cli has-command kinsta cache purge --quiet; then wp kinsta cache purge; fi
REMOTE
