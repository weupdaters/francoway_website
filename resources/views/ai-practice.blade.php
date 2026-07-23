@extends('users.layouts.app')

@section('content')
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,100..900;1,9..144,100..900&family=Figtree:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* Premium Fonts and Variables */
    body {
        font-family: 'Figtree', sans-serif;
    }

    .chat-container-wrapper {
        display: flex;
        height: 720px;
        background: #ffffff;
        border: 1px solid rgba(13, 110, 253, 0.15);
        border-radius: 24px;
        overflow: hidden;
        margin: 40px auto;
        max-width: 1200px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        position: relative; /* Contain absolute children */
    }

    /* Sidebar Styles */
    .chat-sidebar {
        width: 320px;
        background: #f8fafc;
        border-right: 1px solid rgba(0, 0, 0, 0.08);
        padding: 30px 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .sidebar-header h4 {
        font-family: 'Fraunces', serif;
        font-weight: bold;
        color: #0f172a;
        font-size: 22px;
        margin-bottom: 8px;
    }

    .sidebar-header .status {
        font-size: 13px;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 24px;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        background-color: #2ec4b6;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 8px #2ec4b6;
        animation: pulseActive 2s infinite;
    }

    @keyframes pulseActive {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(46, 196, 182, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(46, 196, 182, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(46, 196, 182, 0); }
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.4; }
    }
    .animate-pulse {
        animation: pulse 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    /* Skill Cards */
    .skill-card {
        background: #ffffff;
        border: 1px solid rgba(13, 110, 253, 0.1);
        border-radius: 12px;
        padding: 12px 16px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .skill-card:hover {
        background: rgba(13, 110, 253, 0.04);
        border-color: rgba(13, 110, 253, 0.3);
        transform: translateY(-2px);
    }

    .skill-icon {
        width: 36px;
        height: 36px;
        background: rgba(13, 110, 253, 0.08);
        color: #0d6efd;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .skill-info h5 {
        margin: 0;
        color: #0f172a;
        font-size: 14px;
        font-weight: 600;
        text-align: left;
    }

    .skill-info p {
        margin: 0;
        color: #64748b;
        font-size: 11px;
        text-align: left;
    }

    /* History list overrides */
    .history-item {
        background: #ffffff !important;
        border-color: rgba(0, 0, 0, 0.08) !important;
        transition: all 0.2s;
    }
    .history-item:hover {
        background: rgba(13, 110, 253, 0.04) !important;
        border-color: rgba(13, 110, 253, 0.25) !important;
    }
    .history-item .text-secondary {
        color: #64748b !important;
    }
    .history-item .text-primary {
        color: #0d6efd !important;
    }
    .chat-sidebar h5.text-white {
        color: #0f172a !important;
    }
    .chat-sidebar .sidebar-bottom small {
        color: #64748b !important;
    }
    .chat-sidebar .sidebar-bottom p {
        color: #475569 !important;
    }

    /* Main Chat Window */
    .chat-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: #ffffff;
        position: relative;
    }

    /* Welcome Banner */
    .welcome-banner {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 60px 40px;
        text-align: center;
        flex: 1;
    }

    .welcome-banner i.logo-icon {
        font-size: 4rem;
        color: #0d6efd;
        margin-bottom: 20px;
        text-shadow: 0 0 20px rgba(13, 110, 253, 0.15);
    }

    .welcome-banner h3 {
        font-family: 'Fraunces', serif;
        font-size: 32px;
        color: #0f172a;
        margin-bottom: 12px;
    }

    .welcome-banner p {
        color: #475569;
        font-size: 16px;
        max-width: 500px;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    /* Messages Area */
    .chat-messages {
        flex: 1;
        padding: 30px;
        overflow-y: auto;
        display: none;
        flex-direction: column;
        gap: 20px;
    }

    /* Message Bubbles */
    .message {
        max-width: 80%;
        padding: 16px 20px;
        border-radius: 18px;
        line-height: 1.6;
        font-size: 15px;
        word-wrap: break-word;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
    }

    .message.user {
        align-self: flex-end;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: #ffffff !important;
        border-top-right-radius: 2px;
        font-weight: 500;
    }

    .message.assistant {
        align-self: flex-start;
        background: #f1f5f9;
        color: #1e293b;
        border: 1px solid rgba(0, 0, 0, 0.06);
        border-top-left-radius: 2px;
    }

    /* Markdown Formatting inside assistant bubble */
    .message.assistant h3 {
        color: #0d6efd;
        font-size: 1.25rem;
        margin-top: 15px;
        margin-bottom: 8px;
        font-weight: 600;
        font-family: 'Fraunces', serif;
    }

    .message.assistant h4 {
        color: #0f172a;
        font-size: 1.1rem;
        margin-top: 12px;
        margin-bottom: 6px;
        font-weight: 500;
    }

    .message.assistant p {
        margin-bottom: 10px;
    }

    .message.assistant ul, .message.assistant ol {
        padding-left: 20px;
        margin-bottom: 12px;
    }

    .message.assistant li {
        margin-bottom: 6px;
    }

    .message.assistant hr {
        border-color: rgba(0, 0, 0, 0.08);
        margin: 15px 0;
    }

    /* Collapsible Answers */
    .message.assistant details {
        background: #ffffff;
        border: 1px solid rgba(13, 110, 253, 0.15);
        padding: 12px;
        border-radius: 10px;
        margin-top: 12px;
        transition: 0.3s;
    }

    .message.assistant summary {
        cursor: pointer;
        font-weight: bold;
        color: #0d6efd;
        outline: none;
    }

    /* Quick Suggestion Chips */
    .quick-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        padding: 0 30px;
        margin-bottom: 15px;
    }

    .chip {
        background: rgba(13, 110, 253, 0.05);
        border: 1px solid rgba(13, 110, 253, 0.15);
        color: #0d6efd;
        padding: 10px 20px;
        border-radius: 50px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .chip:hover {
        background: #0d6efd;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.15);
    }

    /* Chat Input Bar */
    .chat-input-area {
        padding: 20px 30px;
        background: #f8fafc;
        border-top: 1px solid rgba(0, 0, 0, 0.08);
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .chat-input {
        flex: 1;
        background: #ffffff !important;
        border: 1px solid rgba(0, 0, 0, 0.12) !important;
        color: #0f172a !important;
        border-radius: 50px !important;
        padding: 14px 24px !important;
        font-size: 15px;
        transition: all 0.3s ease;
        outline: none;
    }

    .chat-input::placeholder {
        color: #94a3b8;
    }

    .chat-input:focus {
        border-color: #0d6efd !important;
        box-shadow: 0 0 12px rgba(13, 110, 253, 0.15) !important;
    }

    .chat-submit-btn {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: #ffffff;
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 18px;
    }

    .chat-submit-btn:hover {
        transform: scale(1.06);
        box-shadow: 0 0 15px rgba(13, 110, 253, 0.3);
    }

    /* Typing Loader */
    .typing-indicator {
        display: none;
        align-self: flex-start;
        background: #f1f5f9;
        padding: 15px 25px;
        border-radius: 18px;
        border: 1px solid rgba(0, 0, 0, 0.06);
        border-top-left-radius: 2px;
        margin-bottom: 10px;
    }

    .typing-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #0d6efd;
        animation: typingBounce 1.4s infinite both;
        margin-right: 4px;
    }

    .typing-dot:nth-child(2) { animation-delay: 0.2s; }
    .typing-dot:nth-child(3) { animation-delay: 0.4s; }

    @keyframes typingBounce {
        0%, 80%, 100% { transform: scale(0.6); opacity: 0.4; }
        40% { transform: scale(1.2); opacity: 1; }
    }

    /* Reading Workspace Layout */
    .reading-workspace {
        display: none;
        flex-direction: column;
        height: 100%;
        width: 100%;
        background: #ffffff;
    }

    .reading-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 30px;
        background: #f8fafc;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    }

    .reading-header-title {
        font-family: 'Fraunces', serif;
        color: #0d6efd;
        font-size: 20px;
        margin: 0;
        font-weight: bold;
    }

    .reading-timer {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #0d6efd;
        background: rgba(13, 110, 253, 0.06);
        border: 1px solid rgba(13, 110, 253, 0.15);
        padding: 6px 16px;
        border-radius: 50px;
        font-family: monospace;
        font-size: 16px;
        font-weight: bold;
    }

    .reading-timer i {
        color: #0d6efd;
        animation: pulseTimer 1s infinite alternate;
    }

    @keyframes pulseTimer {
        0% { transform: scale(0.9); opacity: 0.8; }
        100% { transform: scale(1.1); opacity: 1; }
    }

    .reading-body {
        flex: 1;
        display: flex;
        overflow: hidden;
        background: #ffffff;
        min-height: 0;
    }

    .reading-left-nav {
        width: 240px;
        background: #f8fafc;
        border-right: 1px solid rgba(0, 0, 0, 0.08);
        display: flex;
        flex-direction: column;
        flex-shrink: 0;
    }

    .reading-nav-title {
        padding: 20px 24px;
        font-family: 'Fraunces', serif;
        color: #0d6efd;
        font-weight: bold;
        font-size: 14px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .reading-sections-list {
        flex: 1;
        overflow-y: auto;
        padding: 15px;
    }

    .reading-sec-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 16px;
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.06);
        border-radius: 8px;
        margin-bottom: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .reading-sec-item:hover {
        background: rgba(13, 110, 253, 0.04);
        border-color: rgba(13, 110, 253, 0.2);
    }

    .reading-sec-item.active {
        background: rgba(13, 110, 253, 0.08);
        border-color: #0d6efd;
    }

    .reading-sec-item .sec-name {
        color: #1e293b;
        font-size: 13px;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 130px;
        text-align: left;
    }

    .reading-sec-item .sec-progress {
        font-size: 11px;
        color: #0d6efd;
        font-weight: bold;
        background: rgba(13, 110, 253, 0.1);
        padding: 2px 6px;
        border-radius: 4px;
    }

    .reading-passage-pane {
        flex: 1.2;
        padding: 30px;
        overflow-y: auto;
        border-right: 1px solid rgba(0, 0, 0, 0.08);
        color: #334155;
        line-height: 1.8;
        font-size: 16px;
        text-align: left;
    }

    .reading-passage-pane h1, .reading-passage-pane h2, .reading-passage-pane h3 {
        font-family: 'Fraunces', serif;
        color: #0d6efd;
        margin-top: 0;
        margin-bottom: 20px;
    }

    .reading-passage-pane p {
        margin-bottom: 20px;
    }

    .reading-questions-pane {
        flex: 1;
        padding: 30px;
        overflow-y: auto;
        background: #f8fafc;
    }

    .reading-question-card {
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.06);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .reading-question-card:hover {
        border-color: rgba(13, 110, 253, 0.2);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
    }

    .reading-question-header {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 15px;
    }

    .reading-question-number {
        background: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 14px;
        flex-shrink: 0;
    }

    .reading-question-text {
        color: #0f172a;
        font-size: 15px;
        font-weight: 500;
        margin: 0;
        line-height: 1.5;
        text-align: left;
    }

    /* Option Selector (Segmented Control style) */
    .reading-options-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-top: 12px;
    }

    .reading-option-btn {
        width: 100%;
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.08);
        color: #475569;
        padding: 10px 16px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.2s ease;
        text-align: left;
    }

    .reading-option-btn:hover {
        background: rgba(13, 110, 253, 0.04);
        color: #0d6efd;
        border-color: rgba(13, 110, 253, 0.2);
    }

    .reading-option-btn.active {
        background: #0d6efd;
        color: #ffffff !important;
        border-color: #0d6efd;
        box-shadow: 0 2px 8px rgba(13, 110, 253, 0.2);
    }

    .reading-input-text {
        width: 100%;
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.12);
        color: #0f172a;
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 14px;
        outline: none;
        transition: all 0.3s ease;
    }

    .reading-input-text:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 8px rgba(13, 110, 253, 0.15);
    }

    .reading-footer {
        padding: 15px 30px;
        background: #f8fafc;
        border-top: 1px solid rgba(0, 0, 0, 0.08);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .reading-footer .text-white {
        color: #0f172a !important;
    }

    .reading-footer .text-white-50 {
        color: #64748b !important;
    }

    .btn-primary.text-dark {
        color: #ffffff !important;
    }

    .question-nav-ribbon {
        display: flex;
        gap: 8px;
        overflow-x: auto;
        padding-bottom: 5px;
    }

    .question-nav-dot {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.08);
        color: #64748b;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }

    .question-nav-dot:hover {
        background: rgba(13, 110, 253, 0.05);
        color: #0d6efd;
        border-color: rgba(13, 110, 253, 0.2);
    }

    .question-nav-dot.answered {
        background: rgba(13, 110, 253, 0.1);
        border-color: #0d6efd;
        color: #0d6efd;
    }

    .question-nav-dot.active {
        border-color: #0f172a;
        color: #0f172a;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    }

    .question-nav-dot.correct {
        background: #10b981 !important;
        border-color: #10b981 !important;
        color: #fff !important;
    }

    .question-nav-dot.incorrect {
        background: #ef4444 !important;
        border-color: #ef4444 !important;
        color: #fff !important;
    }

    .question-nav-dot.unanswered {
        background: rgba(13, 110, 253, 0.05) !important;
        border-color: rgba(13, 110, 253, 0.2) !important;
        color: #0d6efd !important;
    }

    @media (max-width: 991px) {
        .reading-left-nav {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .reading-body {
            flex-direction: column;
            height: auto;
        }
        .reading-passage-pane {
            border-right: none;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            height: 300px;
            flex: none;
        }
        .reading-questions-pane {
            height: 300px;
            flex: none;
        }
        .reading-footer {
            flex-direction: column;
            gap: 12px;
            padding: 12px 20px;
        }
        .question-nav-ribbon {
            width: 100%;
            justify-content: center;
        }
    }

    /* FrancoWay Premium White Theme Writing Workspace */
    .writing-workspace-light {
        display: none;
        flex-direction: column;
        height: 100% !important;
        width: 100% !important;
        background-color: #ffffff !important;
        font-family: 'Figtree', sans-serif;
        color: #1e293b;
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        z-index: 50 !important; /* Layer inside wrapper */
        border-radius: 24px;
        overflow: hidden;
    }

    .writing-header-light {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 24px;
        background: #f8fafc;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        height: 60px;
    }

    .btn-back-light {
        background: none;
        border: none;
        font-size: 18px;
        color: #0d6efd;
        padding: 4px 8px;
        cursor: pointer;
    }

    .writing-title-text-light {
        font-family: 'Fraunces', serif;
        font-weight: bold;
        font-size: 16px;
        color: #0d6efd;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .writing-timer-light {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        top: 42px; /* Overlaps the bottom border of the header */
        z-index: 2010;
        display: flex;
        align-items: center;
        gap: 6px;
        color: #0d6efd;
        background: #ffffff;
        border: 1px solid rgba(13, 110, 253, 0.2);
        padding: 4px 16px;
        border-radius: 20px;
        font-family: monospace;
        font-size: 15px;
        font-weight: 700;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .writing-timer-light i {
        font-size: 18px;
    }

    .writing-body-light {
        flex: 1;
        display: flex;
        padding: 16px;
        gap: 12px;
        overflow: hidden;
        min-height: 0;
        background-color: #ffffff;
    }

    .writing-pane-light {
        flex: 1;
        height: 100%;
        min-width: 0;
    }

    .writing-card-light {
        background: #ffffff !important;
        border-radius: 12px;
        border: 1px solid rgba(13, 110, 253, 0.2) !important;
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
        overflow: hidden;
    }

    .writing-card-header-light {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 16px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        background: #f8fafc !important;
    }

    .writing-card-header-light .text-white {
        color: #0f172a !important;
    }

    .icon-circle-blue-light {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        border-radius: 50%;
        font-size: 12px;
    }

    .icon-circle-darkblue-light {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        background-color: #0d6efd;
        color: #fff;
        border-radius: 50%;
        font-size: 12px;
    }

    .select-view-light {
        border-radius: 20px;
        font-size: 12px;
        padding: 4px 12px;
        border: 1px solid rgba(0, 0, 0, 0.08);
        background-color: #ffffff;
        color: #1e293b;
    }

    .btn-flag-light {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #ef4444;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .writing-card-body-light {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
        font-size: 15px;
        line-height: 1.6;
        color: #1e293b !important;
        text-align: left;
    }

    #writingPromptPane,
    #writingPromptPane * {
        color: #1e293b !important;
    }

    .writing-textarea-container-light {
        flex: 1;
        width: 100%;
        height: 100%; /* Ensure it takes full height */
        border: 1px dashed rgba(13, 110, 253, 0.3);
        border-radius: 8px;
        padding: 12px;
        background: #f8fafc;
        display: flex;
        flex-direction: column;
    }

    .writing-textarea-light {
        width: 100% !important;
        height: 100% !important;
        flex: 1;
        border: none !important;
        outline: none !important;
        resize: none !important;
        font-size: 14px;
        color: #0f172a !important;
        line-height: 1.6;
        background-color: transparent !important;
    }

    #writingTextarea {
        color: #0f172a !important;
    }

    .writing-card-light .text-white-50 {
        color: #64748b !important;
    }

    .writing-card-light .text-white {
        color: #0f172a !important;
    }

    #writingSubmitBtn {
        color: #ffffff !important;
    }

    .writing-word-count-light {
        font-size: 14px;
        color: #0d6efd;
        font-weight: 600;
        margin-top: 12px;
        text-align: left;
    }

    /* Resize Divider Style */
    .writing-divider-light {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        width: 10px;
        cursor: col-resize;
    }

    .divider-line-light {
        width: 2px;
        background-color: rgba(0, 0, 0, 0.08);
        height: 100%;
    }

    .divider-handle-light {
        position: absolute;
        background-color: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 4px;
        padding: 6px 2px;
        font-size: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Footer styling */
    .writing-footer-light {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 24px;
        background: #f8fafc;
        border-top: 1px solid rgba(0, 0, 0, 0.08);
        height: 90px;
    }

    .footer-left-light {
        display: flex;
        flex-direction: column;
        text-align: left;
    }

    .bullet-blue-light {
        display: inline-block;
        width: 8px;
        height: 8px;
        background-color: #10b981;
        border-radius: 50%;
    }

    .bullet-lightblue-light {
        display: inline-block;
        width: 8px;
        height: 8px;
        background-color: #ef4444;
        border-radius: 50%;
    }

    .question-nav-ribbon-light {
        display: flex;
        gap: 6px;
    }

    .nav-circle-light {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        border: 1px solid rgba(0, 0, 0, 0.08);
        font-size: 13px;
        font-weight: 600;
        color: #64748b;
        cursor: pointer;
        background: transparent;
    }

    .nav-circle-light.active {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: #ffffff !important;
        box-shadow: 0 2px 8px rgba(13, 110, 253, 0.2);
    }

    .footer-right-light {
        display: flex;
        flex-direction: column;
        gap: 8px;
        width: 150px;
    }

    .btn-submit-light {
        background-color: #0d6efd;
        border: 1px solid #0d6efd;
        color: #ffffff !important;
        font-weight: 700;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 14px;
        width: 100%;
        transition: all 0.2s;
    }

    .btn-submit-light:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }

    .btn-back-btn-light {
        background-color: transparent;
        border: 1px solid rgba(0, 0, 0, 0.12);
        color: #64748b;
        font-weight: 700;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 14px;
        width: 100%;
        transition: all 0.2s;
    }

    .btn-back-btn-light:hover {
        background-color: rgba(0, 0, 0, 0.02);
        color: #1e293b;
    }

    .writing-sidebar-right-light {
        background-color: #f8fafc !important;
        border-left: 1px solid rgba(0, 0, 0, 0.08) !important;
    }

    .writing-sidebar-right-light button {
        opacity: 0.6;
        transition: opacity 0.2s, background-color 0.2s;
        border-radius: 6px;
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b !important;
    }
    .writing-sidebar-right-light button:hover {
        opacity: 1;
        background-color: rgba(13, 110, 253, 0.08);
        color: #0d6efd !important;
    }
    #writingPromptPane img {
        max-width: 90%;
        height: auto;
        border-radius: 8px;
        border: 1px solid rgba(0, 0, 0, 0.08);
        margin: 15px auto;
        display: block;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    /* Responsive adjustments for writing workspace */
    @media (max-width: 992px) {
        .writing-body-light {
            flex-direction: column;
            overflow-y: auto;
        }
        .writing-pane-light {
            flex: none;
            height: 50vh;
            min-height: 400px;
        }
        .writing-divider-light {
            display: none !important;
        }
        .writing-sidebar-right-light {
            flex-direction: row !important;
            width: 100% !important;
            height: auto !important;
            padding: 10px !important;
            justify-content: center;
            border-left: none !important;
            border-top: 1px solid rgba(0, 0, 0, 0.08) !important;
        }
        .footer-left-light .d-flex.gap-3 {
            flex-direction: column;
            gap: 4px !important;
            align-items: flex-start !important;
        }
    }

    .fs-13 {
        font-size: 13px;
    }

    /* Responsive Writing Workspace */
    @media (max-width: 768px) {
        .writing-body-light {
            flex-direction: column;
            height: auto;
        }
        .writing-pane-light {
            height: 350px;
            flex: none;
        }
        .writing-footer-light {
            flex-direction: column;
            height: auto;
            gap: 12px;
            padding: 12px 20px;
        }
        .footer-right-light {
            width: 100%;
        }
    }

    /* Responsive Design */
    @media (max-width: 991px) {
        .chat-container-wrapper {
            flex-direction: column;
            margin: 20px 10px;
            min-height: auto;
        }
        .chat-sidebar {
            width: 100%;
            border-right: none;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            padding: 20px;
        }
        .skill-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .skill-card {
            margin-bottom: 0;
        }
    }

    @keyframes pulse-anim {
        0%, 100% { opacity: 0.6; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.15); }
    }
    .animate-pulse {
        animation: pulse-anim 2s infinite ease-in-out;
        display: inline-block;
    }

    /* Textarea container override inside writing card body */
    .writing-card-body-light > div {
        background: #f8fafc !important;
    }

    /* Modal Theme Overrides to Match Light Mode */
    .modal-content.bg-dark {
        background-color: #ffffff !important;
        color: #1e293b !important;
        border-color: rgba(13, 110, 253, 0.2) !important;
    }
    
    .modal-header .btn-close-white {
        filter: invert(1) !important; /* Invert white close button to make it dark/visible */
    }
    
    .modal-body .bg-black {
        background-color: #f8fafc !important;
        color: #1e293b !important;
        border-color: rgba(0, 0, 0, 0.08) !important;
    }
    
    .modal-body .text-light {
        color: #334155 !important;
    }
    
    .modal-body textarea.bg-black {
        background-color: #ffffff !important;
        color: #0f172a !important;
        border: 1px solid rgba(0, 0, 0, 0.12) !important;
    }
    
    .modal-body textarea::placeholder {
        color: #94a3b8 !important;
    }
    
    .modal-content .text-primary {
        color: #0d6efd !important;
    }
    
    .modal-content .text-secondary {
        color: #64748b !important;
    }
    
    .modal-content .border-secondary-subtle {
        border-color: rgba(0, 0, 0, 0.08) !important;
    }
    
    .modal-footer .btn-secondary {
        background-color: #f1f5f9 !important;
        border: 1px solid rgba(0, 0, 0, 0.12) !important;
        color: #475569 !important;
    }
    
    .modal-footer .btn-secondary:hover {
        background-color: #e2e8f0 !important;
    }
    
    .modal-footer .btn-primary {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        color: #ffffff !important;
    }
    
    .modal-footer .btn-primary:hover {
        background-color: #0b5ed7 !important;
    }
    
    #btnSubmitAnswer, #btnResumeAttempt {
        color: #ffffff !important;
    }

    /* ================= AI PRACTICE DARK MODE OVERRIDES ================= */
    [data-bs-theme="dark"] .chat-container-wrapper {
        background: #0d0d0d !important;
        border-color: #222222 !important;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5) !important;
    }

    [data-bs-theme="dark"] .chat-sidebar {
        background: #111111 !important;
        border-right-color: #222222 !important;
    }

    [data-bs-theme="dark"] .sidebar-header h4 {
        color: #ffffff !important;
    }

    [data-bs-theme="dark"] .sidebar-header .status {
        color: #94a3b8 !important;
    }

    [data-bs-theme="dark"] .skill-card {
        background: #1a1a1a !important;
        border-color: #222222 !important;
    }

    [data-bs-theme="dark"] .skill-card:hover {
        background: #262626 !important;
        border-color: #3b82f6 !important;
    }

    [data-bs-theme="dark"] .skill-info h5 {
        color: #ffffff !important;
    }

    [data-bs-theme="dark"] .skill-info p {
        color: #94a3b8 !important;
    }

    [data-bs-theme="dark"] .chat-main {
        background: #0d0d0d !important;
    }

    [data-bs-theme="dark"] .welcome-banner h3 {
        color: #ffffff !important;
    }

    [data-bs-theme="dark"] .welcome-banner p {
        color: #cbd5e1 !important;
    }

    [data-bs-theme="dark"] .history-item {
        background: #1a1a1a !important;
        border-color: #222222 !important;
    }

    [data-bs-theme="dark"] .history-item:hover {
        background: #262626 !important;
        border-color: #3b82f6 !important;
    }

    [data-bs-theme="dark"] .history-item .text-secondary {
        color: #94a3b8 !important;
    }

    [data-bs-theme="dark"] .chat-sidebar h5.text-white {
        color: #ffffff !important;
    }

    [data-bs-theme="dark"] .chat-sidebar .sidebar-bottom small {
        color: #94a3b8 !important;
    }

    [data-bs-theme="dark"] .chat-sidebar .sidebar-bottom p {
        color: #cbd5e1 !important;
    }

    [data-bs-theme="dark"] .message.assistant {
        background: #1a1a1a !important;
        color: #cbd5e1 !important;
        border-color: #222222 !important;
    }

    [data-bs-theme="dark"] .message.assistant h4 {
        color: #ffffff !important;
    }

    [data-bs-theme="dark"] .message.assistant details {
        background: #111111 !important;
        border-color: #3b82f6 !important;
    }

    [data-bs-theme="dark"] .chat-input-area {
        background: #111111 !important;
        border-top-color: #222222 !important;
    }

    [data-bs-theme="dark"] .chat-input {
        background: #1a1a1a !important;
        border-color: #222222 !important;
        color: #ffffff !important;
    }

    [data-bs-theme="dark"] .typing-indicator {
        background: #1a1a1a !important;
        border-color: #222222 !important;
    }

    /* Reading Workspace Dark Mode */
    [data-bs-theme="dark"] .reading-workspace {
        background: #0d0d0d !important;
    }

    [data-bs-theme="dark"] .reading-header {
        background: #111111 !important;
        border-bottom-color: #222222 !important;
    }

    [data-bs-theme="dark"] .reading-body {
        background: #0d0d0d !important;
    }

    [data-bs-theme="dark"] .reading-left-nav {
        background: #111111 !important;
        border-right-color: #222222 !important;
    }

    [data-bs-theme="dark"] .reading-nav-title {
        border-bottom-color: #222222 !important;
    }

    [data-bs-theme="dark"] .reading-sec-item {
        background: #1a1a1a !important;
        border-color: #222222 !important;
    }

    [data-bs-theme="dark"] .reading-sec-item:hover {
        background: #262626 !important;
    }

    [data-bs-theme="dark"] .reading-sec-item.active {
        background: rgba(13, 110, 253, 0.15) !important;
        border-color: #0d6efd !important;
    }

    [data-bs-theme="dark"] .reading-sec-item .sec-name {
        color: #ffffff !important;
    }

    [data-bs-theme="dark"] .reading-passage-pane {
        color: #cbd5e1 !important;
        border-right-color: #222222 !important;
    }

    [data-bs-theme="dark"] .reading-questions-pane {
        background: #111111 !important;
    }

    [data-bs-theme="dark"] .reading-question-card {
        background: #1a1a1a !important;
        border-color: #222222 !important;
    }

    [data-bs-theme="dark"] .reading-question-card:hover {
        border-color: rgba(13, 110, 253, 0.3) !important;
    }

    [data-bs-theme="dark"] .reading-question-text {
        color: #ffffff !important;
    }

    [data-bs-theme="dark"] .reading-option-btn {
        background: #1a1a1a !important;
        border-color: #222222 !important;
        color: #cbd5e1 !important;
    }

    [data-bs-theme="dark"] .reading-option-btn:hover {
        background: #262626 !important;
        color: #3b82f6 !important;
        border-color: #3b82f6 !important;
    }

    [data-bs-theme="dark"] .reading-option-btn.active {
        background: #0d6efd !important;
        color: #ffffff !important;
        border-color: #0d6efd !important;
    }

    [data-bs-theme="dark"] .reading-input-text {
        background: #1a1a1a !important;
        border-color: #222222 !important;
        color: #ffffff !important;
    }

    [data-bs-theme="dark"] .reading-footer {
        background: #111111 !important;
        border-top-color: #222222 !important;
    }

    [data-bs-theme="dark"] .reading-footer .text-white {
        color: #ffffff !important;
    }

    [data-bs-theme="dark"] .reading-footer .text-white-50 {
        color: #94a3b8 !important;
    }

    [data-bs-theme="dark"] .question-nav-dot {
        background: #1a1a1a !important;
        border-color: #222222 !important;
        color: #94a3b8 !important;
    }

    [data-bs-theme="dark"] .question-nav-dot:hover {
        background: #262626 !important;
        color: #3b82f6 !important;
        border-color: #3b82f6 !important;
    }

    [data-bs-theme="dark"] .question-nav-dot.active {
        border-color: #ffffff !important;
        color: #ffffff !important;
    }

    /* Writing Workspace Dark Mode */
    [data-bs-theme="dark"] .writing-workspace-light {
        background-color: #0d0d0d !important;
        color: #cbd5e1 !important;
    }

    [data-bs-theme="dark"] .writing-header-light {
        background: #111111 !important;
        border-bottom-color: #222222 !important;
    }

    [data-bs-theme="dark"] .writing-timer-light {
        background: #1a1a1a !important;
        border-color: #3b82f6 !important;
        color: #3b82f6 !important;
        box-shadow: 0 2px 10px rgba(0,0,0,0.5) !important;
    }

    [data-bs-theme="dark"] .writing-body-light {
        background-color: #0d0d0d !important;
    }

    [data-bs-theme="dark"] .writing-card-light {
        background: #111111 !important;
        border-color: #222222 !important;
    }

    [data-bs-theme="dark"] .writing-card-body-light {
        color: #cbd5e1 !important;
    }

    [data-bs-theme="dark"] .writing-card-body-light > div {
        background: #1a1a1a !important;
    }

    [data-bs-theme="dark"] .writing-sidebar-right-light {
        background-color: #111111 !important;
        border-left-color: #222222 !important;
    }

    [data-bs-theme="dark"] .writing-sidebar-right-light button {
        color: #94a3b8 !important;
    }

    [data-bs-theme="dark"] .writing-sidebar-right-light button:hover {
        background-color: rgba(13, 110, 253, 0.15) !important;
        color: #3b82f6 !important;
    }

    [data-bs-theme="dark"] .writing-footer-light {
        background: #111111 !important;
        border-top-color: #222222 !important;
    }

    [data-bs-theme="dark"] .nav-circle-light {
        border-color: #222222 !important;
        color: #94a3b8 !important;
    }

    [data-bs-theme="dark"] .nav-circle-light.active {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        color: #ffffff !important;
    }

    [data-bs-theme="dark"] .btn-back-btn-light {
        border-color: #222222 !important;
        color: #94a3b8 !important;
    }

    [data-bs-theme="dark"] .btn-back-btn-light:hover {
        background-color: #1a1a1a !important;
        color: #ffffff !important;
    }

    /* Modal Dark Mode */
    [data-bs-theme="dark"] .modal-content.bg-dark {
        background-color: #0d0d0d !important;
        color: #ffffff !important;
        border-color: #222222 !important;
    }

    [data-bs-theme="dark"] .modal-header .btn-close-white {
        filter: none !important;
    }

    [data-bs-theme="dark"] .modal-body .bg-black {
        background-color: #1a1a1a !important;
        color: #ffffff !important;
        border-color: #222222 !important;
    }

    [data-bs-theme="dark"] .modal-body .text-light {
        color: #cbd5e1 !important;
    }

    [data-bs-theme="dark"] .modal-body textarea.bg-black {
        background-color: #1a1a1a !important;
        color: #ffffff !important;
        border: 1px solid #222222 !important;
    }

    /* ====================================================
       FRANCOWAY BRAND OVERRIDES (RED & NAVY ACCENTS)
       ==================================================== */
    
    /* Welcome Banner & Robot Icon */
    .welcome-banner i.logo-icon {
        color: #E31B23 !important;
        text-shadow: 0 0 20px rgba(227, 27, 35, 0.25) !important;
    }
    
    /* Skill Cards & Active highlights */
    .skill-card {
        border-color: rgba(11, 30, 67, 0.1) !important;
    }
    .skill-card:hover {
        background: rgba(227, 27, 35, 0.04) !important;
        border-color: rgba(227, 27, 35, 0.3) !important;
    }
    .skill-card.active {
        border-color: #E31B23 !important;
        background: rgba(227, 27, 35, 0.08) !important;
    }
    .skill-icon {
        background: rgba(227, 27, 35, 0.08) !important;
        color: #E31B23 !important;
    }
    
    /* Chips / Suggestion Buttons */
    .chip {
        background: rgba(227, 27, 35, 0.05) !important;
        border: 1px solid rgba(227, 27, 35, 0.15) !important;
        color: #E31B23 !important;
    }
    .chip:hover {
        background: #E31B23 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(227, 27, 35, 0.15) !important;
    }
    
    /* Chat inputs & submit button */
    .chat-container-wrapper {
        border-color: rgba(11, 30, 67, 0.15) !important;
    }
    .chat-input:focus {
        border-color: #E31B23 !important;
        box-shadow: 0 0 12px rgba(227, 27, 35, 0.15) !important;
    }
    .chat-submit-btn {
        background: linear-gradient(135deg, #E31B23, #0B1E43) !important;
    }
    .chat-submit-btn:hover {
        box-shadow: 0 0 15px rgba(227, 27, 35, 0.3) !important;
    }
    
    /* User Chat Bubbles */
    .message.user {
        background: linear-gradient(135deg, #E31B23, #0B1E43) !important;
    }
    
    /* Details & assistant elements */
    .message.assistant h3, .message.assistant details summary, .message.assistant a {
        color: #E31B23 !important;
    }
    .message.assistant details {
        border-color: rgba(227, 27, 35, 0.15) !important;
    }
    .history-item:hover {
        background: rgba(227, 27, 35, 0.04) !important;
        border-color: rgba(227, 27, 35, 0.25) !important;
    }
    .history-item .text-primary {
        color: #E31B23 !important;
    }
    
    /* Reading Workspace overrides */
    .reading-header-title, .reading-timer, .reading-timer i, .reading-nav-title, .reading-passage-pane h1, .reading-passage-pane h2, .reading-passage-pane h3, .reading-question-number {
        color: #E31B23 !important;
    }
    .reading-timer {
        background: rgba(227, 27, 35, 0.06) !important;
        border-color: rgba(227, 27, 35, 0.15) !important;
    }
    .reading-sec-item:hover {
        background: rgba(227, 27, 35, 0.04) !important;
        border-color: rgba(227, 27, 35, 0.2) !important;
    }
    .reading-sec-item.active {
        background: rgba(227, 27, 35, 0.08) !important;
        border-color: #E31B23 !important;
    }
    .reading-sec-item .sec-progress {
        color: #E31B23 !important;
        background: rgba(227, 27, 35, 0.1) !important;
    }
    .reading-question-card:hover {
        border-color: rgba(227, 27, 35, 0.2) !important;
    }
    .reading-question-number {
        background: rgba(227, 27, 35, 0.1) !important;
    }
    .reading-option-btn:hover {
        background: rgba(227, 27, 35, 0.04) !important;
        color: #E31B23 !important;
        border-color: rgba(227, 27, 35, 0.2) !important;
    }
    .reading-option-btn.active {
        background: #E31B23 !important;
        border-color: #E31B23 !important;
        box-shadow: 0 2px 8px rgba(227, 27, 35, 0.2) !important;
    }
    .reading-input-text:focus {
        border-color: #E31B23 !important;
        box-shadow: 0 0 8px rgba(227, 27, 35, 0.15) !important;
    }
    .question-nav-dot:hover {
        background: rgba(227, 27, 35, 0.05) !important;
        color: #E31B23 !important;
        border-color: rgba(227, 27, 35, 0.2) !important;
    }
    .question-nav-dot.answered {
        background: rgba(227, 27, 35, 0.1) !important;
        border-color: #E31B23 !important;
        color: #E31B23 !important;
    }
    .question-nav-dot.unanswered {
        background: rgba(227, 27, 35, 0.05) !important;
        border-color: rgba(227, 27, 35, 0.2) !important;
        color: #E31B23 !important;
    }
    
    /* Writing & Speaking Workspace overrides */
    .writing-title-text-light, .writing-timer-light, .writing-word-count-light, .btn-back-light {
        color: #E31B23 !important;
    }
    .writing-timer-light {
        border-color: rgba(227, 27, 35, 0.2) !important;
    }
    .writing-card-light {
        border-color: rgba(227, 27, 35, 0.2) !important;
    }
    .writing-textarea-container-light {
        border-color: rgba(227, 27, 35, 0.3) !important;
    }
    .icon-circle-blue-light {
        background-color: rgba(227, 27, 35, 0.1) !important;
        color: #E31B23 !important;
    }
    .icon-circle-darkblue-light {
        background-color: #E31B23 !important;
    }
    .icon-circle {
        background: rgba(227, 27, 35, 0.15) !important;
        color: #E31B23 !important;
        border-color: rgba(227, 27, 35, 0.25) !important;
    }
    .btn-primary#btnPlayListening, #writingSubmitBtn, #speakingSubmitBtn, #btnToggleSpeakingMic {
        background-color: #E31B23 !important;
        background: #E31B23 !important;
        box-shadow: 0 0 10px rgba(227, 27, 35, 0.3) !important;
    }
    .progress-bar#listeningProgressBar {
        background-color: #E31B23 !important;
    }
</style>
     <!--breadcrumb here-->
        <nav aria-label="breadcrumb" class="mb-3 ">
    <ol class="breadcrumb justify-content-end">
        
        <li class="breadcrumb-item"><a href="/dashboard">dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">AI Practice</li>
    </ol>
</nav>
<div class="container py-4">
    <!-- Chat Area Wrapper -->
    <div class="chat-container-wrapper">
   
        <!-- SIDEBAR -->
        <div class="chat-sidebar" id="chatSidebar">
            <div class="sidebar-top">
                <div class="sidebar-header">
                    <h4>Quiz</h4>
                    <div class="status">
                        <span class="status-dot"></span>
                        <span>Assistant Active</span>
                    </div>
                </div>

                <div class="skill-container">
                    <div class="skill-card" onclick="triggerPreset('Start Reading Comprehension practice immediately and generate the passage and questions wrapped in the exercise tag.')">
                        <div class="skill-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="skill-info">
                            <h5>Reading Comprehension</h5>
                            <p>Passages and reading questions</p>
                        </div>
                    </div>

                    <div class="skill-card" onclick="triggerPreset('Hello! I would like to practice Listening Comprehension.')">
                        <div class="skill-icon">
                            <i class="fas fa-headphones"></i>
                        </div>
                        <div class="skill-info">
                            <h5>Listening Comprehension</h5>
                            <p>Dialogues and listening questions</p>
                        </div>
                    </div>

                    <div class="skill-card" onclick="triggerPreset('Start Writing Practice immediately and generate the exercise prompt wrapped in the exercise tag.')">
                        <div class="skill-icon">
                            <i class="fas fa-pen-fancy"></i>
                        </div>
                        <div class="skill-info">
                            <h5>Writing Practice</h5>
                            <p>Writing prompts and essays</p>
                        </div>
                    </div>

                    <div class="skill-card" onclick="triggerPreset('Hello! I would like to practice Speaking.')">
                        <div class="skill-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="skill-info">
                            <h5>Speaking Practice</h5>
                            <p>Oral discussion topics</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <h5 class="text-white fs-14 mb-3" style="font-family: 'Fraunces', serif;">My Practice History</h5>
                    <div id="practiceHistoryList" class="d-flex flex-column gap-2" style="max-height: 220px; overflow-y: auto; padding-right: 5px;">
                        @forelse($history as $attempt)
                            <div class="history-item p-2 rounded border border-secondary-subtle" id="history-item-{{ $attempt->id }}" style="background: rgba(255,255,255,0.02); cursor: pointer;" onclick="showHistoryDetail('{{ $attempt->id }}')">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-primary text-dark text-uppercase" style="font-size: 10px; padding: 2px 6px;">{{ $attempt->skill }}</span>
                                    <span class="text-primary fw-bold d-flex align-items-center gap-1" style="font-size: 12px;">
                                        @if(strtolower($attempt->score) === 'pending')
                                            <i class="fas fa-play-circle text-primary animate-pulse"></i>
                                        @endif
                                        {{ $attempt->score }}
                                    </span>
                                </div>
                                <div class="text-secondary small mt-1 text-truncate" style="font-size: 11px;">{{ $attempt->created_at->format('d M Y, h:i A') }}</div>
                            </div>
                        @empty
                            <div class="text-secondary small text-center py-2" id="noHistoryText">No practice attempts yet.</div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="sidebar-bottom d-none d-lg-block pt-4 border-top border-secondary-subtle">
                <small class="text-secondary d-block mb-1">Your Native Study Partner</small>
                <p class="text-light-50 small mb-0" style="font-size: 11px;">Powered by FrancoWay Learning Platform. All responses are tailored to official standards.</p>
            </div>
        </div>

        <!-- MAIN CHAT PANEL -->
        <div class="chat-main" id="chatMain">
            
            <!-- Welcome View (Initially Visible) -->
            <div id="welcomeView" class="welcome-banner">
                <i class="fas fa-robot logo-icon"></i>
                <h3>Improve Your Skills</h3>
                <p>Welcome to FrancoWay's Smart Study Assistant. Perfect your language skills with immediate evaluations and detailed feedback.</p>
                
                <div class="quick-chips">
                    <div class="chip" onclick="triggerPreset('Hello! I would like to practice Speaking.')">🗣️ Get a Speaking Topic</div>
                    <div class="chip" onclick="triggerPreset('Hello! I would like to practice Reading Comprehension.')">📖 Get a Reading Passage</div>
                    <div class="chip" onclick="triggerPreset('Hello! I would like to practice Listening Comprehension.')">🎧 Get a Listening Dialogue</div>
                    <div class="chip" onclick="triggerPreset('Hello! I would like to practice Writing.')">✍️ Get a Writing Task</div>
                </div>
            </div>

            <!-- Messages Stream -->
            <div id="chatMessages" class="chat-messages">
                <!-- Messages will be dynamically appended here -->
            </div>

            <!-- Typing indicator -->
            <div id="typingIndicator" class="typing-indicator">
                <span class="typing-dot"></span>
                <span class="typing-dot"></span>
                <span class="typing-dot"></span>
            </div>

            <!-- Input Box -->
            <form id="chatForm" class="chat-input-area" autocomplete="off">
                <input type="text" id="userInput" class="chat-input" placeholder="Type your message or ask for an exercise (e.g. 'Give me a reading passage')..." required>
                <button type="submit" class="chat-submit-btn">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>

        </div>

        <!-- READING WORKSPACE -->
        <div id="readingWorkspace" class="reading-workspace">
            <!-- Top Header -->
            <div class="reading-header">
                <div class="d-flex align-items-center gap-3">
                    <button type="button" class="btn btn-outline-primary btn-sm text-primary" onclick="exitReadingMode()" style="border-radius: 50px; padding: 6px 16px; background: transparent; border: 1px solid #3b82f6;">
                        <i class="fas fa-arrow-left me-1"></i> Exit Reading
                    </button>
                    <span class="reading-header-title">READING PASSAGE 1</span>
                </div>
                
                <!-- Timer -->
                <div class="reading-timer">
                    <i class="fas fa-clock"></i>
                    <span id="readingTimerClock">20:00</span>
                </div>
                
                <!-- Header Actions -->
                <div>
                    <span class="badge bg-primary text-dark px-3 py-2 fw-bold" style="border-radius: 50px;">IELTS-Style Practice</span>
                </div>
            </div>

            <!-- Main Workspace Content (3 Columns on Desktop) -->
            <div class="reading-body">
                <!-- Column 1: Left Navigation / Paragraph sections -->
                <div class="reading-left-nav">
                    <div class="reading-nav-title">Sections</div>
                    <div class="reading-sections-list" id="readingSectionsList">
                        <!-- Will be dynamically populated -->
                    </div>
                </div>

                <!-- Column 2: Reading Passage Text -->
                <div class="reading-passage-pane" id="readingPassagePane">
                    <!-- Will be dynamically populated -->
                </div>

                <!-- Column 3: Questions and Answers -->
                <div class="reading-questions-pane" id="readingQuestionsPane">
                    <!-- Will be dynamically populated -->
                </div>
            </div>

            <!-- Bottom Navigation & Submission Bar -->
            <div class="reading-footer" style="flex-direction: column; align-items: stretch; gap: 15px; padding: 20px 30px;">
                <!-- Row 1: Title & Stats -->
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <span class="fw-bold text-white fs-15" id="readingQuestionsTitle">Questions 1-3</span>
                    <div class="d-flex gap-4 align-items-center text-white-50 fs-13">
                        <div class="d-flex align-items-center gap-2">
                            <span style="width: 10px; height: 10px; border-radius: 50%; background: #0d6efd; display: inline-block;"></span>
                            <span id="statsAnswered">0 Answered</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span style="width: 10px; height: 10px; border-radius: 50%; background: #60a5fa; display: inline-block;"></span>
                            <span id="statsUnanswered">0 Unanswered</span>
                        </div>
                    </div>
                </div>
                <!-- Row 2: Ribbon and Submit button -->
                <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
                    <div class="question-nav-ribbon" id="questionNavRibbon" style="margin-bottom: 0;">
                        <!-- Will be populated dynamically -->
                    </div>
                    <button type="submit" id="readingSubmitBtn" class="btn btn-primary text-dark fw-bold px-4 py-2" onclick="submitReadingAnswers()" style="border-radius: 50px; min-width: 140px;">
                        <i class="fas fa-check-circle me-1"></i> Submit Test
                    </button>
                </div>
            </div>
        </div> <!-- End readingWorkspace -->

        <!-- WRITING WORKSPACE (LIGHT THEME LIKE THE IMAGE) -->
        <div id="writingWorkspace" class="writing-workspace-light">

            <!-- Main Workspace Body (Occupies full height) -->
            <div class="writing-body-light d-flex" style="flex: 1; overflow: hidden; position: relative;">
                <!-- Left Column: Question Card -->
                <div class="writing-pane-light" style="flex: 1; padding: 16px; overflow: hidden;">
                    <div class="writing-card-light">
                        <div class="writing-card-header-light">
                            <div class="d-flex align-items-center gap-2">
                                <span class="icon-circle-blue-light"><i class="fas fa-question text-white" style="font-size: 11px;"></i></span>
                                <span class="fw-bold text-white" style="font-size: 14px;" id="writingHeaderTitle">WRITING TASK 1</span>
                            </div>
                        </div>
                        <div class="writing-card-body-light" id="writingPromptPane" style="flex: 1; padding: 20px; overflow-y: auto; text-align: left;">
                            <!-- Question text and images will load here -->
                        </div>
                    </div>
                </div>

                <!-- Right Column: Answer Card -->
                <div class="writing-pane-light" style="flex: 1; padding: 16px; overflow: hidden;">
                    <div class="writing-card-light">
                        <div class="writing-card-header-light">
                            <div class="d-flex align-items-center gap-2">
                                <span class="icon-circle-darkblue-light"><i class="fas fa-keyboard text-white" style="font-size: 11px;"></i></span>
                                <span class="fw-bold text-white" style="font-size: 14px;">Your answer:</span>
                            </div>
                            <div class="d-flex align-items-center gap-2" style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3); padding: 4px 12px; border-radius: 15px; font-family: monospace; font-size: 13px; color: #3b82f6; font-weight: 700;">
                                <i class="far fa-clock"></i>
                                <span id="writingTimerClock">00:40:00</span>
                            </div>
                        </div>
                        <div class="writing-card-body-light d-flex flex-column" style="flex: 1; padding: 20px; overflow: hidden;">
                            <div style="flex: 1; height: 100%; width: 100%; display: flex; flex-direction: column; border: 1px dashed rgba(59, 130, 246, 0.3); border-radius: 8px; padding: 12px; background: rgba(0, 0, 0, 0.4);">
                                <textarea id="writingTextarea" placeholder="Enter your answer here and click Submit to see sample answer and score. Do not leave answer blank and write more than 500 words." oninput="updateWritingWordCount()" style="width: 100%; height: 100% !important; flex: 1; background-color: transparent !important; color: #ffffff !important; border: none !important; outline: none !important; resize: none; box-shadow: none !important; font-size: 14px; line-height: 1.6;"></textarea>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="text-white-50" style="font-size: 13px;">
                                    <span id="writingWordCount">Word count: 0</span>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn" onclick="exitWritingMode()" style="border: 1px solid rgba(59, 130, 246, 0.4); color: #3b82f6; background: transparent; border-radius: 20px; font-weight: 600; padding: 6px 16px; font-size: 12px; transition: all 0.2s;">Back</button>
                                    <button type="button" id="writingSubmitBtn" class="btn" onclick="submitWritingAnswer()" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: #000; border: none; border-radius: 20px; font-weight: 700; padding: 6px 20px; font-size: 12px; box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3); transition: all 0.2s;">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SPEAKING WORKSPACE -->
        <div id="speakingWorkspace" class="writing-workspace-light" style="display: none;">
            <!-- Main Workspace Body (Occupies full height) -->
            <div class="writing-body-light d-flex" style="flex: 1; overflow: hidden; position: relative;">
                <!-- Left Column: Question Card -->
                <div class="writing-pane-light" style="flex: 1; padding: 16px; overflow: hidden;">
                    <div class="writing-card-light">
                        <div class="writing-card-header-light">
                            <div class="d-flex align-items-center gap-2">
                                <span class="icon-circle-blue-light"><i class="fas fa-comment-dots text-white" style="font-size: 11px;"></i></span>
                                <span class="fw-bold text-white" style="font-size: 14px;" id="speakingHeaderTitle">SPEAKING CUE CARD</span>
                            </div>
                        </div>
                        <div class="writing-card-body-light" id="speakingPromptPane" style="flex: 1; padding: 20px; overflow-y: auto; text-align: left;">
                            <!-- Speaking topic/cue card details will load here -->
                        </div>
                    </div>
                </div>

                <!-- Right Column: Speech Recognition / Recording Panel -->
                <div class="writing-pane-light" style="flex: 1; padding: 16px; overflow: hidden;">
                    <div class="writing-card-light">
                        <div class="writing-card-header-light">
                            <div class="d-flex align-items-center gap-2">
                                <span class="icon-circle-darkblue-light"><i class="fas fa-microphone text-white" style="font-size: 11px;"></i></span>
                                <span class="fw-bold text-white" style="font-size: 14px;">Your Speech Transcript:</span>
                            </div>
                            <div class="d-flex align-items-center gap-2" style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3); padding: 4px 12px; border-radius: 15px; font-family: monospace; font-size: 13px; color: #3b82f6; font-weight: 700;">
                                <i class="far fa-clock"></i>
                                <span id="speakingTimerClock">00:02:00</span>
                            </div>
                        </div>
                        <div class="writing-card-body-light d-flex flex-column" style="flex: 1; padding: 20px; overflow: hidden;">
                            
                            <!-- Recording controls banner -->
                            <div class="d-flex align-items-center justify-content-between p-3 mb-3 rounded" style="background: #f1f5f9; border: 1px solid rgba(13, 110, 253, 0.1);">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="recording-status-dot" id="speakingMicStatusDot" style="width: 10px; height: 10px; border-radius: 50%; background: #64748b; display: inline-block;"></span>
                                    <span class="fw-semibold text-secondary small" id="speakingMicStatusText">Status: Microphone Ready</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <label for="speakingLanguageSelect" class="text-secondary small fw-bold mb-0">Lang:</label>
                                    <select id="speakingLanguageSelect" class="form-select form-select-sm" style="width: 110px; border-radius: 20px; font-size: 11px; padding: 2px 10px; height: 26px; border: 1px solid rgba(59, 130, 246, 0.3); background-color: #ffffff; color: #333;" onchange="updateSpeakingLanguage()">
                                        <option value="en-US" selected>English 🇺🇸</option>
                                        <option value="fr-FR">French 🇫🇷</option>
                                    </select>
                                </div>
                                <button type="button" id="btnToggleSpeakingMic" class="btn btn-sm btn-primary d-flex align-items-center gap-1" onclick="toggleSpeakingRecognition()" style="border-radius: 20px; font-size: 12px; background-color: #3b82f6 !important; border: none; padding: 6px 16px; color: #fff !important; font-weight: bold;">
                                    <i class="fas fa-microphone"></i> Start Recording
                                </button>
                            </div>

                            <!-- Real-time transcription area -->
                            <div style="flex: 1; height: 100%; width: 100%; display: flex; flex-direction: column; border: 1px dashed rgba(59, 130, 246, 0.3); border-radius: 8px; padding: 12px; background: rgba(0, 0, 0, 0.4);">
                                <textarea id="speakingTextarea" placeholder="Click 'Start Recording' and start speaking. Your spoken words will be transcribed here in real-time. You can edit the text manually to correct any spelling." oninput="updateSpeakingWordCount()" style="width: 100%; height: 100% !important; flex: 1; background-color: transparent !important; color: #ffffff !important; border: none !important; outline: none !important; resize: none; box-shadow: none !important; font-size: 14px; line-height: 1.6;"></textarea>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="text-white-50" style="font-size: 13px;">
                                    <span id="speakingWordCount">Word count: 0</span>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn" onclick="exitSpeakingMode()" style="border: 1px solid rgba(59, 130, 246, 0.4); color: #3b82f6; background: transparent; border-radius: 20px; font-weight: 600; padding: 6px 16px; font-size: 12px; transition: all 0.2s;">Back</button>
                                    <button type="button" id="speakingSubmitBtn" class="btn" onclick="submitSpeakingAnswer()" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: #000; border: none; border-radius: 20px; font-weight: 700; padding: 6px 20px; font-size: 12px; box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3); transition: all 0.2s;">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Practice History Detail Modal -->
<div class="modal fade" id="historyModal" tabindex="-1" aria-labelledby="historyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark border border-primary text-white" style="border-radius: 16px;">
            <div class="modal-header border-bottom border-secondary-subtle">
                <h5 class="modal-title text-primary" id="historyModalLabel" style="font-family: 'Fraunces', serif;">Practice Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 border-end border-secondary-subtle mb-3 mb-md-0">
                        <h6 class="text-primary mb-2">Practice Prompt / Question:</h6>
                        <div class="p-3 bg-black rounded border border-secondary-subtle overflow-auto text-light" id="modalQuestion" style="max-height: 250px; font-size: 14px; white-space: pre-wrap;"></div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary mb-2">Your Answer:</h6>
                        <div class="p-3 bg-black rounded border border-secondary-subtle overflow-auto text-light" id="modalAnswer" style="max-height: 250px; font-size: 14px; white-space: pre-wrap;"></div>
                    </div>
                </div>
                <hr class="border-secondary-subtle my-3">
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="text-primary mb-0">Tutor Feedback & Evaluation:</h6>
                        <span class="badge bg-primary text-dark fs-14 px-3 py-2" id="modalScore" style="font-size: 14px;"></span>
                    </div>
                    <div class="p-3 rounded bg-white-5 border border-secondary-subtle text-light" id="modalFeedback" style="background: rgba(255,255,255,0.03); font-size: 14px; line-height: 1.6;"></div>
                </div>
            </div>
            <div class="modal-footer border-top border-secondary-subtle" id="historyModalFooter" style="display: none;">
                <button type="button" class="btn btn-secondary text-white px-4" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary text-dark fw-bold px-4" id="btnResumeAttempt">
                    <i class="fas fa-play me-1"></i> Resume Practice
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Submit Answer Modal -->
<div class="modal fade" id="submitAnswerModal" tabindex="-1" aria-labelledby="submitAnswerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark border border-primary text-white" style="border-radius: 16px;">
            <div class="modal-header border-bottom border-secondary-subtle">
                <h5 class="modal-title text-primary" id="submitAnswerModalLabel" style="font-family: 'Fraunces', serif;">Submit Practice Answer</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="submitAnswerForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-primary fw-semibold">Current Practice Task Details:</label>
                        <div class="p-3 bg-black rounded border border-secondary-subtle overflow-auto text-light small" id="submitModalTaskDescription" style="max-height: 150px; white-space: pre-wrap;"></div>
                    </div>
                    <div class="mb-3">
                        <label for="practiceUserAnswer" class="form-label text-primary fw-semibold">Your Answer / Response:</label>
                        <textarea class="form-control bg-black text-white border-secondary-subtle" id="practiceUserAnswer" rows="8" placeholder="Type your answers here (e.g. 1. True, 2. False) or paste your essay response..." required style="resize: vertical;"></textarea>
                        <div class="form-text text-secondary mt-2">Make sure to format your answers clearly so the AI evaluator can grade them accurately.</div>
                    </div>
                </div>
                <div class="modal-footer border-top border-secondary-subtle">
                    <button type="button" class="btn btn-secondary text-white px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary text-dark fw-bold px-4" id="btnSubmitAnswer">
                        <i class="fas fa-paper-plane me-1"></i> Submit for AI Score
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reading Test Results Modal -->
<div class="modal fade" id="readingResultsModal" tabindex="-1" aria-labelledby="readingResultsModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark border border-primary text-white" style="border-radius: 16px;">
            <div class="modal-header border-bottom border-secondary-subtle">
                <h5 class="modal-title text-primary" id="readingResultsModalLabel" style="font-family: 'Fraunces', serif;">
                    <i class="fas fa-poll-h me-2"></i> Reading Evaluation Completed
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" onclick="exitReadingMode()"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div class="display-4 text-primary fw-bold mb-2" id="readingResultScore">3/3</div>
                    <p class="text-secondary">Your AI Estimated Score</p>
                </div>
                
                <h6 class="text-primary mb-2">Feedback and Detailed Correction:</h6>
                <div class="p-3 rounded bg-white-5 border border-secondary-subtle text-light overflow-auto" id="readingResultFeedback" style="background: rgba(255,255,255,0.03); font-size: 14px; line-height: 1.6; max-height: 350px;">
                    <!-- Feedback markdown parsed html will go here -->
                </div>
            </div>
            <div class="modal-footer border-top border-secondary-subtle">
                <button type="button" class="btn btn-primary text-dark fw-bold px-4" data-bs-dismiss="modal" onclick="exitReadingMode()">
                    Back to Quiz
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Load Marked Markdown Parser via CDN -->
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

<script>
    const chatForm = document.getElementById('chatForm');
    const userInput = document.getElementById('userInput');
    const chatMessages = document.getElementById('chatMessages');
    const welcomeView = document.getElementById('welcomeView');
    const typingIndicator = document.getElementById('typingIndicator');
    
    // Reading Workspace Globals
    let readingTimerInterval = null;
    let readingTimeRemaining = 1200; // 20 minutes in seconds

    // Conversation History Array
    let chatHistory = [];
    const csrfToken = "{{ csrf_token() }}";

    // Set configuration for Marked parser
    marked.setOptions({
        breaks: true,
        gfm: true
    });

    // Form submit handler
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const messageText = userInput.value.trim();
        if(!messageText) return;

        sendMessage(messageText);
    });

    // Preset button trigger
    function triggerPreset(presetText) {
        sendMessage(presetText, true);
    }

    // Send Message function
    function sendMessage(messageText, isPreset = false) {
        // Hide welcome view if visible
        if(welcomeView.style.display !== 'none') {
            welcomeView.style.display = 'none';
            chatMessages.style.display = 'flex';
        }

        // Add user message to UI
        if (!isPreset) {
            appendMessage(messageText, 'user');
        }
        
        // Clear input field
        userInput.value = '';

        // Show typing indicator
        showLoader();

        // Send AJAX Post request to Laravel
        fetch("{{ route('ai.chat') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                message: messageText,
                history: chatHistory
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            hideLoader();
            if(data.reply) {
                if (data.active_skill === 'reading' || data.active_skill === 'listening') {
                    initReadingWorkspace(data.reply, data.active_skill);
                } else if (data.active_skill === 'writing') {
                    initWritingWorkspace(data.reply);
                } else if (data.active_skill === 'speaking') {
                    initSpeakingWorkspace(data.reply);
                } else {
                    // Add assistant response to UI
                    appendMessage(data.reply, 'assistant', data.active_skill);
                }
                
                // Update history
                chatHistory.push({ role: 'user', content: messageText });
                chatHistory.push({ role: 'assistant', content: data.reply });

                // Cap history length to keep context clean (last 10 messages)
                if (chatHistory.length > 10) {
                    chatHistory.shift();
                    chatHistory.shift();
                }

                // If attempt was automatically saved from quiz input
                if (data.attempt) {
                    addAttemptToHistorySidebar(data.attempt);
                    historyData[data.attempt.id] = {
                        id: data.attempt.id,
                        skill: data.attempt.skill.toLowerCase(),
                        score: data.attempt.score,
                        question: data.attempt.question,
                        user_answer: data.attempt.user_answer,
                        feedback: data.attempt.feedback
                    };
                }
            } else {
                appendMessage("Sorry, I encountered an issue parsing the request. Please try again.", 'assistant');
            }
        })
        .catch(error => {
            hideLoader();
            console.error('Error:', error);
            appendMessage("I couldn't reach the server. Please check your internet connection and try again.", 'assistant');
        });
    }

    // Append Message bubble to DOM
    function appendMessage(text, sender, activeSkill = null) {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message', sender);
        
        if (sender === 'assistant') {
            // Parse Markdown for assistant responses
            let parsedHtml = marked.parse(text);
            
            // Only show audio script player for listening tasks (matches 'listening' or '🎧')
            let isListening = text.toLowerCase().includes('listening') || text.includes('🎧');
            
            // Check if this is a practice task
            let isPracticeTask = !!activeSkill || text.includes('Practice:') || text.includes('Task Prompt:') || text.includes('Cue Card') || text.includes('passage') || text.includes('questions') || text.includes('exercise');
            
            // Exclude Reading and Writing from chat-based submission actions (handled inside their workspaces)
            let lowerSkill = (activeSkill || '').toLowerCase();
            if (lowerSkill === 'reading' || lowerSkill === 'writing' || text.toLowerCase().includes('reading comprehension') || text.toLowerCase().includes('writing task')) {
                isPracticeTask = false;
            }
            
            let actionButtons = '';
            
            if (isListening) {
                actionButtons += `
                    <button type="button" class="btn btn-sm btn-link text-primary p-0 text-decoration-none d-flex align-items-center gap-1" onclick="speakText(this)" style="font-size: 13px;">
                        <i class="fas fa-volume-up"></i> Listen to Audio Script
                    </button>
                    <button type="button" class="btn btn-sm btn-link text-secondary p-0 text-decoration-none d-flex align-items-center gap-1 stop-audio-btn d-none" onclick="stopSpeech(this)" style="font-size: 13px;">
                        <i class="fas fa-stop-circle"></i> Stop
                    </button>
                `;
            }
            
            if (isPracticeTask) {
                if (actionButtons) actionButtons += '<span class="text-secondary mx-1">|</span>';
                let skillAttr = activeSkill ? `data-skill="${activeSkill}"` : '';
                actionButtons += `
                    <button type="button" class="btn btn-sm btn-link text-primary p-0 text-decoration-none d-flex align-items-center gap-1 btn-submit-eval" ${skillAttr} onclick="openSubmitModal(this)" style="font-size: 13px;">
                        <i class="fas fa-edit"></i> Submit Answer for Evaluation
                    </button>
                `;
            }
            
            if (actionButtons) {
                messageDiv.innerHTML = `
                    <div class="message-content">${parsedHtml}</div>
                    <div class="message-actions mt-2 pt-2 border-top border-secondary-subtle d-flex align-items-center gap-2">
                        ${actionButtons}
                    </div>
                `;
            } else {
                messageDiv.innerHTML = `<div class="message-content">${parsedHtml}</div>`;
            }
        } else {
            // Escape HTML for user input to prevent XSS
            messageDiv.textContent = text;
        }

        chatMessages.appendChild(messageDiv);
        scrollChatToBottom();
    }

    let currentUtterance = null;

    function speakText(button) {
        // Stop any currently speaking voice
        window.speechSynthesis.cancel();
        
        // Find the message-content div
        const messageDiv = button.closest('.message');
        const contentDiv = messageDiv.querySelector('.message-content');
        
        // Extract text, but clean it up slightly
        let textToSpeak = contentDiv.innerText;
        
        // If there are details or answers inside, let's remove them from the spoken text so it doesn't read out answers immediately
        const details = contentDiv.querySelectorAll('details');
        details.forEach(detail => {
            textToSpeak = textToSpeak.replace(detail.innerText, '');
        });

        // Initialize SpeechSynthesisUtterance
        currentUtterance = new SpeechSynthesisUtterance(textToSpeak);
        
        // Choose a premium sounding voice if possible (US English or British English)
        const voices = window.speechSynthesis.getVoices();
        const englishVoice = voices.find(voice => voice.lang.includes('en-GB') || voice.lang.includes('en-US')) || voices.find(voice => voice.lang.startsWith('en'));
        if (englishVoice) {
            currentUtterance.voice = englishVoice;
        }
        
        currentUtterance.rate = 0.95; // Slightly slower for better clarity during study
        
        // Toggle the buttons state
        const stopBtn = messageDiv.querySelector('.stop-audio-btn');
        stopBtn.classList.remove('d-none');
        button.innerHTML = `<i class="fas fa-spinner fa-spin"></i> Playing...`;
        
        currentUtterance.onend = function() {
            button.innerHTML = `<i class="fas fa-volume-up"></i> Listen to Audio Script`;
            stopBtn.classList.add('d-none');
        };

        currentUtterance.onerror = function() {
            button.innerHTML = `<i class="fas fa-volume-up"></i> Listen to Audio Script`;
            stopBtn.classList.add('d-none');
        };

        window.speechSynthesis.speak(currentUtterance);
    }

    function stopSpeech(button) {
        window.speechSynthesis.cancel();
        const messageDiv = button.closest('.message');
        const playBtn = messageDiv.querySelector('button[onclick="speakText(this)"]');
        playBtn.innerHTML = `<i class="fas fa-volume-up"></i> Listen to Audio Script`;
        button.classList.add('d-none');
    }

    // Scroll to the bottom of the message area
    function scrollChatToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Show Typing Loader
    function showLoader() {
        typingIndicator.style.display = 'block';
        scrollChatToBottom();
    }

    // Hide Typing Loader
    function hideLoader() {
        typingIndicator.style.display = 'none';
    }

    // --- Practice History & Evaluation Mechanics ---

    const historyData = @json($history->keyBy('id'));

    function showHistoryDetail(id) {
        const attempt = historyData[id];
        if (!attempt) return;
        
        // If it is a reading, writing, speaking or listening exercise and is pending, open the interactive workspace layout directly
        if (attempt.skill && (attempt.skill.toLowerCase() === 'reading' || attempt.skill.toLowerCase() === 'writing' || attempt.skill.toLowerCase() === 'listening' || attempt.skill.toLowerCase() === 'speaking') && attempt.score && attempt.score.toLowerCase() === 'pending') {
            resumePracticeAttempt(attempt.id);
            return;
        }
        
        document.getElementById('modalQuestion').textContent = attempt.question;
        document.getElementById('modalAnswer').textContent = attempt.user_answer || 'No answer submitted yet.';
        document.getElementById('modalScore').textContent = 'Score: ' + attempt.score;
        
        // Parse markdown feedback if marked library is present
        document.getElementById('modalFeedback').innerHTML = typeof marked !== 'undefined' ? marked.parse(attempt.feedback || '') : (attempt.feedback || '');
        
        const footer = document.getElementById('historyModalFooter');
        if (attempt.score.toLowerCase() === 'pending') {
            footer.style.display = 'flex';
            document.getElementById('btnResumeAttempt').onclick = function() {
                resumePracticeAttempt(attempt.id);
            };
        } else {
            footer.style.display = 'none';
        }
        
        const modal = new bootstrap.Modal(document.getElementById('historyModal'));
        modal.show();
    }

    function resumePracticeAttempt(id) {
        const historyModalEl = document.getElementById('historyModal');
        const historyModalInstance = bootstrap.Modal.getInstance(historyModalEl);
        if (historyModalInstance) {
            historyModalInstance.hide();
        }
        
        showLoader();
        
        fetch("{{ route('ai.chat') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                message: 'resume_attempt',
                attempt_id: id
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Server error');
            }
            return response.json();
        })
        .then(data => {
            hideLoader();
            if (data.success) {
                const skill = data.skill.toLowerCase();
                if (skill === 'reading' || skill === 'listening') {
                    initReadingWorkspace(data.question, skill);
                } else if (skill === 'writing') {
                    initWritingWorkspace(data.question);
                } else if (skill === 'speaking') {
                    initSpeakingWorkspace(data.question);
                } else {
                    document.getElementById('submitModalTaskDescription').textContent = data.question;
                    document.getElementById('practiceUserAnswer').value = '';
                    const submitModal = new bootstrap.Modal(document.getElementById('submitAnswerModal'));
                    submitModal.show();
                }
            } else {
                alert("Failed to resume practice: " + (data.error || 'Unknown error'));
            }
        })
        .catch(error => {
            hideLoader();
            console.error('Error:', error);
            alert("Error resuming practice: " + error.message);
        });
    }

    function openSubmitModal(button) {
        const skill = button.getAttribute('data-skill');
        const messageDiv = button.closest('.message');
        const contentDiv = messageDiv.querySelector('.message-content');
        
        if (skill && skill.toLowerCase() === 'writing') {
            initWritingWorkspace(contentDiv.innerHTML);
            return;
        }
        if (skill && skill.toLowerCase() === 'speaking') {
            initSpeakingWorkspace(contentDiv.innerHTML);
            return;
        }
        
        // Populate modal description
        document.getElementById('submitModalTaskDescription').textContent = contentDiv.innerText;
        document.getElementById('practiceUserAnswer').value = '';
        
        // Open modal
        const submitModal = new bootstrap.Modal(document.getElementById('submitAnswerModal'));
        submitModal.show();
    }

    function addAttemptToHistorySidebar(attempt) {
        const list = document.getElementById('practiceHistoryList');
        const noText = document.getElementById('noHistoryText');
        if (noText) noText.remove();
        
        let itemDiv = document.getElementById(`history-item-${attempt.id}`);
        let isNew = false;
        
        if (!itemDiv) {
            itemDiv = document.createElement('div');
            itemDiv.id = `history-item-${attempt.id}`;
            itemDiv.className = 'history-item p-2 rounded border border-secondary-subtle';
            itemDiv.style.background = 'rgba(255,255,255,0.02)';
            itemDiv.style.cursor = 'pointer';
            itemDiv.style.marginBottom = '8px';
            itemDiv.setAttribute('onclick', `showHistoryDetail('${attempt.id}')`);
            isNew = true;
        }
        
        itemDiv.innerHTML = `
            <div class="d-flex justify-content-between align-items-center">
                <span class="badge bg-primary text-dark text-uppercase" style="font-size: 10px; padding: 2px 6px;">${attempt.skill}</span>
                <span class="text-primary fw-bold d-flex align-items-center gap-1" style="font-size: 12px;">
                    ${attempt.score.toLowerCase() === 'pending' ? '<i class="fas fa-play-circle text-primary animate-pulse"></i> ' : ''}${attempt.score}
                </span>
            </div>
            <div class="text-secondary small mt-1 text-truncate" style="font-size: 11px;">${attempt.date}</div>
        `;
        
        if (isNew) {
            list.prepend(itemDiv);
        }
    }

    document.getElementById('submitAnswerForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const answerText = document.getElementById('practiceUserAnswer').value.trim();
        if (!answerText) return;
        
        const btnSubmitAnswer = document.getElementById('btnSubmitAnswer');
        // Show loading state
        btnSubmitAnswer.disabled = true;
        btnSubmitAnswer.innerHTML = `<i class="fas fa-spinner fa-spin"></i> Evaluating...`;
        
        // Close modal
        const modalEl = document.getElementById('submitAnswerModal');
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        if (modalInstance) {
            modalInstance.hide();
        }
        
        // Show loader in chat
        if(welcomeView.style.display !== 'none') {
            welcomeView.style.display = 'none';
            chatMessages.style.display = 'flex';
        }
        
        // Append user's answer
        appendMessage("Submitted Answer:\n" + answerText, 'user');
        showLoader();
        
        fetch("{{ route('ai.submit_answer') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                answer: answerText
            })
        })
        .then(response => {
            btnSubmitAnswer.disabled = false;
            btnSubmitAnswer.innerHTML = `<i class="fas fa-paper-plane me-1"></i> Submit for AI Score`;
            
            if (!response.ok) {
                return response.json().then(err => { throw new Error(err.error || 'Server error'); });
            }
            return response.json();
        })
        .then(data => {
            hideLoader();
            if (data.success && data.reply) {
                // Append AI evaluation reply
                appendMessage(data.reply, 'assistant');
                
                // Add to history sidebar list
                addAttemptToHistorySidebar(data.attempt);
                
                // Save in local JS historyData object
                historyData[data.attempt.id] = {
                    id: data.attempt.id,
                    skill: data.attempt.skill.toLowerCase(),
                    score: data.attempt.score,
                    question: data.attempt.question,
                    user_answer: data.attempt.user_answer,
                    feedback: data.attempt.feedback
                };
            } else {
                appendMessage("Failed to evaluate answer. Please try again.", 'assistant');
            }
        })
        .catch(error => {
            hideLoader();
            btnSubmitAnswer.disabled = false;
            btnSubmitAnswer.innerHTML = `<i class="fas fa-paper-plane me-1"></i> Submit for AI Score`;
            console.error('Error:', error);
            appendMessage("Error evaluating your answer: " + error.message, 'assistant');
        });
    });

    // --- Reading Workspace Helper JS Functions ---

    function parseReadingResponse(text) {
        let passageHtml = "";
        let questionsList = [];
        
        let lines = text.split('\n');
        let questionStartIndex = -1;
        let answerStartIndex = -1;
        
        for (let i = 0; i < lines.length; i++) {
            let line = lines[i].toLowerCase();
            if (questionStartIndex === -1 && line.includes('question') && (line.includes('###') || line.includes('####') || line.includes('**') || line.includes('📝'))) {
                questionStartIndex = i;
            }
            if (line.includes('answer') && (line.includes('###') || line.includes('####') || line.includes('**') || line.includes('👁️'))) {
                answerStartIndex = i;
            }
        }
        
        let passageText = "";
        let questionsText = "";
        
        if (questionStartIndex !== -1) {
            passageText = lines.slice(0, questionStartIndex).join('\n');
            if (answerStartIndex !== -1 && answerStartIndex > questionStartIndex) {
                questionsText = lines.slice(questionStartIndex, answerStartIndex).join('\n');
            } else {
                questionsText = lines.slice(questionStartIndex).join('\n');
            }
        } else {
            let splitParts = text.split(/questions/i);
            if (splitParts.length > 1) {
                passageText = splitParts[0];
                let rest = splitParts.slice(1).join("questions");
                let answerSplit = rest.split(/answers|answer key|solutions/i);
                if (answerSplit.length > 1) {
                    questionsText = "### Questions\n" + answerSplit[0];
                } else {
                    questionsText = "### Questions\n" + rest;
                }
            } else {
                passageText = text;
                questionsText = "";
            }
        }
        
        // Clean up markdown title tags from passage text
        passageHtml = marked.parse(passageText);
        
        let qLines = questionsText.split('\n');
        let instructions = [];
        
        for (let i = 0; i < qLines.length; i++) {
            let line = qLines[i].trim();
            if (!line) continue;
            
            let cleanLine = line.replace(/^[\*\-\s]+/, '').trim();
            let match = cleanLine.match(/^(\d+)[\.\-\)]\s*(.*)/);
            
            if (match) {
                let num = questionsList.length + 1; // Assign sequentially
                let qText = match[2];
                
                let cleanQText = qText.replace(/\*\*/g, '').trim();
                cleanQText = cleanQText.replace(/\s*\([^)]*(vrai|faux|true|false|yes|no|oui|non|non mention|not given)[^)]*\)\s*$/i, '').trim();
                
                let type = 'text';
                let options = [];
                
                let lowerLine = line.toLowerCase();
                if (lowerLine.includes('vrai') || lowerLine.includes('faux') || lowerLine.includes('true') || lowerLine.includes('false') || lowerLine.includes('yes') || lowerLine.includes('no') || lowerLine.includes('oui') || lowerLine.includes('non')) {
                    type = 'choice';
                    if (lowerLine.includes('non mention') || lowerLine.includes('not given')) {
                        if (lowerLine.includes('true') || lowerLine.includes('false') || lowerLine.includes('not given')) {
                            options = ['True', 'False', 'Not Given'];
                        } else if (lowerLine.includes('yes') || lowerLine.includes('no') || lowerLine.includes('not given')) {
                            options = ['Yes', 'No', 'Not Given'];
                        } else {
                            options = ['Vrai', 'Faux', 'Non Mentionné'];
                        }
                    } else {
                        if (lowerLine.includes('true') || lowerLine.includes('false')) {
                            options = ['True', 'False'];
                        } else if (lowerLine.includes('yes') || lowerLine.includes('no')) {
                            options = ['Yes', 'No'];
                        } else if (lowerLine.includes('oui') || lowerLine.includes('non')) {
                            options = ['Oui', 'Non'];
                        } else {
                            options = ['Vrai', 'Faux'];
                        }
                    }
                }
                
                questionsList.push({
                    number: num,
                    text: cleanQText,
                    type: type,
                    options: options
                });
            } else {
                let choiceMatch = cleanLine.match(/^([a-z])[\.\-\)]\s*(.*)/i);
                if (choiceMatch && questionsList.length > 0) {
                    let lastQ = questionsList[questionsList.length - 1];
                    lastQ.type = 'choice';
                    lastQ.options.push(cleanLine.replace(/\*\*/g, '').trim());
                } else {
                    if (!cleanLine.toLowerCase().includes('réponses') && 
                        !cleanLine.toLowerCase().includes('explication') && 
                        !cleanLine.toLowerCase().includes('solution') &&
                        !cleanLine.toLowerCase().includes('spoiler') &&
                        !cleanLine.startsWith('||') &&
                        !cleanLine.startsWith('>')) {
                        instructions.push(marked.parse(line));
                    }
                }
            }
        }
        
        return {
            passageHtml: passageHtml,
            questions: questionsList,
            instructionsHtml: instructions.join('')
        };
    }

    function initReadingWorkspace(responseText, skill = 'reading') {
        window.speechSynthesis.cancel();
        
        let parsed = parseReadingResponse(responseText);
        
        let passagePane = document.getElementById('readingPassagePane');
        let questionsPane = document.getElementById('readingQuestionsPane');
        
        // Reset/Clear HTML
        passagePane.innerHTML = '';
        questionsPane.innerHTML = '';
        
        if (skill === 'listening') {
            // Hide passage pane for listening mode - questions will take full remaining layout space
            passagePane.style.display = 'none';
            
            // Create hidden transcript element for SpeechSynthesis to read
            let hiddenTranscript = document.createElement('div');
            hiddenTranscript.id = 'listeningTranscriptBody';
            hiddenTranscript.style.display = 'none';
            hiddenTranscript.innerHTML = parsed.passageHtml;
            questionsPane.appendChild(hiddenTranscript);
            
            // Render the audio player box at the very top of the questions pane
            let playerCard = document.createElement('div');
            playerCard.className = 'listening-player-card mb-4 p-4 rounded border';
            playerCard.style.cssText = 'background: rgba(20, 20, 20, 0.9) !important; border: 1px solid rgba(59, 130, 246, 0.3) !important;';
            playerCard.innerHTML = `
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <span class="icon-circle" style="background: rgba(59, 130, 246, 0.15); color: #3b82f6; width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; border: 1px solid rgba(59, 130, 246, 0.25);">
                            <i class="fas fa-headphones" style="font-size: 16px;"></i>
                        </span>
                        <div>
                            <h6 class="text-primary mb-0" style="font-size: 15px; font-weight: 700; letter-spacing: 0.5px; color: #3b82f6 !important;">IELTS Listening Practice Audio Track</h6>
                            <small class="text-secondary" style="font-size: 12px;" id="listeningStatus">Status: Ready to play</small>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-primary text-dark fw-bold px-4 py-2 d-flex align-items-center gap-2" id="btnPlayListening" onclick="toggleListeningAudio(this)" style="border-radius: 50px; font-size: 13px; background-color: #3b82f6 !important; border: none; box-shadow: 0 0 10px rgba(59, 130, 246, 0.3); transition: all 0.2s;">
                            <i class="fas fa-play"></i> Play Audio
                        </button>
                    </div>
                </div>
                <div class="progress" style="height: 6px; background: rgba(255,255,255,0.05); border-radius: 3px; overflow: hidden; border: 1px solid rgba(255, 255, 255, 0.05);">
                    <div class="progress-bar bg-primary" id="listeningProgressBar" role="progressbar" style="width: 0%; transition: width 0.1s linear; background-color: #3b82f6 !important;"></div>
                </div>
            `;
            questionsPane.appendChild(playerCard);
        } else {
            // Restore passage pane display for reading mode
            passagePane.style.display = 'block';
            passagePane.innerHTML = parsed.passageHtml;
        }
        
        let sectionsList = document.getElementById('readingSectionsList');
        sectionsList.innerHTML = '';
        
        let sections = [];
        let sectionCount = 0;
        
        if (skill === 'listening') {
            // Add Section name in left sidebar matching your image
            let id = 'sec-listening';
            sections.push({ id: id, name: 'LISTENING SECTION 1' });
            
            let secItem = document.createElement('div');
            secItem.className = 'reading-sec-item active';
            secItem.setAttribute('data-sec-id', id);
            secItem.innerHTML = `
                <span class="sec-name">LISTENING SECTION 1</span>
                <span class="sec-progress">0%</span>
            `;
            sectionsList.appendChild(secItem);
        } else {
            let headings = passagePane.querySelectorAll('h1, h2, h3, h4, strong');
            headings.forEach((heading) => {
                let isStrongTitle = heading.tagName === 'STRONG' && 
                                    heading.parentElement && 
                                    heading.parentElement.tagName === 'P' && 
                                    heading.parentElement.firstChild === heading && 
                                    heading.textContent.length < 40;
                                    
                if (heading.tagName !== 'STRONG' || isStrongTitle) {
                    let id = 'sec-' + sectionCount;
                    
                    if (heading.tagName === 'STRONG') {
                        heading.parentElement.setAttribute('id', id);
                    } else {
                        heading.setAttribute('id', id);
                    }
                    
                    let name = heading.textContent.trim();
                    name = name.replace(/^Texte\s*:\s*/i, '');
                    
                    sections.push({ id: id, name: name });
                    
                    let secItem = document.createElement('div');
                    secItem.className = 'reading-sec-item' + (sectionCount === 0 ? ' active' : '');
                    secItem.setAttribute('data-sec-id', id);
                    secItem.setAttribute('onclick', `scrollToSection('${id}')`);
                    
                    secItem.innerHTML = `
                        <span class="sec-name">${name}</span>
                        <span class="sec-progress">0%</span>
                    `;
                    sectionsList.appendChild(secItem);
                    
                    sectionCount++;
                }
            });

            if (sections.length === 0) {
                let id = 'sec-0';
                let firstP = passagePane.querySelector('p');
                if (firstP) {
                    firstP.setAttribute('id', id);
                } else {
                    passagePane.setAttribute('id', id);
                }
                sections.push({ id: id, name: 'Passage' });
                
                let secItem = document.createElement('div');
                secItem.className = 'reading-sec-item active';
                secItem.setAttribute('data-sec-id', id);
                secItem.setAttribute('onclick', `scrollToSection('${id}')`);
                secItem.innerHTML = `
                    <span class="sec-name">Passage</span>
                    <span class="sec-progress">0%</span>
                `;
                sectionsList.appendChild(secItem);
            }
        }
        
        if (skill !== 'listening') {
            passagePane.onscroll = function() {
                let scrollPos = passagePane.scrollTop + 60;
                let activeId = null;
                
                sections.forEach(sec => {
                    let el = document.getElementById(sec.id);
                    if (el) {
                        let topPos = el.offsetTop - passagePane.offsetTop;
                        if (topPos <= scrollPos) {
                            activeId = sec.id;
                        }
                    }
                });
                
                if (activeId) {
                    document.querySelectorAll('.reading-sec-item').forEach(item => {
                        if (item.getAttribute('data-sec-id') === activeId) {
                            item.classList.add('active');
                        } else {
                            item.classList.remove('active');
                        }
                    });
                }
            };
        } else {
            passagePane.onscroll = null;
        }
        
        if (parsed.instructionsHtml) {
            let instrDiv = document.createElement('div');
            instrDiv.className = 'mb-4 text-primary small';
            instrDiv.innerHTML = parsed.instructionsHtml;
            questionsPane.appendChild(instrDiv);
        }
        
        let ribbon = document.getElementById('questionNavRibbon');
        ribbon.innerHTML = '';
        
        parsed.questions.forEach((q) => {
            let qCard = document.createElement('div');
            qCard.className = 'reading-question-card';
            qCard.setAttribute('id', `question-card-${q.number}`);
            
            let header = document.createElement('div');
            header.className = 'reading-question-header';
            header.innerHTML = `
                <span class="reading-question-number">${q.number}</span>
                <p class="reading-question-text">${q.text}</p>
            `;
            qCard.appendChild(header);
            
            if (q.type === 'choice') {
                let optionsGroup = document.createElement('div');
                optionsGroup.className = 'reading-options-group';
                
                q.options.forEach(opt => {
                    let optBtn = document.createElement('button');
                    optBtn.type = 'button';
                    optBtn.className = 'reading-option-btn';
                    optBtn.textContent = opt;
                    optBtn.setAttribute('data-question', q.number);
                    optBtn.setAttribute('data-value', opt);
                    optBtn.setAttribute('onclick', `selectReadingOption(this, ${q.number}, '${opt}')`);
                    optionsGroup.appendChild(optBtn);
                });
                qCard.appendChild(optionsGroup);
            } else {
                let inputGroup = document.createElement('div');
                inputGroup.className = 'd-flex gap-2 align-items-center mt-2';
                
                let textInput = document.createElement('input');
                textInput.type = 'text';
                textInput.className = 'reading-input-text';
                textInput.placeholder = 'Type your answer here...';
                textInput.setAttribute('id', `reading-input-${q.number}`);
                textInput.setAttribute('oninput', `saveReadingTextAnswer(${q.number})`);
                textInput.style.flex = '1';
                
                let checkBtn = document.createElement('button');
                checkBtn.type = 'button';
                checkBtn.className = 'btn btn-primary fw-bold text-dark';
                checkBtn.style.borderRadius = '8px';
                checkBtn.style.padding = '10px 20px';
                checkBtn.innerHTML = '<i class="fas fa-check"></i>';
                checkBtn.setAttribute('onclick', `checkReadingTextAnswer(${q.number})`);
                
                inputGroup.appendChild(textInput);
                inputGroup.appendChild(checkBtn);
                qCard.appendChild(inputGroup);
            }
            
            questionsPane.appendChild(qCard);
            
            let navDot = document.createElement('span');
            navDot.className = 'question-nav-dot unanswered';
            navDot.setAttribute('id', `nav-dot-${q.number}`);
            navDot.setAttribute('onclick', `scrollToQuestionCard(${q.number})`);
            navDot.textContent = q.number;
            ribbon.appendChild(navDot);
        });
        
        window.readingQuestionsCount = parsed.questions.length;
        window.readingAnswers = {};
        window.readingCorrectAnswers = extractCorrectAnswers(responseText);
        console.log("Parsed Correct Answers:", window.readingCorrectAnswers);
        
        // Reset stats UI
        document.getElementById('statsAnswered').textContent = '0 Answered';
        document.getElementById('statsUnanswered').textContent = parsed.questions.length + ' Unanswered';
        document.getElementById('readingQuestionsTitle').textContent = `Questions 1-${parsed.questions.length}`;
        
        // Update header details based on skill
        let backBtn = document.querySelector('#readingWorkspace .btn-outline-primary');
        let headerTitle = document.querySelector('#readingWorkspace .reading-header-title');
        let headerBadge = document.querySelector('#readingWorkspace .badge');
        let submitBtn = document.getElementById('readingSubmitBtn');
        let questionsTitle = document.getElementById('readingQuestionsTitle');
        
        if (skill === 'listening') {
            if (backBtn) {
                backBtn.innerHTML = `<i class="fas fa-arrow-left me-1"></i> Exit Listening`;
                backBtn.setAttribute('onclick', 'exitListeningMode()');
            }
            if (headerTitle) headerTitle.textContent = 'LISTENING PRACTICE';
            if (headerBadge) headerBadge.textContent = 'IELTS Listening Practice';
            if (submitBtn) {
                submitBtn.setAttribute('onclick', 'submitListeningAnswers()');
                submitBtn.innerHTML = `<i class="fas fa-check-circle me-1"></i> Submit Test`;
            }
            if (questionsTitle) questionsTitle.textContent = `Questions 1-${parsed.questions.length}`;
        } else {
            if (backBtn) {
                backBtn.innerHTML = `<i class="fas fa-arrow-left me-1"></i> Exit Reading`;
                backBtn.setAttribute('onclick', 'exitReadingMode()');
            }
            if (headerTitle) headerTitle.textContent = 'READING PASSAGE 1';
            if (headerBadge) headerBadge.textContent = 'IELTS-Style Practice';
            if (submitBtn) {
                submitBtn.setAttribute('onclick', 'submitReadingAnswers()');
                submitBtn.innerHTML = `<i class="fas fa-check-circle me-1"></i> Submit Test`;
            }
            if (questionsTitle) questionsTitle.textContent = `Questions 1-${parsed.questions.length}`;
        }
        
        document.getElementById('chatSidebar').style.display = 'none';
        document.getElementById('chatMain').style.display = 'none';
        
        let workspace = document.getElementById('readingWorkspace');
        workspace.style.display = 'flex';
        
        startReadingTimer();
    }

    function selectReadingOption(button, qNum, val) {
        let parent = button.parentElement;
        
        // Deselect other options in this question
        parent.querySelectorAll('.reading-option-btn').forEach(btn => {
            btn.classList.remove('active');
            btn.style.backgroundColor = '';
            btn.style.borderColor = '';
            btn.style.color = '';
        });
        
        button.classList.add('active');
        window.readingAnswers[qNum] = val;
        
        let dot = document.getElementById(`nav-dot-${qNum}`);
        if (dot) {
            dot.classList.remove('unanswered');
            dot.classList.add('answered');
        }
        
        updateReadingProgress();
    }

    function checkReadingTextAnswer(qNum) {
        let input = document.getElementById(`reading-input-${qNum}`);
        let val = input.value.trim();
        if (!val) {
            alert("Please enter an answer.");
            return;
        }
        
        window.readingAnswers[qNum] = val;
        
        let dot = document.getElementById(`nav-dot-${qNum}`);
        if (dot) {
            dot.classList.remove('unanswered');
            dot.classList.add('answered');
            
            // Subtle styling to show it is recorded
            input.style.borderColor = '#0d6efd';
            input.style.backgroundColor = 'rgba(13, 110, 253, 0.05)';
        }
        
        updateReadingProgress();
    }

    function saveReadingTextAnswer(qNum) {
        let input = document.getElementById(`reading-input-${qNum}`);
        let val = input.value.trim();
        
        if (val) {
            window.readingAnswers[qNum] = val;
            let dot = document.getElementById(`nav-dot-${qNum}`);
            if (dot) {
                dot.classList.remove('unanswered');
                dot.classList.add('answered');
            }
        } else {
            delete window.readingAnswers[qNum];
            let dot = document.getElementById(`nav-dot-${qNum}`);
            if (dot) {
                dot.classList.remove('answered');
                dot.classList.add('unanswered');
            }
        }
        
        updateReadingProgress();
    }

    function updateReadingProgress() {
        let total = window.readingQuestionsCount || 1;
        let answered = 0;
        
        for (let i = 1; i <= total; i++) {
            if (window.readingAnswers[i]) {
                answered++;
            }
        }
        
        let unanswered = total - answered;
        
        const statsAnsweredEl = document.getElementById('statsAnswered');
        if (statsAnsweredEl) {
            statsAnsweredEl.textContent = answered + ' Answered';
        }
        
        const statsUnansweredEl = document.getElementById('statsUnanswered');
        if (statsUnansweredEl) {
            statsUnansweredEl.textContent = unanswered + ' Unanswered';
        }
        
        let percentage = Math.round((answered / total) * 100);
        document.querySelectorAll('.reading-sec-item .sec-progress').forEach(badge => {
            badge.textContent = percentage + '%';
        });
    }

    function scrollToQuestionCard(qNum) {
        let card = document.getElementById(`question-card-${qNum}`);
        let pane = document.getElementById('readingQuestionsPane');
        
        if (card && pane) {
            pane.scrollTo({
                top: card.offsetTop - pane.offsetTop - 10,
                behavior: 'smooth'
            });
            
            document.querySelectorAll('.question-nav-dot').forEach(dot => {
                dot.classList.remove('active');
            });
            let activeDot = document.getElementById(`nav-dot-${qNum}`);
            if (activeDot) activeDot.classList.add('active');
        }
    }

    function scrollToSection(id) {
        const el = document.getElementById(id);
        const pane = document.getElementById('readingPassagePane');
        if (el && pane) {
            pane.scrollTo({
                top: el.offsetTop - pane.offsetTop - 10,
                behavior: 'smooth'
            });
            document.querySelectorAll('.reading-sec-item').forEach(item => {
                item.classList.remove('active');
            });
            const navItem = document.querySelector(`.reading-sec-item[data-sec-id="${id}"]`);
            if (navItem) navItem.classList.add('active');
        }
    }

    function exitReadingMode() {
        window.speechSynthesis.cancel();
        if (typeof listeningProgressInterval !== 'undefined' && listeningProgressInterval) {
            clearInterval(listeningProgressInterval);
        }
        stopReadingTimer();
        document.getElementById('readingWorkspace').style.display = 'none';
        
        document.getElementById('chatSidebar').style.display = 'flex';
        document.getElementById('chatMain').style.display = 'flex';
        
        if (welcomeView.style.display !== 'none') {
            chatMessages.style.display = 'flex';
        }

        // Inform server to clear active practice session
        fetch("{{ route('ai.chat') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                message: 'clear_session'
            })
        }).catch(err => console.error('Failed to clear session:', err));
    }

    function submitReadingAnswers() {
        stopReadingTimer();
        
        let answersText = "";
        for (let i = 1; i <= window.readingQuestionsCount; i++) {
            let ans = window.readingAnswers[i] || "Unanswered";
            answersText += `${i}. ${ans}\n`;
        }
        
        let submitBtn = document.getElementById('readingSubmitBtn');
        let originalHtml = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = `<i class="fas fa-spinner fa-spin"></i> Submitting...`;
        
        if (welcomeView.style.display !== 'none') {
            welcomeView.style.display = 'none';
            chatMessages.style.display = 'flex';
        }
        appendMessage("Submitted Answer:\n" + answersText, 'user');
        showLoader();
        
        fetch("{{ route('ai.submit_answer') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                answer: answersText
            })
        })
        .then(response => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalHtml;
            
            if (!response.ok) {
                return response.json().then(err => { throw new Error(err.error || 'Server error'); });
            }
            return response.json();
        })
        .then(data => {
            hideLoader();
            if (data.success) {
                let finalReply = data.reply || `### 📊 Evaluation\n\n**Score:** ${data.attempt.score}\n\n${data.attempt.feedback}`;
                appendMessage(finalReply, 'assistant');
                addAttemptToHistorySidebar(data.attempt);
                
                historyData[data.attempt.id] = {
                    id: data.attempt.id,
                    skill: data.attempt.skill.toLowerCase(),
                    score: data.attempt.score,
                    question: data.attempt.question,
                    user_answer: data.attempt.user_answer,
                    feedback: data.attempt.feedback
                };
                
                document.getElementById('readingResultScore').textContent = data.attempt.score;
                if (typeof marked !== 'undefined') {
                    document.getElementById('readingResultFeedback').innerHTML = marked.parse(data.attempt.feedback || '');
                } else {
                    document.getElementById('readingResultFeedback').textContent = data.attempt.feedback || '';
                }
                
                let resultsModal = new bootstrap.Modal(document.getElementById('readingResultsModal'));
                resultsModal.show();
            } else {
                alert("An error occurred while evaluating your answers.");
                exitReadingMode();
            }
        })
        .catch(error => {
            hideLoader();
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalHtml;
            console.error('Error:', error);
            alert("Network error: " + error.message);
            exitReadingMode();
        });
    }

    // --- Listening Practice Handlers ---
    let listeningUtterance = null;
    let listeningProgressInterval = null;
    let listeningTextToSpeak = "";

    window.toggleListeningAudio = function(btn) {
        if (window.speechSynthesis.speaking) {
            window.speechSynthesis.cancel();
            clearInterval(listeningProgressInterval);
            document.getElementById('listeningStatus').textContent = "Status: Paused";
            btn.innerHTML = `<i class="fas fa-play"></i> Play Audio`;
            document.getElementById('listeningProgressBar').style.width = '0%';
            return;
        }
        
        let transcriptEl = document.getElementById('listeningTranscriptBody');
        if (!transcriptEl) return;
        
        listeningTextToSpeak = transcriptEl.innerText;
        listeningUtterance = new SpeechSynthesisUtterance(listeningTextToSpeak);
        
        const voices = window.speechSynthesis.getVoices();
        const englishVoice = voices.find(voice => voice.lang.includes('en-GB') || voice.lang.includes('en-US')) || voices.find(voice => voice.lang.startsWith('en'));
        if (englishVoice) {
            listeningUtterance.voice = englishVoice;
        }
        
        listeningUtterance.rate = 0.90;
        
        document.getElementById('listeningStatus').textContent = "Status: Playing Audio Track...";
        btn.innerHTML = `<i class="fas fa-pause"></i> Pause Audio`;
        
        let startTime = Date.now();
        let words = listeningTextToSpeak.split(/\s+/).length;
        let estimatedDurationMs = (words / 2.5) * 1000;
        
        let progressBar = document.getElementById('listeningProgressBar');
        progressBar.style.width = '0%';
        
        listeningProgressInterval = setInterval(() => {
            let elapsed = Date.now() - startTime;
            let percent = Math.min((elapsed / estimatedDurationMs) * 100, 100);
            progressBar.style.width = percent + '%';
            if (percent >= 100) {
                clearInterval(listeningProgressInterval);
            }
        }, 100);
        
        listeningUtterance.onend = function() {
            clearInterval(listeningProgressInterval);
            document.getElementById('listeningStatus').textContent = "Status: Completed";
            btn.innerHTML = `<i class="fas fa-play"></i> Play Audio`;
            progressBar.style.width = '100%';
        };

        listeningUtterance.onerror = function() {
            clearInterval(listeningProgressInterval);
            document.getElementById('listeningStatus').textContent = "Status: Ready";
            btn.innerHTML = `<i class="fas fa-play"></i> Play Audio`;
            progressBar.style.width = '0%';
        };
        
        window.speechSynthesis.speak(listeningUtterance);
    }

    window.toggleTranscript = function(btn) {
        let body = document.getElementById('listeningTranscriptBody');
        if (body.style.display === 'none') {
            body.style.display = 'block';
            btn.textContent = '[Hide Transcript]';
        } else {
            body.style.display = 'none';
            btn.textContent = '[Show Transcript]';
        }
    }

    window.exitListeningMode = function() {
        window.speechSynthesis.cancel();
        clearInterval(listeningProgressInterval);
        exitReadingMode();
    }

    window.submitListeningAnswers = function() {
        stopReadingTimer();
        window.speechSynthesis.cancel();
        clearInterval(listeningProgressInterval);
        
        let answersText = "";
        for (let i = 1; i <= window.readingQuestionsCount; i++) {
            let ans = window.readingAnswers[i] || "Unanswered";
            answersText += `${i}. ${ans}\n`;
        }
        
        let submitBtn = document.getElementById('readingSubmitBtn');
        let originalHtml = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = `<i class="fas fa-spinner fa-spin"></i> Submitting...`;
        
        if (welcomeView.style.display !== 'none') {
            welcomeView.style.display = 'none';
            chatMessages.style.display = 'flex';
        }
        appendMessage("Submitted Answer:\n" + answersText, 'user');
        showLoader();
        
        fetch("{{ route('ai.submit_answer') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                answer: answersText
            })
        })
        .then(response => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalHtml;
            
            if (!response.ok) {
                return response.json().then(err => { throw new Error(err.error || 'Server error'); });
            }
            return response.json();
        })
        .then(data => {
            hideLoader();
            if (data.success) {
                let finalReply = data.reply || `### 📊 Evaluation\n\n**Score:** ${data.attempt.score}\n\n${data.attempt.feedback}`;
                appendMessage(finalReply, 'assistant');
                addAttemptToHistorySidebar(data.attempt);
                
                historyData[data.attempt.id] = {
                    id: data.attempt.id,
                    skill: data.attempt.skill.toLowerCase(),
                    score: data.attempt.score,
                    question: data.attempt.question,
                    user_answer: data.attempt.user_answer,
                    feedback: data.attempt.feedback
                };
                
                document.getElementById('readingResultsModalLabel').innerHTML = `<i class="fas fa-poll-h me-2"></i> Listening Evaluation Completed`;
                document.getElementById('readingResultScore').textContent = data.attempt.score;
                if (typeof marked !== 'undefined') {
                    document.getElementById('readingResultFeedback').innerHTML = marked.parse(data.attempt.feedback || '');
                } else {
                    document.getElementById('readingResultFeedback').textContent = data.attempt.feedback || '';
                }
                
                let resultsModal = new bootstrap.Modal(document.getElementById('readingResultsModal'));
                resultsModal.show();
            } else {
                alert("An error occurred while evaluating your answers.");
                exitListeningMode();
            }
        })
        .catch(error => {
            hideLoader();
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalHtml;
            console.error('Error:', error);
            alert("Network error: " + error.message);
            exitListeningMode();
        });
    }

    function startReadingTimer() {
        clearInterval(readingTimerInterval);
        readingTimeRemaining = 1200; 
        updateTimerDisplay();
        
        readingTimerInterval = setInterval(() => {
            readingTimeRemaining--;
            if (readingTimeRemaining <= 0) {
                clearInterval(readingTimerInterval);
                readingTimeRemaining = 0;
                updateTimerDisplay();
                alert("Time is up! Your answers will be submitted automatically.");
                submitReadingAnswers();
            } else {
                updateTimerDisplay();
            }
        }, 1000);
    }

    function updateTimerDisplay() {
        let minutes = Math.floor(readingTimeRemaining / 60);
        let seconds = readingTimeRemaining % 60;
        
        let displayStr = 
            (minutes < 10 ? '0' + minutes : minutes) + ':' + 
            (seconds < 10 ? '0' + seconds : seconds);
            
        document.getElementById('readingTimerClock').textContent = displayStr;
        
        if (readingTimeRemaining < 180) {
            document.getElementById('readingTimerClock').style.color = '#ef4444';
            document.getElementById('readingTimerClock').parentElement.style.borderColor = '#ef4444';
        } else {
            document.getElementById('readingTimerClock').style.color = '#fff';
            document.getElementById('readingTimerClock').parentElement.style.borderColor = 'rgba(59, 130, 246, 0.3)';
        }
    }

    function stopReadingTimer() {
        clearInterval(readingTimerInterval);
    }

    function extractCorrectAnswers(text) {
        let answers = {};
        let lowerText = text.toLowerCase();
        
        let keywords = ['réponses', 'corrigé', 'solution', 'correction', 'answers', 'answer key', 'explications'];
        let index = -1;
        for (let kw of keywords) {
            let pos = lowerText.lastIndexOf(kw);
            if (pos !== -1 && pos > index) {
                index = pos;
            }
        }
        
        if (index === -1) {
            index = Math.floor(text.length * 0.6);
        }
        
        let answerPart = text.substring(index);
        let lines = answerPart.split('\n');
        
        lines.forEach(line => {
            let clean = line.replace(/^[\*\-\s]+/, '').trim();
            let match = clean.match(/^(?:q)?(\d+)[\.\-\):]?\s*([^\n]+)/i);
            if (match) {
                let num = parseInt(match[1]);
                let rest = match[2].trim().toLowerCase();
                
                // Clean leading punctuation/markdown/brackets
                rest = rest.replace(/^[\*\s\:\-\.\)\(]+/, '');
                
                let val = '';
                
                let idxTrue = rest.indexOf('true');
                if (idxTrue === -1) idxTrue = rest.indexOf('vrai');
                
                let idxFalse = rest.indexOf('false');
                if (idxFalse === -1) idxFalse = rest.indexOf('faux');
                
                let idxNotGiven = rest.indexOf('not given');
                if (idxNotGiven === -1) idxNotGiven = rest.indexOf('non mention');
                if (idxNotGiven === -1) idxNotGiven = rest.indexOf('non-mention');
                
                let idxMC = -1;
                let mcVal = '';
                let mcMatch = rest.match(/\b([a-d])\b/);
                if (mcMatch) {
                    idxMC = rest.indexOf(mcMatch[0]);
                    mcVal = mcMatch[1];
                }
                
                let minIdx = Infinity;
                
                if (idxTrue !== -1 && idxTrue < minIdx) {
                    minIdx = idxTrue;
                    val = 'true';
                }
                if (idxFalse !== -1 && idxFalse < minIdx) {
                    minIdx = idxFalse;
                    val = 'false';
                }
                if (idxNotGiven !== -1 && idxNotGiven < minIdx) {
                    minIdx = idxNotGiven;
                    val = 'not given';
                }
                if (idxMC !== -1 && idxMC < minIdx) {
                    minIdx = idxMC;
                    val = mcVal;
                }
                
                // Text fallback if not matching true/false/not given/mc
                if (!val) {
                    let parts = rest.split(/ \- | \: | \(/);
                    if (parts.length > 0) {
                        val = parts[0].trim();
                    } else {
                        val = rest;
                    }
                    val = val.replace(/[\.\*\`\_\:]+$/, '').trim();
                }
                
                if (val) {
                    answers[num] = val;
                }
            }
        });
        
        return answers;
    }

    function isAnswerCorrect(userVal, correctVal) {
        if (!userVal || !correctVal) return false;
        let u = userVal.trim().toLowerCase().replace(/[\.,\-\*\'\"`\?]/g, '').replace(/\s+/g, ' ');
        let c = correctVal.trim().toLowerCase().replace(/[\.,\-\*\'\"`\?]/g, '').replace(/\s+/g, ' ');
        
        if (u === c) return true;
        
        // Flexible substring match for longer text answers
        if (u.length > 3 && c.length > 3) {
            if (c.includes(u) || u.includes(c)) return true;
        }
        
        if ((u === 'vrai' || u === 'true') && (c === 'vrai' || c === 'true')) return true;
        if ((u === 'faux' || u === 'false') && (c === 'faux' || c === 'false')) return true;
        if ((u === 'non mentionné' || u === 'non mentionne' || u === 'not given' || u === 'non-mentionné') && 
            (c === 'non mentionné' || c === 'non mentionne' || c === 'not given' || c === 'non-mentionné')) return true;
            
        return false;
    }

    // --- Writing Workspace Helper JS Functions ---
    let writingTimerInterval = null;
    let writingTimeRemaining = 2400; // 40 minutes

    function initWritingWorkspace(responseText) {
        window.speechSynthesis.cancel();
        
        let cleanText = responseText.replace(/<exercise skill="writing"[^>]*>/i, '').replace(/<\/exercise>/i, '');
        
        let promptPane = document.getElementById('writingPromptPane');
        if (cleanText.includes('<p>') || cleanText.includes('<h') || cleanText.includes('<div') || cleanText.includes('<strong>') || cleanText.includes('<ul>')) {
            promptPane.innerHTML = cleanText;
        } else {
            promptPane.innerHTML = typeof marked !== 'undefined' ? marked.parse(cleanText) : cleanText;
        }
        
        // Dynamically set header title from prompt content
        let titleMatch = cleanText.match(/###\s*(Writing\s*Task\s*\d+[^:\n]*:[^\n]+)/i) || cleanText.match(/Writing\s*Task\s*\d+[^:\n]*:[^\n]+/i);
        if (titleMatch) {
            document.getElementById('writingHeaderTitle').textContent = titleMatch[0].replace(/[\#\*\_]+/g, '').trim().toUpperCase();
        } else {
            document.getElementById('writingHeaderTitle').textContent = 'WRITING TASK 1: BAR CHART';
        }
        
        let textarea = document.getElementById('writingTextarea');
        textarea.value = '';
        document.getElementById('writingWordCount').textContent = 'Word count: 0';
        
        // Set dynamic active circle id to the navigation dot
        let navCircle = document.querySelector('.nav-circle-light');
        if (navCircle) navCircle.id = 'writingNavCircle';
        
        updateWritingWordCount();
        
        document.getElementById('chatSidebar').style.display = 'none';
        document.getElementById('chatMain').style.display = 'none';
        
        let workspace = document.getElementById('writingWorkspace');
        workspace.style.display = 'flex';
        
        startWritingTimer();
    }

    function startWritingTimer() {
        clearInterval(writingTimerInterval);
        writingTimeRemaining = 2400; // 40 minutes
        updateWritingTimerDisplay();
        
        writingTimerInterval = setInterval(() => {
            writingTimeRemaining--;
            if (writingTimeRemaining <= 0) {
                clearInterval(writingTimerInterval);
                writingTimeRemaining = 0;
                updateWritingTimerDisplay();
                alert("Time is up! Your answers will be submitted automatically.");
                submitWritingAnswer();
            } else {
                updateWritingTimerDisplay();
            }
        }, 1000);
    }

    function updateWritingTimerDisplay() {
        let minutes = Math.floor(writingTimeRemaining / 60);
        let seconds = writingTimeRemaining % 60;
        let displayStr = (minutes < 10 ? '0' + minutes : minutes) + ':' + (seconds < 10 ? '0' + seconds : seconds);
        let clockEl = document.getElementById('writingTimerClock');
        if (clockEl) {
            clockEl.textContent = '00:' + displayStr;
            if (writingTimeRemaining < 300) {
                clockEl.style.color = '#ef4444';
                clockEl.parentElement.style.borderColor = '#ef4444';
            } else {
                clockEl.style.color = '#E31B23';
                clockEl.parentElement.style.borderColor = '#E31B23';
            }
        }
    }

    function stopWritingTimer() {
        clearInterval(writingTimerInterval);
    }

    function updateWritingWordCount() {
        let text = document.getElementById('writingTextarea').value.trim();
        let words = text ? text.split(/\s+/).length : 0;
        document.getElementById('writingWordCount').textContent = `Word count: ${words}`;
        
        let answeredStatus = document.getElementById('footerAnsweredStatus');
        let unansweredStatus = document.getElementById('footerUnansweredStatus');
        let navCircle = document.getElementById('writingNavCircle');
        
        if (words > 0) {
            if (answeredStatus) answeredStatus.textContent = '1/1 Answered';
            if (unansweredStatus) unansweredStatus.textContent = '0/1 Unanswered';
            if (navCircle) {
                navCircle.style.backgroundColor = '#E31B23';
                navCircle.style.borderColor = '#E31B23';
                navCircle.style.color = '#ffffff';
            }
        } else {
            if (answeredStatus) answeredStatus.textContent = '0/1 Answered';
            if (unansweredStatus) unansweredStatus.textContent = '1/1 Unanswered';
            if (navCircle) {
                navCircle.style.backgroundColor = '#e0f2fe';
                navCircle.style.borderColor = '#0284c7';
                navCircle.style.color = '#0369a1';
            }
        }
    }

    function submitWritingAnswer() {
        stopWritingTimer();
        
        let answerText = document.getElementById('writingTextarea').value.trim();
        if (!answerText) {
            alert("Please enter your response before submitting.");
            startWritingTimer();
            return;
        }
        
        let submitBtn = document.getElementById('writingSubmitBtn');
        let originalHtml = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = `<i class="fas fa-spinner fa-spin"></i> Submitting...`;
        
        if (welcomeView.style.display !== 'none') {
            welcomeView.style.display = 'none';
            chatMessages.style.display = 'flex';
        }
        
        appendMessage("Submitted Essay/Answer:\n" + answerText, 'user');
        showLoader();
        
        fetch("{{ route('ai.submit_answer') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                answer: answerText
            })
        })
        .then(response => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalHtml;
            
            if (!response.ok) {
                return response.json().then(err => { throw new Error(err.error || 'Server error'); });
            }
            return response.json();
        })
        .then(data => {
            hideLoader();
            if (data.success) {
                let finalReply = data.reply || `### 📊 Evaluation\n\n**Score:** ${data.attempt.score}\n\n${data.attempt.feedback}`;
                exitWritingMode(false);
                
                appendMessage(finalReply, 'assistant');
                addAttemptToHistorySidebar(data.attempt);
                
                historyData[data.attempt.id] = {
                    id: data.attempt.id,
                    skill: data.attempt.skill.toLowerCase(),
                    score: data.attempt.score,
                    question: data.attempt.question,
                    user_answer: data.attempt.user_answer,
                    feedback: data.attempt.feedback
                };
                
                document.getElementById('readingResultsModalLabel').innerHTML = `<i class="fas fa-poll-h me-2"></i> Writing Evaluation Completed`;
                document.getElementById('readingResultScore').textContent = data.attempt.score;
                if (typeof marked !== 'undefined') {
                    document.getElementById('readingResultFeedback').innerHTML = marked.parse(data.attempt.feedback || '');
                } else {
                    document.getElementById('readingResultFeedback').textContent = data.attempt.feedback || '';
                }
                
                let resultsModal = new bootstrap.Modal(document.getElementById('readingResultsModal'));
                resultsModal.show();
            } else {
                alert("An error occurred while evaluating your answer.");
                exitWritingMode();
            }
        })
        .catch(error => {
            hideLoader();
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalHtml;
            console.error('Error:', error);
            alert("Network error: " + error.message);
            exitWritingMode();
        });
    }

    function startWritingTimer() {
        clearInterval(writingTimerInterval);
        writingTimeRemaining = 2400; // 40 minutes in seconds
        updateWritingTimerDisplay();
        
        writingTimerInterval = setInterval(() => {
            writingTimeRemaining--;
            if (writingTimeRemaining <= 0) {
                clearInterval(writingTimerInterval);
                writingTimeRemaining = 0;
                updateWritingTimerDisplay();
                alert("Time is up! Your answer will be submitted automatically.");
                submitWritingAnswer();
            } else {
                updateWritingTimerDisplay();
            }
        }, 1000);
    }

    function updateWritingTimerDisplay() {
        let hours = Math.floor(writingTimeRemaining / 3600);
        let minutes = Math.floor((writingTimeRemaining % 3600) / 60);
        let seconds = writingTimeRemaining % 60;
        
        let displayStr = 
            (hours < 10 ? '0' + hours : hours) + ':' +
            (minutes < 10 ? '0' + minutes : minutes) + ':' + 
            (seconds < 10 ? '0' + seconds : seconds);
            
        document.getElementById('writingTimerClock').textContent = displayStr;
        
        if (writingTimeRemaining < 300) {
            document.getElementById('writingTimerClock').style.color = '#ef4444';
        } else {
            document.getElementById('writingTimerClock').style.color = '#E31B23';
        }
    }

    function stopWritingTimer() {
        clearInterval(writingTimerInterval);
    }

    function exitWritingMode(shouldClear = true) {
        stopWritingTimer();
        document.getElementById('writingWorkspace').style.display = 'none';
        
        document.getElementById('chatSidebar').style.display = 'flex';
        document.getElementById('chatMain').style.display = 'flex';
        
        if (welcomeView.style.display !== 'none') {
            chatMessages.style.display = 'flex';
        }

        if (shouldClear) {
            fetch("{{ route('ai.chat') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    message: 'clear_session'
                })
            }).catch(err => console.error('Failed to clear session:', err));
        }
    }

    // --- Speaking Workspace Helper JS Functions ---
    let speakingTimerInterval = null;
    let speakingTimeRemaining = 120; // 2 minutes
    let recognition = null;
    let isRecording = false;
    let baseTranscript = '';

    function initSpeechRecognition() {
        if (!('webkitSpeechRecognition' in window) && !('SpeechRecognition' in window)) {
            alert("Web Speech API is not supported in this browser. Please use Google Chrome or Microsoft Edge.");
            return null;
        }
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        const rec = new SpeechRecognition();
        rec.continuous = true;
        rec.interimResults = true;
        
        const selectEl = document.getElementById('speakingLanguageSelect');
        rec.lang = selectEl ? selectEl.value : 'en-US';

        rec.onstart = () => {
            isRecording = true;
            let dot = document.getElementById('speakingMicStatusDot');
            let text = document.getElementById('speakingMicStatusText');
            let btn = document.getElementById('btnToggleSpeakingMic');
            
            if (dot) {
                dot.style.backgroundColor = '#ef4444';
                dot.classList.add('animate-pulse');
            }
            if (text) text.textContent = 'Status: Recording...';
            if (btn) {
                btn.innerHTML = '<i class="fas fa-stop"></i> Stop Recording';
                btn.style.setProperty('background-color', '#ef4444', 'important');
            }
        };

        rec.onend = () => {
            isRecording = false;
            let dot = document.getElementById('speakingMicStatusDot');
            let text = document.getElementById('speakingMicStatusText');
            let btn = document.getElementById('btnToggleSpeakingMic');
            
            if (dot) {
                dot.style.backgroundColor = '#64748b';
                dot.classList.remove('animate-pulse');
            }
            if (text) text.textContent = 'Status: Microphone Ready';
            if (btn) {
                btn.innerHTML = '<i class="fas fa-microphone"></i> Start Recording';
                btn.style.setProperty('background-color', '#E31B23', 'important');
            }
        };

        rec.onresult = (event) => {
            let sessionText = '';
            for (let i = 0; i < event.results.length; ++i) {
                sessionText += event.results[i][0].transcript;
            }
            const textarea = document.getElementById('speakingTextarea');
            if (textarea) {
                textarea.value = (baseTranscript + sessionText).trim();
                updateSpeakingWordCount();
            }
        };

        rec.onerror = (event) => {
            console.error('Speech recognition error:', event.error);
            if (event.error === 'not-allowed') {
                alert('Microphone access blocked. Please enable microphone permissions in your browser.');
            } else {
                alert('Speech recognition error: ' + event.error);
            }
        };

        return rec;
    }

    function updateSpeakingLanguage() {
        if (recognition) {
            const selectEl = document.getElementById('speakingLanguageSelect');
            if (selectEl) {
                const wasRecording = isRecording;
                if (wasRecording) {
                    recognition.stop();
                }
                recognition.lang = selectEl.value;
                console.log("Updated speech recognition language to:", recognition.lang);
                if (wasRecording) {
                    setTimeout(() => {
                        try {
                            recognition.start();
                        } catch (e) {
                            console.error(e);
                        }
                    }, 400);
                }
            }
        }
    }

    function toggleSpeakingRecognition() {
        try {
            if (!recognition) {
                recognition = initSpeechRecognition();
            }
            if (!recognition) return;

            if (isRecording) {
                recognition.stop();
            } else {
                const textarea = document.getElementById('speakingTextarea');
                baseTranscript = textarea ? textarea.value.trim() : '';
                if (baseTranscript !== '') {
                    baseTranscript += ' ';
                }
                const selectEl = document.getElementById('speakingLanguageSelect');
                if (selectEl) {
                    recognition.lang = selectEl.value;
                }
                recognition.start();
            }
        } catch (e) {
            console.error("Speech recognition start failed:", e);
            alert("Could not start speech recognition: " + e.message);
        }
    }

    function initSpeakingWorkspace(responseText) {
        window.speechSynthesis.cancel();
        if (recognition && isRecording) {
            recognition.stop();
        }

        let cleanText = responseText.replace(/<exercise skill="speaking"[^>]*>/i, '').replace(/<\/exercise>/i, '');
        
        let promptPane = document.getElementById('speakingPromptPane');
        if (promptPane) {
            if (cleanText.includes('<p>') || cleanText.includes('<h') || cleanText.includes('<div') || cleanText.includes('<strong>') || cleanText.includes('<ul>')) {
                promptPane.innerHTML = cleanText;
            } else {
                promptPane.innerHTML = typeof marked !== 'undefined' ? marked.parse(cleanText) : cleanText;
            }
        }
        
        let titleMatch = cleanText.match(/###\s*(Speaking\s*Task\s*\d+[^:\n]*:[^\n]+)/i) || cleanText.match(/Speaking\s*Task\s*\d+[^:\n]*:[^\n]+/i);
        let headerTitle = document.getElementById('speakingHeaderTitle');
        if (headerTitle) {
            if (titleMatch) {
                headerTitle.textContent = titleMatch[0].replace(/[\#\*\_]+/g, '').trim().toUpperCase();
            } else {
                headerTitle.textContent = 'SPEAKING PART 2: CUE CARD';
            }
        }
        
        let textarea = document.getElementById('speakingTextarea');
        if (textarea) textarea.value = '';
        
        let wordCountEl = document.getElementById('speakingWordCount');
        if (wordCountEl) wordCountEl.textContent = 'Word count: 0';
        
        document.getElementById('chatSidebar').style.display = 'none';
        document.getElementById('chatMain').style.display = 'none';
        
        let workspace = document.getElementById('speakingWorkspace');
        if (workspace) workspace.style.display = 'flex';
        
        startSpeakingTimer();
    }

    function startSpeakingTimer() {
        clearInterval(speakingTimerInterval);
        speakingTimeRemaining = 120; // 2 minutes
        updateSpeakingTimerDisplay();
        
        speakingTimerInterval = setInterval(() => {
            speakingTimeRemaining--;
            if (speakingTimeRemaining <= 0) {
                clearInterval(speakingTimerInterval);
                speakingTimeRemaining = 0;
                updateSpeakingTimerDisplay();
                if (recognition && isRecording) {
                    recognition.stop();
                }
                alert("Time is up! Your answer will be submitted automatically.");
                submitSpeakingAnswer();
            } else {
                updateSpeakingTimerDisplay();
            }
        }, 1000);
    }

    function updateSpeakingTimerDisplay() {
        let minutes = Math.floor(speakingTimeRemaining / 60);
        let seconds = speakingTimeRemaining % 60;
        let displayStr = (minutes < 10 ? '0' + minutes : minutes) + ':' + (seconds < 10 ? '0' + seconds : seconds);
        let clockEl = document.getElementById('speakingTimerClock');
        if (clockEl) {
            clockEl.textContent = '00:' + displayStr;
            if (speakingTimeRemaining < 30) {
                clockEl.style.color = '#ef4444';
                clockEl.parentElement.style.borderColor = '#ef4444';
            } else {
                clockEl.style.color = '#E31B23';
                clockEl.parentElement.style.borderColor = '#E31B23';
            }
        }
    }

    function stopSpeakingTimer() {
        clearInterval(speakingTimerInterval);
    }

    function updateSpeakingWordCount() {
        let textarea = document.getElementById('speakingTextarea');
        if (textarea) {
            let text = textarea.value.trim();
            let words = text ? text.split(/\s+/).length : 0;
            let wordCountEl = document.getElementById('speakingWordCount');
            if (wordCountEl) wordCountEl.textContent = `Word count: ${words}`;
        }
    }

    function exitSpeakingMode() {
        if (recognition && isRecording) {
            recognition.stop();
        }
        stopSpeakingTimer();
        let workspace = document.getElementById('speakingWorkspace');
        if (workspace) workspace.style.display = 'none';
        
        document.getElementById('chatSidebar').style.display = 'flex';
        document.getElementById('chatMain').style.display = 'flex';
        
        let welcomeView = document.getElementById('welcomeView');
        let chatMessages = document.getElementById('chatMessages');
        if (welcomeView && welcomeView.style.display !== 'none') {
            if (chatMessages) chatMessages.style.display = 'flex';
        }
        
        fetch("{{ route('ai.chat') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                message: 'clear_session'
            })
        }).catch(err => console.error('Failed to clear session:', err));
    }

    function submitSpeakingAnswer() {
        if (recognition && isRecording) {
            recognition.stop();
        }
        stopSpeakingTimer();
        
        let textarea = document.getElementById('speakingTextarea');
        let answerText = textarea ? textarea.value.trim() : '';
        if (!answerText) {
            alert("Please enter or record an answer before submitting.");
            startSpeakingTimer();
            return;
        }
        
        let submitBtn = document.getElementById('speakingSubmitBtn');
        let originalHtml = submitBtn ? submitBtn.innerHTML : '';
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = `<i class="fas fa-spinner fa-spin"></i> Submitting...`;
        }
        
        let welcomeView = document.getElementById('welcomeView');
        let chatMessages = document.getElementById('chatMessages');
        if (welcomeView && welcomeView.style.display !== 'none') {
            welcomeView.style.display = 'none';
            if (chatMessages) chatMessages.style.display = 'flex';
        }
        
        appendMessage("Submitted Speech Answer:\n" + answerText, 'user');
        showLoader();
        
        let workspace = document.getElementById('speakingWorkspace');
        if (workspace) workspace.style.display = 'none';
        document.getElementById('chatSidebar').style.display = 'flex';
        document.getElementById('chatMain').style.display = 'flex';
        
        fetch("{{ route('ai.submit_answer') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                answer: answerText
            })
        })
        .then(response => {
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalHtml;
            }
            
            if (!response.ok) {
                return response.json().then(err => { throw new Error(err.error || 'Server error'); });
            }
            return response.json();
        })
        .then(data => {
            hideLoader();
            if (data.success) {
                let finalReply = data.reply || `### 📊 Evaluation\n\n**Score:** ${data.attempt.score}\n\n${data.attempt.feedback}`;
                appendMessage(finalReply, 'assistant');
                addAttemptToHistorySidebar(data.attempt);
                
                historyData[data.attempt.id] = {
                    id: data.attempt.id,
                    skill: data.attempt.skill.toLowerCase(),
                    score: data.attempt.score,
                    question: data.attempt.question,
                    user_answer: data.attempt.user_answer,
                    feedback: data.attempt.feedback
                };
                
                let modalLabel = document.getElementById('readingResultsModalLabel');
                if (modalLabel) modalLabel.innerHTML = `<i class="fas fa-poll-h me-2"></i> Speaking Evaluation Completed`;
                
                let scoreEl = document.getElementById('readingResultScore');
                if (scoreEl) scoreEl.textContent = data.attempt.score;
                
                let feedbackEl = document.getElementById('readingResultFeedback');
                if (feedbackEl) {
                    if (typeof marked !== 'undefined') {
                        feedbackEl.innerHTML = marked.parse(data.attempt.feedback || '');
                    } else {
                        feedbackEl.textContent = data.attempt.feedback || '';
                    }
                }
                
                let resultsModal = new bootstrap.Modal(document.getElementById('readingResultsModal'));
                resultsModal.show();
            } else {
                alert("An error occurred while evaluating your speaking answer.");
                exitSpeakingMode();
            }
        })
        .catch(error => {
            hideLoader();
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalHtml;
            }
            console.error('Error:', error);
            alert("Network error: " + error.message);
            exitSpeakingMode();
        });
    }

    // Auto-trigger practice test if quick_start parameter is present in URL
    window.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('quick_start') === '1') {
            // Remove the quick_start query parameter from the URL bar so that refreshes don't auto-trigger again
            const newUrl = window.location.pathname + (window.location.search.replace(/[?&]quick_start=1/, '').replace(/^&/, '?'));
            window.history.replaceState({}, document.title, newUrl);
            
            // Trigger preset message to AI to start the course-specific quiz/practice test
            triggerPreset('Please start the practice test immediately based on the course custom prompt and generate the exercise/passage/questions wrapped in the exercise tag.');
        }
    });
</script>
@endsection
