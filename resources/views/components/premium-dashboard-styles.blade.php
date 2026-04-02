<style>
    :root {
        --pd-primary-start: #0b132b;
        --pd-primary-mid: #1c2541;
        --pd-primary-end: #3a506b;
        --pd-accent: #2563eb;
        --pd-bg: #f3f6fb;
        --pd-text: #0f172a;
        --pd-muted: #64748b;
        --pd-card-shadow: 0 14px 30px rgba(15, 23, 42, 0.09);
    }

    body {
        background: var(--pd-bg);
        color: var(--pd-text);
    }

    .header .header-nav {
        background: #fff;
        border-bottom: 1px solid #e2e8f0;
        box-shadow: 0 10px 20px rgba(15, 23, 42, 0.05);
    }

    .header-navbar-rht .dropdown-menu {
        border: 0;
        border-radius: 12px;
        box-shadow: 0 16px 30px rgba(15, 23, 42, 0.13);
    }

    .content {
        padding-top: 20px;
    }

    .premium-hero {
        border-radius: 16px;
        background: linear-gradient(135deg, var(--pd-primary-start) 0%, var(--pd-primary-mid) 45%, var(--pd-primary-end) 100%);
        color: #fff;
        box-shadow: 0 18px 36px rgba(11, 19, 43, 0.22);
        padding: 20px 22px;
        margin-bottom: 18px;
    }

    .premium-hero h2 {
        color: #fff;
        font-weight: 700;
        margin-bottom: 6px;
        font-size: 24px;
    }

    .premium-hero p {
        margin: 0;
        color: rgba(255, 255, 255, 0.82);
        font-size: 14px;
    }

    .premium-hero .btn {
        border-radius: 10px;
        font-weight: 600;
    }

    .profile-sidebar,
    .card,
    .dashboard-widget {
        border: 0;
        border-radius: 16px;
        box-shadow: var(--pd-card-shadow);
        overflow: hidden;
        background: #fff;
    }

    .dashboard-menu ul li a {
        border-radius: 10px;
        margin: 3px 8px;
    }

    .dashboard-menu ul li.active a,
    .dashboard-menu ul li a:hover {
        background: linear-gradient(135deg, #0ea5e9, #2563eb);
        color: #fff;
    }

    .dashboard-menu ul li.active a i,
    .dashboard-menu ul li a:hover i {
        color: #fff;
    }

    .premium-stat-card {
        border-radius: 12px;
        background: #fff;
        box-shadow: var(--pd-card-shadow);
        padding: 16px;
        height: 100%;
    }

    .premium-stat-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 10px;
    }

    .premium-stat-title {
        color: var(--pd-muted);
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.9px;
        font-weight: 700;
    }

    .premium-stat-value {
        font-size: 26px;
        line-height: 1;
        font-weight: 700;
        margin: 0;
        color: var(--pd-text);
    }

    .premium-stat-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 15px;
    }

    .premium-stat-foot {
        font-size: 12px;
        color: var(--pd-muted);
        margin: 0;
    }

    .premium-card {
        border-radius: 14px;
        box-shadow: var(--pd-card-shadow);
        border: 0;
        overflow: hidden;
    }

    .premium-card .card-header {
        background: linear-gradient(180deg, #eef4ff 0%, #f8fbff 100%);
        border-bottom: 1px solid #dbe8ff;
    }

    .premium-card .card-title {
        margin-bottom: 0;
        font-size: 16px;
        font-weight: 700;
        color: var(--pd-text);
    }

    .premium-table-wrap {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
        background: #fff;
    }

    .premium-table thead th {
        border-top: 0;
        background: #eff6ff;
        color: #1e3a8a;
        font-size: 13px;
        font-weight: 700;
        padding-top: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid #dbeafe;
    }

    .premium-table td {
        vertical-align: middle;
        padding-top: 11px;
        padding-bottom: 11px;
        color: #1f2937;
        border-color: #eef2f7;
    }

    .premium-table tbody tr:hover {
        background: #f8fbff;
    }

    .premium-card .btn-primary {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        border: 0;
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(37, 99, 235, 0.25);
    }

    .premium-card .btn-primary:hover {
        background: linear-gradient(135deg, #1d4ed8, #1e40af);
    }

    .premium-badge {
        border-radius: 999px;
        padding: 5px 10px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    .premium-badge.pending { background: #fef3c7; color: #92400e; }
    .premium-badge.approved { background: #dbeafe; color: #1e40af; }
    .premium-badge.completed { background: #d1fae5; color: #065f46; }
    .premium-badge.cancelled { background: #fee2e2; color: #991b1b; }

    @media (max-width: 991px) {
        .premium-hero {
            padding: 16px;
        }

        .premium-hero h2 {
            font-size: 20px;
        }
    }
</style>
