<style>
    /* ===== AOZORA FILAMENT ENHANCED STYLING (LIGHT & DARK MODE) ===== */

    /* Logo & Branding in Sidebar */
    .anc-logo-container {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        width: 100% !important;
        min-width: 200px !important;
        max-width: 240px !important;
    }

    .anc-logo-left {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
    }

    .anc-logo-img {
        width: 38px !important;
        height: 38px !important;
        min-width: 38px !important;
        max-width: 38px !important;
        min-height: 38px !important;
        max-height: 38px !important;
        border-radius: 9999px !important;
        object-fit: cover !important;
        flex-shrink: 0 !important;
        display: block !important;
    }

    .anc-logo-img.ring-admin {
        box-shadow: 0 0 0 2px rgba(13, 89, 242, 0.25) !important;
    }
    .anc-logo-img.ring-inventaris {
        box-shadow: 0 0 0 2px rgba(15, 118, 110, 0.25) !important;
    }
    .anc-logo-img.ring-pdd {
        box-shadow: 0 0 0 2px rgba(124, 58, 237, 0.25) !important;
    }
    .anc-logo-img.ring-events {
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.3) !important;
    }
    .anc-logo-img.ring-anggota {
        box-shadow: 0 0 0 2px rgba(225, 29, 72, 0.25) !important;
    }

    .anc-logo-text-group {
        display: flex !important;
        flex-direction: column !important;
        line-height: 1.15 !important;
        align-items: flex-start !important;
    }

    .anc-logo-title-row {
        display: flex !important;
        align-items: center !important;
        gap: 6px !important;
    }

    .anc-brand-kanji {
        font-size: 1.15rem !important;
        font-weight: 800 !important;
        letter-spacing: -0.02em !important;
        color: #0f172a !important;
        transition: color 0.15s ease !important;
    }
    .dark .anc-brand-kanji {
        color: #f8fafc !important;
    }

    .anc-brand-hub {
        font-size: 0.95rem !important;
        font-weight: 800 !important;
        letter-spacing: -0.01em !important;
    }
    .text-admin { color: #0d59f2 !important; }
    .dark .text-admin { color: #60a5fa !important; }
    .text-inventaris { color: #0f766e !important; }
    .dark .text-inventaris { color: #2dd4bf !important; }
    .text-pdd { color: #7c3aed !important; }
    .dark .text-pdd { color: #c084fc !important; }
    .text-events { color: #4f46e5 !important; }
    .dark .text-events { color: #818cf8 !important; }
    .text-anggota { color: #e11d48 !important; }
    .dark .text-anggota { color: #fb7185 !important; }

    .anc-brand-sub {
        font-size: 10px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.08em !important;
        color: #64748b !important;
        margin-top: 2px !important;
    }
    .dark .anc-brand-sub {
        color: #94a3b8 !important;
    }

    .anc-badge {
        padding: 2px 7px !important;
        border-radius: 9999px !important;
        font-size: 10px !important;
        font-weight: 700 !important;
        letter-spacing: 0.05em !important;
        white-space: nowrap !important;
    }

    .badge-admin {
        background-color: #eff6ff !important;
        color: #1d4ed8 !important;
        border: 1px solid #bfdbfe !important;
    }
    .dark .badge-admin {
        background-color: rgba(30, 58, 138, 0.45) !important;
        color: #93c5fd !important;
        border: 1px solid rgba(59, 130, 246, 0.35) !important;
    }

    .badge-inventaris {
        background-color: #f0fdf4 !important;
        color: #0f766e !important;
        border: 1px solid #99f6e4 !important;
    }
    .dark .badge-inventaris {
        background-color: rgba(19, 78, 74, 0.45) !important;
        color: #5eead4 !important;
        border: 1px solid rgba(20, 184, 166, 0.35) !important;
    }

    .badge-pdd {
        background-color: #faf5ff !important;
        color: #7c3aed !important;
        border: 1px solid #e9d5ff !important;
    }
    .dark .badge-pdd {
        background-color: rgba(88, 28, 135, 0.45) !important;
        color: #d8b4fe !important;
        border: 1px solid rgba(168, 85, 247, 0.35) !important;
    }

    .badge-events {
        background-color: #eef2ff !important;
        color: #4f46e5 !important;
        border: 1px solid #c7d2fe !important;
    }
    .dark .badge-events {
        background-color: rgba(67, 56, 202, 0.45) !important;
        color: #a5b4fc !important;
        border: 1px solid rgba(99, 102, 241, 0.35) !important;
    }

    .badge-anggota {
        background-color: #fff1f2 !important;
        color: #e11d48 !important;
        border: 1px solid #fecdd3 !important;
    }
    .dark .badge-anggota {
        background-color: rgba(136, 19, 55, 0.45) !important;
        color: #fda4af !important;
        border: 1px solid rgba(244, 63, 94, 0.35) !important;
    }

    /* Topbar Quick Panel Switcher */
    .anc-topbar-wrapper {
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        margin-left: 8px !important;
    }

    .anc-panel-switcher {
        display: inline-flex !important;
        align-items: center !important;
        padding: 3px !important;
        border-radius: 10px !important;
        gap: 3px !important;
        background-color: #f1f5f9 !important;
        border: 1px solid #e2e8f0 !important;
    }
    .dark .anc-panel-switcher {
        background-color: #1e293b !important;
        border: 1px solid #334155 !important;
    }

    .anc-nav-pill {
        display: inline-flex !important;
        align-items: center !important;
        gap: 5px !important;
        padding: 4px 9px !important;
        border-radius: 7px !important;
        font-size: 11.5px !important;
        font-weight: 600 !important;
        text-decoration: none !important;
        color: #64748b !important;
        transition: all 0.15s ease !important;
        white-space: nowrap !important;
    }
    .dark .anc-nav-pill {
        color: #94a3b8 !important;
    }
    .anc-nav-pill:hover {
        color: #0f172a !important;
        background-color: rgba(255, 255, 255, 0.6) !important;
    }
    .dark .anc-nav-pill:hover {
        color: #f8fafc !important;
        background-color: rgba(51, 65, 85, 0.6) !important;
    }

    .anc-nav-pill.active-admin {
        background-color: #ffffff !important;
        color: #0d59f2 !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06) !important;
        font-weight: 700 !important;
    }
    .dark .anc-nav-pill.active-admin {
        background-color: #0f172a !important;
        color: #60a5fa !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.3) !important;
    }

    .anc-nav-pill.active-inventaris {
        background-color: #ffffff !important;
        color: #0f766e !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06) !important;
        font-weight: 700 !important;
    }
    .dark .anc-nav-pill.active-inventaris {
        background-color: #0f172a !important;
        color: #2dd4bf !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.3) !important;
    }

    .anc-nav-pill.active-pdd,
    .anc-nav-pill.active-events {
        background-color: #ffffff !important;
        color: #4f46e5 !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06) !important;
        font-weight: 700 !important;
    }
    .dark .anc-nav-pill.active-pdd,
    .dark .anc-nav-pill.active-events {
        background-color: #0f172a !important;
        color: #818cf8 !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.3) !important;
    }

    /* ===== Sleek Drag & Drop Zone Styling (Matching Reference) ===== */
    .filepond--panel-root {
        border: 2px dashed rgba(99, 102, 241, 0.45) !important;
        border-radius: 16px !important;
        background-color: rgba(248, 250, 252, 0.7) !important;
        transition: all 0.2s ease !important;
    }
    .dark .filepond--panel-root {
        border-color: rgba(129, 140, 248, 0.35) !important;
        background-color: rgba(30, 41, 59, 0.5) !important;
    }
    .filepond--root:hover .filepond--panel-root {
        border-color: #4f46e5 !important;
        background-color: rgba(238, 242, 255, 0.4) !important;
    }
    .dark .filepond--root:hover .filepond--panel-root {
        border-color: #818cf8 !important;
        background-color: rgba(49, 46, 129, 0.25) !important;
    }

    .anc-web-link {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        padding: 5px 10px !important;
        border-radius: 9px !important;
        font-size: 11.5px !important;
        font-weight: 600 !important;
        text-decoration: none !important;
        background-color: #f1f5f9 !important;
        border: 1px solid #e2e8f0 !important;
        color: #334155 !important;
        transition: all 0.15s ease !important;
        white-space: nowrap !important;
    }
    .dark .anc-web-link {
        background-color: #1e293b !important;
        border: 1px solid #334155 !important;
        color: #cbd5e1 !important;
    }
    .anc-web-link:hover {
        background-color: #e2e8f0 !important;
        color: #0f172a !important;
    }
    .dark .anc-web-link:hover {
        background-color: #334155 !important;
        color: #ffffff !important;
    }
    .anc-web-link svg {
        width: 14px !important;
        height: 14px !important;
        min-width: 14px !important;
        max-width: 14px !important;
        color: #0d59f2 !important;
        flex-shrink: 0 !important;
    }
    .dark .anc-web-link svg {
        color: #60a5fa !important;
    }

    /* Sidebar Footer Status Box */
    .anc-footer-box {
        padding: 12px !important;
        border-radius: 12px !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 6px !important;
        background-color: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        transition: background-color 0.15s ease, border-color 0.15s ease !important;
    }
    .dark .anc-footer-box {
        background-color: #1e293b !important;
        border: 1px solid #334155 !important;
    }
    .anc-footer-header {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
    }
    .anc-footer-title {
        font-size: 10.5px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.1em !important;
        color: #0d59f2 !important;
        font-family: monospace, sans-serif !important;
    }
    .dark .anc-footer-title {
        color: #60a5fa !important;
    }
    .anc-footer-desc {
        font-size: 12px !important;
        font-weight: 500 !important;
        color: #475569 !important;
        margin: 0 !important;
    }
    .dark .anc-footer-desc {
        color: #cbd5e1 !important;
    }
</style>
