---
name: Lex Obsidian
colors:
  surface: '#131313'
  surface-dim: '#131313'
  surface-bright: '#393939'
  surface-container-lowest: '#0e0e0e'
  surface-container-low: '#1b1b1b'
  surface-container: '#1f1f1f'
  surface-container-high: '#2a2a2a'
  surface-container-highest: '#353535'
  on-surface: '#e2e2e2'
  on-surface-variant: '#c1c6d5'
  inverse-surface: '#e2e2e2'
  inverse-on-surface: '#303030'
  outline: '#8b919e'
  outline-variant: '#414753'
  surface-tint: '#a7c8ff'
  primary: '#a7c8ff'
  on-primary: '#003060'
  primary-container: '#0074d9'
  on-primary-container: '#fdfbff'
  inverse-primary: '#005eb2'
  secondary: '#afc8f0'
  on-secondary: '#163152'
  secondary-container: '#2f486a'
  on-secondary-container: '#9eb7de'
  tertiary: '#a7d628'
  on-tertiary: '#263500'
  tertiary-container: '#5f7f00'
  on-tertiary-container: '#fbffe7'
  error: '#ffb4ab'
  on-error: '#690005'
  error-container: '#93000a'
  on-error-container: '#ffdad6'
  primary-fixed: '#d5e3ff'
  primary-fixed-dim: '#a7c8ff'
  on-primary-fixed: '#001b3b'
  on-primary-fixed-variant: '#004788'
  secondary-fixed: '#d4e3ff'
  secondary-fixed-dim: '#afc8f0'
  on-secondary-fixed: '#001c3a'
  on-secondary-fixed-variant: '#2f486a'
  tertiary-fixed: '#c2f446'
  tertiary-fixed-dim: '#a7d628'
  on-tertiary-fixed: '#151f00'
  on-tertiary-fixed-variant: '#394d00'
  background: '#131313'
  on-background: '#e2e2e2'
  surface-variant: '#353535'
  surface-charcoal: '#0A0A0A'
  border-subtle: '#1A1A1A'
  text-muted: '#8E8E8E'
  legal-green: '#007861'
typography:
  display-lg:
    fontFamily: Inter
    fontSize: 48px
    fontWeight: '700'
    lineHeight: 56px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Inter
    fontSize: 32px
    fontWeight: '600'
    lineHeight: 40px
    letterSpacing: -0.01em
  headline-lg-mobile:
    fontFamily: Inter
    fontSize: 28px
    fontWeight: '600'
    lineHeight: 36px
  headline-md:
    fontFamily: Inter
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
  body-lg:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  label-md:
    fontFamily: JetBrains Mono
    fontSize: 14px
    fontWeight: '500'
    lineHeight: 20px
    letterSpacing: 0.05em
  label-sm:
    fontFamily: JetBrains Mono
    fontSize: 12px
    fontWeight: '500'
    lineHeight: 16px
    letterSpacing: 0.05em
rounded:
  sm: 0.125rem
  DEFAULT: 0.25rem
  md: 0.375rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px
spacing:
  unit: 8px
  container-max: 1280px
  gutter: 24px
  margin-desktop: 64px
  margin-tablet: 32px
  margin-mobile: 16px
---

## Brand & Style

This design system is engineered for a high-stakes legal AI environment where precision, authority, and modern intelligence are paramount. The aesthetic is "Technological Noir"—a blend of **Minimalism** and **High-Contrast** styles that prioritizes readability and focus. 

The brand personality is stoic and expert, evoking the feeling of a high-end digital vault. By utilizing a deep, dark canvas with sharp electric accents, the UI creates a "head-up display" (HUD) effect that makes AI-generated insights feel like definitive, real-time intelligence. The visual language balances the traditional gravitas of law with the cutting-edge speed of artificial intelligence, ensuring users feel both secure and technologically empowered.

## Colors

The palette is anchored in **Deep Black (#000000)** to provide maximum contrast and a premium "OLED" feel. **Midnight Blue (#001F3F)** serves as the primary surface color for containers and cards, creating depth without breaking the dark atmosphere.

**Electric Blue (#0074D9)** is reserved strictly for primary actions, progress indicators, and active states. It should be used sparingly to maintain its impact. A nod to the reference material is included via **B9EA3D (Lime)**, which is used as a high-visibility utility color for "Verified" statuses or AI confidence scores. **Legal Green (#007861)** is utilized for success states and finalized document statuses, grounding the tech-forward palette in traditional legal color associations.

## Typography

The system uses **Inter** for all primary communication to ensure maximum legibility and a neutral, professional tone. Headings use tight letter spacing and bold weights to command attention. 

To reinforce the "AI/Tech" narrative, **JetBrains Mono** is introduced for labels, metadata, and status tags. This monospaced font suggests data precision and systemic processing, perfect for case numbers, timestamps, and document citations. 

Across all levels, line heights are generous to prevent visual fatigue during long periods of legal research or document review. On mobile devices, display and headline sizes scale down to maintain a balanced hierarchy.

## Layout & Spacing

The layout follows a **Fixed Grid** model on desktop to keep legal documents and AI sidebars contained and readable. We utilize a 12-column system with a 24px gutter. 

The rhythm is strictly based on an **8px base unit**. All padding and margins should be multiples of 8 (8, 16, 24, 32, 48, 64). 

- **Desktop:** Side-panel navigation is fixed at 280px. Main content area centers within a 1280px container.
- **Tablet:** The layout transitions to an 8-column grid. Margins reduce to 32px. Sidebars collapse into a drawer.
- **Mobile:** A 4-column fluid grid. Primary focus is on single-column document viewing with floating action buttons for AI prompts.

## Elevation & Depth

In a pure black environment, traditional shadows are ineffective. Instead, this design system uses **Tonal Layers** and **Subtle Outlines** to define hierarchy:

1.  **Level 0 (Floor):** Pure Black (#000000) for the primary background.
2.  **Level 1 (Cards/Sections):** Midnight Blue (#001F3F) or Surface Charcoal (#0A0A0A) with a 1px border (#1A1A1A).
3.  **Level 2 (Modals/Popovers):** Surface Charcoal with a slightly brighter border (#333333) and a very subtle 20% opacity blue glow (inner-shadow) to suggest the element is "active" or "powered."

**Backdrop Blurs:** When modals are present, the background uses a heavy blur (20px) to maintain focus on the legal text while keeping the environment cohesive.

## Shapes

The shape language is **Soft (0.25rem)**. This "subtle rounding" provides a premium, modern feel without sacrificing the authoritative "sharpness" required for a legal platform. 

- **Buttons & Inputs:** Use the standard 0.25rem (4px) radius.
- **Large Containers/Cards:** Use 0.5rem (8px) for a slightly more approachable feel on large surfaces.
- **Search Bars:** These are the only exception, utilizing a **Pill-shape** to distinguish the "AI Input" as a unique, dynamic element.

## Components

### Buttons
- **Primary:** Electric Blue background, white text. No shadow, 1px inset border for a crisp edge.
- **Secondary:** Transparent background, 1px border in Electric Blue.
- **Ghost:** No background, Electric Blue text, used for low-priority legal citations.

### Input Fields
- Dark backgrounds (#0A0A0A) with 1px borders (#1A1A1A). On focus, the border glows Electric Blue. Labels always use JetBrains Mono for a "data-entry" feel.

### Cards
- Midnight Blue surfaces. They do not use shadows; instead, they are separated by 1px borders. AI-generated cards feature a subtle gradient top-border (Electric Blue to Midnight Blue).

### AI Status Chips
- Small, monospaced labels. Use the **Lime (#B9EA3D)** for "Success/Confidence" and **Electric Blue** for "Processing."

### Legal Document Viewer
- Use high-contrast white text (#FFFFFF) on the dark background for the document body. Use the secondary color for the "page" container to differentiate the document from the UI workspace.