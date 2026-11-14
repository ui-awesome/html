# AI assistance

The canonical package skill is [ui-awesome-html](../skills/ui-awesome-html/SKILL.md). It covers typed HTML element composition. The checkout's
`.agents/skills/` and `.claude/skills/` links point to that single source; no client-specific copies are maintained.

## Install in an application

Require a `ui-awesome/html` release that contains this skill, then use the
[one-time Composer setup](https://yii2-framework.github.io/docs/project/ai-agents/#composer-installation)
for `llm/skills`, explicitly trust `ui-awesome/html`, and configure auto-sync before expecting dependency updates to
synchronize skills. Composer metadata alone does not install a synchronizer or activate a skill. Inspect the installed
plugin version, permitted donor and synchronization result.

```bash
composer install
composer skills:show
```

With manual synchronization configured, run `composer skills:update`. These commands assume the application setup is
already authorized and complete. Installing a package under `vendor/` alone does not expose a skill at the application root.

### Optional npx installation

For optional project-scoped installation, list the local source first:

```bash
npx skills@1.7.2 add /absolute/path/to/html --list
npx skills@1.7.2 add /absolute/path/to/html --skill ui-awesome-html --agent claude-code codex opencode
```

Use an installed `vendor/ui-awesome/html` source only if that release contains this skill. A copied skill must be
refreshed on upgrades. Local changes do not prove availability from a published GitHub or Composer release.

## Discovery and activation

Open a fresh session at the project root. Codex uses `.agents/skills/ui-awesome-html/` and explicit `$ui-awesome-html`;
Claude Code uses `.claude/skills/ui-awesome-html/` and `/ui-awesome-html`. OpenCode can load the named skill through its native skill tool.
Verify the installed client's actual discovery paths and avoid duplicate/global same-name fallbacks. Installer `--list`
checks source discovery, not native activation. Capture a real load event and execute the task before calling it tested.

## Example prompts

Explicit Codex invocation (adapt the first line to the other client's native mechanism):

```text
$ui-awesome-html
Build an immutable Div containing encoded user text and a trusted child link. Assert exact markup and show that the base element remains unchanged.
Use the installed source, show executable checks, and do not install dependencies or alter unrelated code.
```

Natural selection, without naming the skill:

```text
How do I compose an HTML document and form controls with ui-awesome/html without treating html() as a sanitizer?
Include a runnable normal case, a boundary case and a deliberate invalid-input or unsupported-capability case.
```

Expected verification: inspect the referenced source contracts, execute the generated PHP with independent assertions,
and record exact output or exceptions. Check state isolation and encoding where applicable. A correct answer without a
native load trace is not evidence of native activation. In a separate unrelated task, ensure this skill is not forced
into scope; do not change the real checkout to run a negative control.

## Verification limits

Run this package's configured checks and the consuming application's relevant integration tests. Mark PHP versions,
client activation, browser behavior and published artifacts separately when not exercised. Keep raw model evaluations,
fixtures and provider traces in ignored maintainer storage, not the distributable skill. The examples above are prompts,
not a claim that a particular provider has executed them.

[Back to documentation](../README.md#documentation)
