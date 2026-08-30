---
name: design-system-433-football
description: Creates implementation-ready design-system guidance with tokens, component behavior, and accessibility standards. Use when creating or updating UI rules, component specifications, or design-system documentation.
---

<!-- TYPEUI_SH_MANAGED_START -->

# 433 Football

## Mission
Deliver implementation-ready design-system guidance for 433 Football that can be applied consistently across dashboard web app interfaces.

## Brand
- Product/brand: 433 Football
- URL: https://www.433football.com/
- Audience: authenticated users and operators
- Product surface: dashboard web app

## Style Foundations
- Visual style: structured, accessible, implementation-first
- Main font style: `font.family.primary=sans-serif`, `font.family.stack=sans-serif`, `font.size.base=12px`, `font.weight.base=400`, `font.lineHeight.base=normal`
- Typography scale: `font.size.xs=12px`, `font.size.sm=14px`, `font.size.md=16px`, `font.size.lg=18px`, `font.size.xl=32px`, `font.size.2xl=44px`, `font.size.3xl=52px`, `font.size.4xl=72px`
- Color palette: `color.surface.base=#000000`, `color.text.secondary=#666666`, `color.text.tertiary=#cccccc`, `color.text.inverse=#0000ee`, `color.surface.muted=#333333`, `color.surface.raised=#191919`, `color.surface.strong=#f1ff00`
- Spacing scale: `space.1=15px`, `space.2=16px`, `space.3=32px`, `space.4=50px`, `space.5=80px`, `space.6=100px`
- Radius/shadow/motion tokens: `radius.xs=16px`, `radius.sm=20px`, `radius.md=100px`, `radius.lg=200px` | `shadow.1=rgba(255, 255, 255, 0.1) 0px 1px 2px 0px inset`

## Accessibility
- Target: WCAG 2.2 AA
- Keyboard-first interactions required.
- Focus-visible rules required.
- Contrast constraints required.

## Writing Tone
concise, confident, implementation-focused

## Rules: Do
- Use semantic tokens, not raw hex values in component guidance.
- Every component must define required states: default, hover, focus-visible, active, disabled, loading, error.
- Responsive behavior and edge-case handling should be specified for every component family.
- Accessibility acceptance criteria must be testable in implementation.

## Rules: Don't
- Do not allow low-contrast text or hidden focus indicators.
- Do not introduce one-off spacing or typography exceptions.
- Do not use ambiguous labels or non-descriptive actions.

## Guideline Authoring Workflow
1. Restate design intent in one sentence.
2. Define foundations and tokens.
3. Define component anatomy, variants, and interactions.
4. Add accessibility acceptance criteria.
5. Add anti-patterns and migration notes.
6. End with QA checklist.

## Required Output Structure
- Context and goals
- Design tokens and foundations
- Component-level rules (anatomy, variants, states, responsive behavior)
- Accessibility requirements and testable acceptance criteria
- Content and tone standards with examples
- Anti-patterns and prohibited implementations
- QA checklist

## Component Rule Expectations
- Include keyboard, pointer, and touch behavior.
- Include spacing and typography token requirements.
- Include long-content, overflow, and empty-state handling.

## Quality Gates
- Every non-negotiable rule must use "must".
- Every recommendation should use "should".
- Every accessibility rule must be testable in implementation.
- Prefer system consistency over local visual exceptions.

<!-- TYPEUI_SH_MANAGED_END -->
