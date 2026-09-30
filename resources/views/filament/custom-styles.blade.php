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

    /* ===== Featured Event Page Custom Styling ===== */
    .fe-container {
        display: flex !important;
        flex-direction: column !important;
        gap: 20px !important;
        max-width: 860px !important;
    }
    .fe-card {
        background-color: #ffffff !important;
        border-radius: 16px !important;
        border: 1px solid #e2e8f0 !important;
        padding: 24px !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04) !important;
        transition: background-color 0.15s ease, border-color 0.15s ease !important;
    }
    .dark .fe-card {
        background-color: #0f172a !important;
        border-color: #1e293b !important;
    }
    .fe-header {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        margin-bottom: 16px !important;
    }
    .fe-icon-box {
        width: 36px !important;
        height: 36px !important;
        min-width: 36px !important;
        max-width: 36px !important;
        border-radius: 10px !important;
        background-color: #fef3c7 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: #d97706 !important;
        border: 1px solid #fde68a !important;
        flex-shrink: 0 !important;
    }
    .dark .fe-icon-box {
        background-color: rgba(120, 53, 15, 0.35) !important;
        color: #fbbf24 !important;
        border-color: rgba(180, 83, 9, 0.4) !important;
    }
    .fe-title {
        font-size: 16px !important;
        font-weight: 700 !important;
        color: #0f172a !important;
        margin: 0 !important;
    }
    .dark .fe-title {
        color: #f8fafc !important;
    }
    .fe-subtitle {
        font-size: 12px !important;
        color: #64748b !important;
        margin: 2px 0 0 0 !important;
    }
    .dark .fe-subtitle {
        color: #94a3b8 !important;
    }
    .fe-badge-active {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        padding: 4px 12px !important;
        border-radius: 9999px !important;
        font-size: 11.5px !important;
        font-weight: 700 !important;
        background-color: #ecfdf5 !important;
        color: #059669 !important;
        border: 1px solid #a7f3d0 !important;
    }
    .dark .fe-badge-active {
        background-color: rgba(6, 78, 59, 0.45) !important;
        color: #34d399 !important;
        border-color: rgba(5, 150, 105, 0.35) !important;
    }
    .fe-current-preview {
        background-color: #f8fafc !important;
        border-radius: 12px !important;
        border: 1px solid #e2e8f0 !important;
        padding: 20px !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 16px !important;
    }
    .dark .fe-current-preview {
        background-color: #1e293b !important;
        border-color: #334155 !important;
    }
    .fe-preview-row {
        display: flex !important;
        gap: 20px !important;
        align-items: flex-start !important;
    }
    .fe-poster {
        width: 100px !important;
        height: 100px !important;
        min-width: 100px !important;
        max-width: 100px !important;
        min-height: 100px !important;
        max-height: 100px !important;
        object-fit: cover !important;
        border-radius: 12px !important;
        flex-shrink: 0 !important;
        border: 1px solid #cbd5e1 !important;
        display: block !important;
    }
    .dark .fe-poster {
        border-color: #475569 !important;
    }
    .fe-poster-placeholder {
        width: 100px !important;
        height: 100px !important;
        min-width: 100px !important;
        border-radius: 12px !important;
        background-color: #e2e8f0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: #94a3b8 !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        flex-shrink: 0 !important;
    }
    .dark .fe-poster-placeholder {
        background-color: #334155 !important;
        color: #64748b !important;
    }
    .fe-event-title {
        font-size: 16px !important;
        font-weight: 700 !important;
        color: #0f172a !important;
        margin: 0 0 6px 0 !important;
    }
    .dark .fe-event-title {
        color: #f8fafc !important;
    }
    .fe-event-subtitle {
        display: inline-block !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        color: #4338ca !important;
        background-color: #e0e7ff !important;
        padding: 2px 8px !important;
        border-radius: 6px !important;
        margin-bottom: 8px !important;
    }
    .dark .fe-event-subtitle {
        color: #c7d2fe !important;
        background-color: rgba(67, 56, 202, 0.35) !important;
    }
    .fe-meta-list {
        display: flex !important;
        flex-wrap: wrap !important;
        gap: 16px !important;
        font-size: 12px !important;
        color: #475569 !important;
        margin-top: 6px !important;
    }
    .dark .fe-meta-list {
        color: #94a3b8 !important;
    }
    .fe-meta-label {
        font-weight: 700 !important;
        color: #1e293b !important;
    }
    .dark .fe-meta-label {
        color: #cbd5e1 !important;
    }
    .fe-status-badge {
        font-weight: 600 !important;
        padding: 2px 8px !important;
        border-radius: 4px !important;
        font-size: 11px !important;
    }
    .fe-status-completed {
        background-color: #ecfdf5 !important;
        color: #059669 !important;
    }
    .dark .fe-status-completed {
        background-color: rgba(6, 78, 59, 0.45) !important;
        color: #34d399 !important;
    }
    .fe-status-upcoming {
        background-color: #eff6ff !important;
        color: #0284c7 !important;
    }
    .dark .fe-status-upcoming {
        background-color: rgba(30, 58, 138, 0.45) !important;
        color: #38bdf8 !important;
    }
    .fe-yt-link {
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        font-size: 12px !important;
        margin-top: 10px !important;
    }
    .fe-yt-link a {
        color: #4f46e5 !important;
        text-decoration: underline !important;
        font-weight: 600 !important;
        word-break: break-all !important;
    }
    .dark .fe-yt-link a {
        color: #818cf8 !important;
    }
    .fe-form {
        display: flex !important;
        flex-direction: column !important;
        gap: 18px !important;
    }
    .fe-field {
        display: flex !important;
        flex-direction: column !important;
        gap: 6px !important;
    }
    .fe-label {
        font-size: 11.5px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.06em !important;
        color: #334155 !important;
    }
    .dark .fe-label {
        color: #cbd5e1 !important;
    }
    .fe-select, .fe-input {
        width: 100% !important;
        padding: 10px 14px !important;
        border-radius: 10px !important;
        border: 1px solid #cbd5e1 !important;
        background-color: #ffffff !important;
        font-size: 13.5px !important;
        color: #0f172a !important;
        outline: none !important;
        transition: border-color 0.15s ease, box-shadow 0.15s ease !important;
        box-sizing: border-box !important;
    }
    .dark .fe-select, .dark .fe-input {
        background-color: #1e293b !important;
        border-color: #334155 !important;
        color: #f8fafc !important;
    }
    .fe-select:focus, .fe-input:focus {
        border-color: #4f46e5 !important;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2) !important;
    }
    .fe-btn {
        padding: 10px 20px !important;
        border-radius: 10px !important;
        background-color: #4f46e5 !important;
        color: #ffffff !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        border: none !important;
        cursor: pointer !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        box-shadow: 0 2px 6px rgba(79, 70, 229, 0.3) !important;
        transition: background-color 0.15s ease !important;
    }
    .fe-btn:hover {
        background-color: #4338ca !important;
    }
    .fe-empty {
        padding: 32px !important;
        text-align: center !important;
        background-color: #f8fafc !important;
        border-radius: 12px !important;
        border: 1px dashed #cbd5e1 !important;
        color: #64748b !important;
        font-size: 13px !important;
    }
    .dark .fe-empty {
        background-color: #1e293b !important;
        border-color: #334155 !important;
        color: #94a3b8 !important;
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
