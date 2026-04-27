<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dive - Focused Task Manager</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #0ea5e9 100%);
            min-height: 100vh;
            padding: 2rem 1rem;
            position: relative;
            overflow-x: hidden;
        }
        
        /* Ocean Wave Effect */
        body::after {
            content: '';
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 200px;
            background: linear-gradient(180deg, transparent 0%, rgba(14, 165, 233, 0.2) 100%);
            pointer-events: none;
            z-index: 0;
        }
        
        /* Animated Background Bubbles */
        .particle {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            background: radial-gradient(circle at 30% 30%, rgba(56, 189, 248, 0.4), rgba(14, 165, 233, 0.1));
            animation: float 20s infinite ease-in-out;
        }
        
        @keyframes float {
            0%, 100% { 
                transform: translateY(0) translateX(0) scale(1);
                opacity: 0.3;
            }
            25% { 
                transform: translateY(-150px) translateX(50px) scale(1.2);
                opacity: 0.5;
            }
            50% { 
                transform: translateY(-100px) translateX(-50px) scale(0.8);
                opacity: 0.4;
            }
            75% { 
                transform: translateY(-200px) translateX(100px) scale(1.1);
                opacity: 0.6;
            }
        }
        
        .main-container {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 10;
        }
        
        /* Header */
        .app-header {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeInDown 0.8s ease-out;
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .logo {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff 0%, #f0f9ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            letter-spacing: -2px;
        }
        
        .tagline {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.125rem;
            font-weight: 300;
        }
        
        /* Glass Card */
        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(30px);
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 2.5rem;
            margin-bottom: 2rem;
            animation: fadeInUp 0.8s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Stats */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .stat-box:hover {
            transform: translateY(-8px) scale(1.02);
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            line-height: 1;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 500;
        }
        
        /* Add Task Form */
        .add-task-form {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .task-input {
            flex: 1;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 20px;
            padding: 1.25rem 1.75rem;
            font-size: 1rem;
            color: #1e293b;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .task-input:focus {
            outline: none;
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }
        
        .task-input::placeholder {
            color: #94a3b8;
        }
        
        .btn-add {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            border-radius: 20px;
            padding: 1.25rem 2.5rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 20px rgba(16, 185, 129, 0.4);
        }
        
        .btn-add:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(16, 185, 129, 0.5);
        }
        
        .btn-add:active {
            transform: translateY(-1px);
        }
        
        /* Priority Selector */
        .priority-selector {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }
        
        .priority-btn {
            flex: 1;
            padding: 0.875rem;
            border-radius: 15px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.875rem;
        }
        
        .priority-btn:hover {
            transform: translateY(-2px);
            border-color: rgba(255, 255, 255, 0.4);
        }
        
        .priority-btn.active {
            background: rgba(255, 255, 255, 0.25);
            border-color: white;
            transform: scale(1.05);
        }
        
        /* Filter Tabs */
        .filter-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .filter-tab {
            flex: 1;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 15px;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .filter-tab:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }
        
        .filter-tab.active {
            background: white;
            color: #0ea5e9;
            transform: scale(1.05);
        }
        
        /* Task Item */
        .task-item {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            animation: slideIn 0.5s ease-out;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            position: relative;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .task-item:hover {
            transform: translateX(10px) translateY(-3px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }
        
        .task-item.completed {
            opacity: 0.6;
        }
        
        .task-item.completed .task-text {
            text-decoration: line-through;
            color: #94a3b8;
        }
        
        /* Checkbox */
        .task-checkbox {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 3px solid #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .task-checkbox:hover {
            border-color: #0ea5e9;
            transform: scale(1.1);
        }
        
        .task-checkbox.checked {
            background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
            border-color: #0ea5e9;
        }
        
        .task-checkbox i {
            color: white;
            font-size: 0.875rem;
        }
        
        /* Task Content */
        .task-content {
            flex: 1;
        }
        
        .task-text {
            font-size: 1.0625rem;
            color: #1e293b;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }
        
        .task-meta {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }
        
        .task-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .badge-high {
            background: #fee2e2;
            color: #dc2626;
        }
        
        .badge-medium {
            background: #fef3c7;
            color: #d97706;
        }
        
        .badge-low {
            background: #dcfce7;
            color: #16a34a;
        }
        
        /* Delete Button */
        .btn-delete {
            background: #fee2e2;
            color: #dc2626;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }
        
        .btn-delete:hover {
            background: #fecaca;
            transform: scale(1.1) rotate(10deg);
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: white;
        }
        
        .empty-icon {
            font-size: 5rem;
            margin-bottom: 1.5rem;
            opacity: 0.5;
        }
        
        .empty-text {
            font-size: 1.25rem;
            font-weight: 300;
            opacity: 0.8;
        }
        
        /* Notification */
        .notification {
            position: fixed;
            top: 2rem;
            right: 2rem;
            background: white;
            color: #1e293b;
            padding: 1.25rem 1.75rem;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            animation: slideInRight 0.4s ease-out;
            font-weight: 500;
        }
        
        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .notification.hide {
            animation: slideOutRight 0.4s ease-out forwards;
        }
        
        @keyframes slideOutRight {
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 1rem 0.5rem;
            }
            
            .app-header > div:first-child {
                flex-direction: column !important;
                gap: 1rem;
            }
            
            .app-header > div:first-child > div {
                flex: none !important;
                width: 100%;
                text-align: center !important;
            }
            
            .app-header > div:first-child > div:last-child > div {
                justify-content: center;
            }
            
            .logo {
                font-size: 2rem;
            }
            
            .tagline {
                font-size: 0.875rem;
            }
            
            .stats-container {
                grid-template-columns: repeat(3, 1fr);
                gap: 0.75rem;
            }
            
            .stat-box {
                padding: 1rem;
            }
            
            .stat-number {
                font-size: 1.75rem;
            }
            
            .stat-label {
                font-size: 0.7rem;
            }
            
            .glass-card {
                padding: 1.5rem;
            }
            
            .add-task-form {
                flex-direction: column;
            }
            
            .btn-add {
                width: 100%;
                padding: 1rem;
            }
            
            .priority-selector {
                gap: 0.5rem;
            }
            
            .priority-btn {
                padding: 0.75rem 0.5rem;
                font-size: 0.8rem;
            }
            
            .filter-tabs {
                gap: 0.5rem;
            }
            
            .filter-tab {
                padding: 0.75rem 0.5rem;
                font-size: 0.875rem;
            }
            
            .quick-action-btn {
                padding: 0.5rem 0.875rem;
                font-size: 0.8rem;
                flex: 1 1 calc(50% - 0.375rem);
            }
            
            .task-item {
                padding: 1rem;
                gap: 0.75rem;
            }
            
            .task-item:hover {
                transform: translateY(-2px);
            }
            
            .task-checkbox {
                width: 24px;
                height: 24px;
                border-width: 2px;
                margin-top: 0.25rem;
            }
            
            .task-content {
                flex: 1;
                min-width: 0;
            }
            
            .task-text {
                font-size: 0.95rem;
                word-break: break-word;
            }
            
            .task-meta {
                flex-wrap: wrap;
                gap: 0.5rem;
                margin-top: 0.5rem;
            }
            
            .task-badge, .badge-category, .badge-deadline {
                font-size: 0.7rem;
                padding: 0.2rem 0.6rem;
            }
            
            .task-actions {
                gap: 0.375rem;
            }
            
            .btn-edit, .btn-delete {
                width: 32px;
                height: 32px;
                font-size: 0.875rem;
            }
            
            .modal-content {
                padding: 1.5rem;
                width: 95%;
            }
            
            .modal-header {
                font-size: 1.25rem;
            }
            
            .modal-input {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 480px) {
            .logo {
                font-size: 1.75rem;
            }
            
            .app-header {
                margin-bottom: 2rem;
            }
            
            .stats-container {
                gap: 0.5rem;
            }
            
            .stat-box {
                padding: 0.75rem;
            }
            
            .stat-number {
                font-size: 1.5rem;
            }
            
            .stat-label {
                font-size: 0.65rem;
            }
            
            .glass-card {
                padding: 1rem;
                border-radius: 20px;
            }
            
            .priority-btn {
                padding: 0.625rem 0.375rem;
                font-size: 0.75rem;
            }
            
            .task-input {
                padding: 1rem 1.25rem;
                font-size: 0.9rem;
            }
            
            .quick-action-btn {
                padding: 0.5rem 0.625rem;
                font-size: 0.75rem;
            }
            
            .task-item {
                padding: 0.875rem;
            }
            
            .task-text {
                font-size: 0.9rem;
            }
            
            .btn-edit, .btn-delete {
                width: 28px;
                height: 28px;
                font-size: 0.8rem;
            }
        }
        
        /* Quick Action Buttons */
        .quick-action-btn {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.625rem 1.25rem;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .quick-action-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
        }
        
        /* Task Actions */
        .task-actions {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            flex-shrink: 0;
        }
        
        .btn-edit {
            background: #dbeafe;
            color: #1e40af;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }
        
        .btn-edit:hover {
            background: #bfdbfe;
            transform: scale(1.1);
        }
        
        /* Category Badge */
        .badge-category {
            background: #e0f2fe;
            color: #0369a1;
            padding: 0.25rem 0.75rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        /* Deadline Badge */
        .badge-deadline {
            background: #fef3c7;
            color: #92400e;
            padding: 0.25rem 0.75rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        
        .badge-overdue {
            background: #fee2e2;
            color: #991b1b;
        }
        
        /* Edit Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            z-index: 9998;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .modal-content {
            background: white;
            border-radius: 24px;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            animation: scaleIn 0.3s ease-out;
        }
        
        @keyframes scaleIn {
            from {
                transform: scale(0.9);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        .modal-header {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1.5rem;
        }
        
        .modal-input {
            width: 100%;
            padding: 0.875rem 1.25rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }
        
        .modal-input:focus {
            outline: none;
            border-color: #0ea5e9;
        }
        
        .modal-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .btn-modal {
            flex: 1;
            padding: 0.875rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-modal-primary {
            background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
            color: white;
        }
        
        .btn-modal-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(14, 165, 233, 0.4);
        }
        
        .btn-modal-secondary {
            background: #f1f5f9;
            color: #475569;
        }
        
        .btn-modal-secondary:hover {
            background: #e2e8f0;
        }
    </style>
</head>
<body>
    
    <!-- Animated Bubbles -->
    <div class="particle" style="width: 120px; height: 120px; top: 10%; left: 10%; animation-delay: 0s;"></div>
    <div class="particle" style="width: 80px; height: 80px; top: 20%; left: 85%; animation-delay: 3s;"></div>
    <div class="particle" style="width: 150px; height: 150px; top: 60%; left: 80%; animation-delay: 6s;"></div>
    <div class="particle" style="width: 100px; height: 100px; top: 75%; left: 15%; animation-delay: 9s;"></div>
    <div class="particle" style="width: 60px; height: 60px; top: 40%; left: 5%; animation-delay: 12s;"></div>
    <div class="particle" style="width: 90px; height: 90px; top: 85%; left: 70%; animation-delay: 15s;"></div>
    
    <div class="main-container">
        
        <!-- Header -->
        <div class="app-header">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <div style="flex: 1;"></div>
                <div style="flex: 1; text-align: center;">
                    <div class="logo">Dive</div>
                    <div class="tagline">Dive into focused work</div>
                </div>
                <div style="flex: 1; text-align: right;">
                    <div style="display: inline-flex; align-items: center; gap: 1rem; background: rgba(255, 255, 255, 0.15); padding: 0.75rem 1.25rem; border-radius: 15px; backdrop-filter: blur(10px);">
                        <span style="color: white; font-weight: 500; font-size: 0.875rem;">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" style="background: rgba(239, 68, 68, 0.2); color: #fca5a5; border: none; padding: 0.5rem 1rem; border-radius: 10px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; font-size: 0.875rem;">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Stats -->
        <div class="stats-container">
            <div class="stat-box">
                <div class="stat-number" id="statTotal">0</div>
                <div class="stat-label">Total</div>
            </div>
            <div class="stat-box">
                <div class="stat-number" id="statActive">0</div>
                <div class="stat-label">Aktif</div>
            </div>
            <div class="stat-box">
                <div class="stat-number" id="statDone">0</div>
                <div class="stat-label">Selesai</div>
            </div>
        </div>
        
        <!-- Main Card -->
        <div class="glass-card">
            
            <!-- Priority Selector -->
            <div class="priority-selector">
                <button class="priority-btn" onclick="selectPriority('high')" data-priority="high">
                    🔴 Tinggi
                </button>
                <button class="priority-btn active" onclick="selectPriority('medium')" data-priority="medium">
                    🟡 Sedang
                </button>
                <button class="priority-btn" onclick="selectPriority('low')" data-priority="low">
                    🟢 Rendah
                </button>
            </div>
            
            <!-- Add Task Form -->
            <form class="add-task-form" onsubmit="addTask(event)">
                <input type="text" 
                       class="task-input" 
                       id="taskInput" 
                       placeholder="Apa yang perlu diselesaikan?" 
                       required>
                <button type="submit" class="btn-add">
                    <i class="bi bi-plus-lg"></i> Tambah Tugas
                </button>
            </form>
            
            <!-- Advanced Options -->
            <div style="display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 200px; position: relative;">
                    <label style="display: block; color: white; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem; padding-left: 0.5rem;">
                        📅 Tenggat Waktu (Opsional)
                    </label>
                    <input type="date" 
                           class="task-input" 
                           id="taskDeadline" 
                           style="width: 100%; padding: 0.875rem 1.25rem; font-size: 0.9rem;">
                </div>
                <div style="flex: 1; min-width: 200px;">
                    <label style="display: block; color: white; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem; padding-left: 0.5rem;">
                        🏷️ Kategori
                    </label>
                    <select class="task-input" id="taskCategory" style="width: 100%; padding: 0.875rem 1.25rem; font-size: 0.9rem;">
                        <option value="personal">👤 Pribadi</option>
                        <option value="work">💼 Pekerjaan</option>
                        <option value="shopping">🛒 Belanja</option>
                        <option value="health">💪 Kesehatan</option>
                        <option value="learning">📚 Belajar</option>
                    </select>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div style="display: flex; gap: 0.75rem; margin-bottom: 2rem; flex-wrap: wrap;">
                <button class="quick-action-btn" onclick="clearCompleted()">
                    <i class="bi bi-trash"></i> Hapus Selesai
                </button>
                <button class="quick-action-btn" onclick="markAllComplete()">
                    <i class="bi bi-check-all"></i> Tandai Semua
                </button>
                <button class="quick-action-btn" onclick="sortTasks('priority')">
                    <i class="bi bi-sort-down"></i> Urutkan Prioritas
                </button>
                <button class="quick-action-btn" onclick="sortTasks('date')">
                    <i class="bi bi-calendar"></i> Urutkan Tanggal
                </button>
            </div>
            
            <!-- Search Bar -->
            <div style="margin-bottom: 2rem;">
                <input type="text" 
                       class="task-input" 
                       id="searchInput" 
                       placeholder="🔍 Cari tugas..." 
                       oninput="searchTasks()"
                       style="padding: 0.875rem 1.25rem;">
            </div>
            
            <!-- Filter Tabs -->
            <div class="filter-tabs">
                <button class="filter-tab active" onclick="filterTasks('all')">
                    Semua
                </button>
                <button class="filter-tab" onclick="filterTasks('active')">
                    Aktif
                </button>
                <button class="filter-tab" onclick="filterTasks('done')">
                    Selesai
                </button>
            </div>
            
            <!-- Tasks List -->
            <div id="tasksList"></div>
            
            <!-- Empty State -->
            <div id="emptyState" class="empty-state" style="display: none;">
                <div class="empty-icon">✨</div>
                <div class="empty-text">Belum ada tugas. Tambahkan di atas!</div>
            </div>
            
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        let tasks = @json($tasks);
        let currentFilter = 'all';
        let selectedPriority = 'medium';
        let editingTaskId = null;
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            renderTasks();
            updateStats();
        });
        
        // Select Priority
        function selectPriority(priority) {
            selectedPriority = priority;
            document.querySelectorAll('.priority-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelector(`[data-priority="${priority}"]`).classList.add('active');
        }
        
        // Add Task
        async function addTask(event) {
            event.preventDefault();
            
            const title = document.getElementById('taskInput').value.trim();
            if (!title) return;
            
            const deadline = document.getElementById('taskDeadline').value;
            const category = document.getElementById('taskCategory').value;
            
            const taskData = {
                title: title,
                priority: selectedPriority,
                category: category,
                description: '',
                deadline: deadline || null
            };
            
            try {
                const response = await fetch('/tasks', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(taskData)
                });
                
                const data = await response.json();
                
                if (data.success) {
                    tasks.unshift(data.task);
                    renderTasks();
                    updateStats();
                    document.getElementById('taskInput').value = '';
                    document.getElementById('taskDeadline').value = '';
                    showNotification('✓ Task added successfully!');
                }
            } catch (error) {
                showNotification('✗ Failed to add task');
            }
        }
        
        // Filter Tasks
        function filterTasks(filter) {
            currentFilter = filter;
            
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            event.target.classList.add('active');
            
            renderTasks();
        }
        
        // Search Tasks
        function searchTasks() {
            renderTasks();
        }
        
        // Sort Tasks
        function sortTasks(type) {
            if (type === 'priority') {
                const priorityOrder = { high: 1, medium: 2, low: 3 };
                tasks.sort((a, b) => priorityOrder[a.priority] - priorityOrder[b.priority]);
            } else if (type === 'date') {
                tasks.sort((a, b) => {
                    if (!a.deadline) return 1;
                    if (!b.deadline) return -1;
                    return new Date(a.deadline) - new Date(b.deadline);
                });
            }
            renderTasks();
            showNotification('✓ Tugas diurutkan');
        }
        
        // Clear Completed
        async function clearCompleted() {
            const completedTasks = tasks.filter(t => t.is_completed);
            
            if (completedTasks.length === 0) {
                showNotification('Tidak ada tugas selesai untuk dihapus');
                return;
            }
            
            if (!confirm(`Hapus ${completedTasks.length} tugas yang selesai?`)) return;
            
            for (const task of completedTasks) {
                await deleteTaskSilent(task.id);
            }
            
            tasks = tasks.filter(t => !t.is_completed);
            renderTasks();
            updateStats();
            showNotification(`✓ ${completedTasks.length} tugas dihapus`);
        }
        
        // Mark All Complete
        async function markAllComplete() {
            const incompleteTasks = tasks.filter(t => !t.is_completed);
            
            if (incompleteTasks.length === 0) {
                showNotification('Semua tugas sudah selesai!');
                return;
            }
            
            for (const task of incompleteTasks) {
                await toggleTaskSilent(task.id);
                task.is_completed = true;
            }
            
            renderTasks();
            updateStats();
            showNotification(`✓ ${incompleteTasks.length} tugas ditandai selesai`);
        }
        
        // Render Tasks
        function renderTasks() {
            const container = document.getElementById('tasksList');
            const emptyState = document.getElementById('emptyState');
            const searchQuery = document.getElementById('searchInput').value.toLowerCase();
            
            let filteredTasks = tasks;
            
            // Apply filter
            if (currentFilter === 'active') {
                filteredTasks = tasks.filter(t => !t.is_completed);
            } else if (currentFilter === 'done') {
                filteredTasks = tasks.filter(t => t.is_completed);
            }
            
            // Apply search
            if (searchQuery) {
                filteredTasks = filteredTasks.filter(t => 
                    t.title.toLowerCase().includes(searchQuery)
                );
            }
            
            if (filteredTasks.length === 0) {
                container.innerHTML = '';
                emptyState.style.display = 'block';
                return;
            }
            
            emptyState.style.display = 'none';
            
            container.innerHTML = filteredTasks.map(task => `
                <div class="task-item ${task.is_completed ? 'completed' : ''}">
                    <div class="task-checkbox ${task.is_completed ? 'checked' : ''}" 
                         onclick="toggleTask(${task.id})">
                        ${task.is_completed ? '<i class="bi bi-check-lg"></i>' : ''}
                    </div>
                    <div class="task-content" onclick="toggleTask(${task.id})">
                        <div class="task-text">${escapeHtml(task.title)}</div>
                        <div class="task-meta">
                            <span class="task-badge badge-${task.priority}">
                                ${task.priority}
                            </span>
                            <span class="badge-category">
                                ${getCategoryIcon(task.category)}
                            </span>
                            ${task.deadline ? `
                                <span class="badge-deadline ${isOverdue(task.deadline, task.is_completed) ? 'badge-overdue' : ''}">
                                    <i class="bi bi-calendar"></i> ${formatDeadline(task.deadline)}
                                </span>
                            ` : ''}
                        </div>
                    </div>
                    <div class="task-actions">
                        <button class="btn-edit" onclick="event.stopPropagation(); editTask(${task.id})">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn-delete" onclick="event.stopPropagation(); deleteTask(${task.id})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            `).join('');
        }
        
        // Edit Task
        function editTask(taskId) {
            const task = tasks.find(t => t.id === taskId);
            if (!task) return;
            
            editingTaskId = taskId;
            
            const modal = document.createElement('div');
            modal.className = 'modal-overlay';
            modal.innerHTML = `
                <div class="modal-content">
                    <div class="modal-header">Edit Tugas</div>
                    <input type="text" class="modal-input" id="editTitle" value="${escapeHtml(task.title)}" placeholder="Judul tugas">
                    <input type="date" class="modal-input" id="editDeadline" value="${task.deadline ? task.deadline.split('T')[0] : ''}">
                    <select class="modal-input" id="editCategory">
                        <option value="personal" ${task.category === 'personal' ? 'selected' : ''}>👤 Pribadi</option>
                        <option value="work" ${task.category === 'work' ? 'selected' : ''}>💼 Pekerjaan</option>
                        <option value="shopping" ${task.category === 'shopping' ? 'selected' : ''}>🛒 Belanja</option>
                        <option value="health" ${task.category === 'health' ? 'selected' : ''}>💪 Kesehatan</option>
                        <option value="learning" ${task.category === 'learning' ? 'selected' : ''}>📚 Belajar</option>
                    </select>
                    <select class="modal-input" id="editPriority">
                        <option value="high" ${task.priority === 'high' ? 'selected' : ''}>🔴 Tinggi</option>
                        <option value="medium" ${task.priority === 'medium' ? 'selected' : ''}>🟡 Sedang</option>
                        <option value="low" ${task.priority === 'low' ? 'selected' : ''}>🟢 Rendah</option>
                    </select>
                    <div class="modal-actions">
                        <button class="btn-modal btn-modal-secondary" onclick="closeModal()">Batal</button>
                        <button class="btn-modal btn-modal-primary" onclick="saveEdit()">Simpan</button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
        }
        
        // Save Edit
        async function saveEdit() {
            const title = document.getElementById('editTitle').value.trim();
            const deadline = document.getElementById('editDeadline').value;
            const category = document.getElementById('editCategory').value;
            const priority = document.getElementById('editPriority').value;
            
            if (!title) return;
            
            try {
                const response = await fetch(`/tasks/${editingTaskId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        title: title,
                        deadline: deadline || null,
                        category: category,
                        priority: priority
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    const task = tasks.find(t => t.id === editingTaskId);
                    Object.assign(task, data.task);
                    renderTasks();
                    closeModal();
                    showNotification('✓ Tugas berhasil diperbarui!');
                }
            } catch (error) {
                showNotification('✗ Gagal memperbarui tugas');
            }
        }
        
        // Close Modal
        function closeModal() {
            const modal = document.querySelector('.modal-overlay');
            if (modal) modal.remove();
            editingTaskId = null;
        }
        
        // Toggle Task
        async function toggleTask(taskId) {
            try {
                const response = await fetch(`/tasks/${taskId}/toggle`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    const task = tasks.find(t => t.id === taskId);
                    task.is_completed = data.task.is_completed;
                    renderTasks();
                    updateStats();
                    showNotification(task.is_completed ? '✓ Task completed!' : '↻ Task reopened');
                }
            } catch (error) {
                showNotification('✗ Failed to update task');
            }
        }
        
        // Toggle Task Silent (no notification)
        async function toggleTaskSilent(taskId) {
            try {
                await fetch(`/tasks/${taskId}/toggle`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
            } catch (error) {
                console.error('Failed to toggle task');
            }
        }
        
        // Delete Task
        async function deleteTask(taskId) {
            if (!confirm('Hapus tugas ini?')) return;
            
            try {
                const response = await fetch(`/tasks/${taskId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    tasks = tasks.filter(t => t.id !== taskId);
                    renderTasks();
                    updateStats();
                    showNotification('✓ Tugas dihapus');
                }
            } catch (error) {
                showNotification('✗ Gagal menghapus tugas');
            }
        }
        
        // Delete Task Silent (no notification)
        async function deleteTaskSilent(taskId) {
            try {
                await fetch(`/tasks/${taskId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
            } catch (error) {
                console.error('Failed to delete task');
            }
        }
        
        // Update Stats
        function updateStats() {
            const total = tasks.length;
            const completed = tasks.filter(t => t.is_completed).length;
            const active = total - completed;
            
            document.getElementById('statTotal').textContent = total;
            document.getElementById('statActive').textContent = active;
            document.getElementById('statDone').textContent = completed;
        }
        
        // Helper Functions
        function getCategoryIcon(category) {
            const icons = {
                personal: '👤 Pribadi',
                work: '💼 Pekerjaan',
                shopping: '🛒 Belanja',
                health: '💪 Kesehatan',
                learning: '📚 Belajar'
            };
            return icons[category] || category;
        }
        
        function formatDeadline(deadline) {
            if (!deadline) return '';
            const date = new Date(deadline);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            const taskDate = new Date(date);
            taskDate.setHours(0, 0, 0, 0);
            
            const diffTime = taskDate - today;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            if (diffDays < 0) return 'Terlambat';
            if (diffDays === 0) return 'Hari ini';
            if (diffDays === 1) return 'Besok';
            return date.toLocaleDateString('id-ID');
        }
        
        function isOverdue(deadline, isCompleted) {
            if (!deadline || isCompleted) return false;
            return new Date(deadline) < new Date();
        }
        
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
        
        // Show Notification
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'notification';
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.classList.add('hide');
                setTimeout(() => notification.remove(), 400);
            }, 3000);
        }
    </script>
</body>
</html>
